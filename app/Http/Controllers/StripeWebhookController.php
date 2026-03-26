<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\BillingPortal\Session as BillingPortalSession;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSucceededMail;
use Illuminate\Support\Facades\URL;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        $event = null;

        try {
            if ($endpoint_secret) {
                $event = \Stripe\Webhook::constructEvent(
                    $payload, $sig_header, $endpoint_secret
                );
            } else {
                // For local dynamic testing if no secret is set
                $event = json_decode($payload);
            }
        } catch(\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        if ($event->type == 'checkout.session.completed') {
            Log::info('Webhook triggered: checkout.session.completed');
            $sessionData = $event->data->object;

            Stripe::setApiKey(config('services.stripe.secret'));

            try {
                // Fetch full session including line items
                $session = Session::retrieve([
                    'id' => $sessionData->id,
                    'expand' => ['line_items']
                ]);

                $email = $session->customer_details->email;
                $customerId = $session->customer;

                // For Stripe CLI local testing, Stripe sends dummy events with `stripe@example.com`.
                // Override to the specific email you requested so you can test locally.
                if (config('app.env') === 'local' && $email === 'stripe@example.com') {
                    $email = 'shazimali03@gmail.com';
                }
                
                Log::info('Extracted Customer Email: ' . ($email ?: 'None found'));

                $lineItems = $session->line_items->data;
                $title = 'Monthly Club';
                $description = 'Design Subscription';
                $price = '$0.00';

                if (count($lineItems) > 0) {
                    $item = $lineItems[0];
                    $title = $item->description ?? 'Monthly Club';
                    $description = $item->price->product->description ?? 'Pause or Cancel Anytime';
                    $amount = $item->amount_total / 100;
                    $currency = strtoupper($item->currency);
                    
                    // Format price
                    $price = method_exists(numfmt_create('en_US', \NumberFormatter::CURRENCY), 'formatCurrency')
                             ? numfmt_create('en_US', \NumberFormatter::CURRENCY)->formatCurrency($amount, $currency) 
                             : '$' . number_format($amount, 2);
                }

                // Generate a signed cancel URL route for the portal
                $cancelUrl = URL::signedRoute('billing.portal', ['customer' => $customerId]);

                if ($email) {
                    Log::info("Attempting to send email to {$email} using mailer: " . config('mail.mailer'));
                    Mail::to($email)->send(new PaymentSucceededMail($title, $description, $price, $cancelUrl));
                    Log::info('PaymentSucceededMail dispatch completed to: ' . $email);
                } else {
                    Log::warning('No email found in Stripe Customer Details, skipping email dispatch.');
                }

            } catch (\Exception $e) {
                Log::error('Stripe Webhook Error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        return response()->json(['status' => 'success']);
    }

    public function billingPortal(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'Invalid or expired link.');
        }

        $customerId = $request->query('customer');

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $portalSession = BillingPortalSession::create([
                'customer' => $customerId,
                'return_url' => url('/'),
            ]);

            return redirect()->away($portalSession->url);
        } catch (\Exception $e) {
            abort(500, 'Unable to create billing portal session: ' . $e->getMessage());
        }
    }
}
