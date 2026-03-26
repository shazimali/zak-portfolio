<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class EditablePricingCard extends Component
{
    public bool $isAdmin;
    public bool $editing = false;

    // Live fields
    public string $title        = 'Monthly Club';
    public string $badge        = 'PAUSE OR CANCEL ANYTIME';
    public string $price        = '$5,995';
    public string $period       = '/month';
    public string $btnLabel     = 'Join today';
    public array  $list1        = [];
    public array  $list2        = [];

    // Edit fields
    public string $editTitle     = '';
    public string $editBadge     = '';
    public string $editPrice     = '';
    public string $editPeriod    = '';
    public string $editBtnLabel  = '';
    public string $editList1     = '';
    public string $editList2     = '';

    public function mount()
{
    $this->isAdmin = auth()->check();

    $this->title     = SiteSetting::get('pricing_title')     ?? 'Monthly Club';
    $this->badge     = SiteSetting::get('pricing_badge')     ?? 'PAUSE OR CANCEL ANYTIME';
    $this->price     = SiteSetting::get('pricing_price')     ?? '$5,995';
    $this->period    = SiteSetting::get('pricing_period')    ?? '/month';
    $this->btnLabel  = SiteSetting::get('pricing_btn_label') ?? 'Join today';

    $defaultList1 = ['One request at a time', 'Avg. 48 hour delivery', 'Unlimited brands', 'Webflow development'];
    $defaultList2 = ['Unlimited stock photos', 'Up to 2 users', 'Pause or cancel anytime'];

    $raw1 = SiteSetting::get('pricing_list1');
    $raw2 = SiteSetting::get('pricing_list2');

    $this->list1 = $raw1 ? (json_decode($raw1, true) ?: $defaultList1) : $defaultList1;
    $this->list2 = $raw2 ? (json_decode($raw2, true) ?: $defaultList2) : $defaultList2;
}

    public function startEditing()
    {
        $this->editTitle     = $this->title;
        $this->editBadge     = $this->badge;
        $this->editPrice     = $this->price;
        $this->editPeriod    = $this->period;
        $this->editBtnLabel  = $this->btnLabel;
        $this->editList1     = implode("\n", $this->list1);
        $this->editList2     = implode("\n", $this->list2);
        $this->editing       = true;
    }

    public function save()
    {
        $this->validate([
            'editTitle'     => 'required|max:100',
            'editBadge'     => 'required|max:100',
            'editPrice'     => 'required|max:50',
            'editPeriod'    => 'required|max:30',
            'editBtnLabel'  => 'required|max:50',
            'editList1'     => 'required',
            'editList2'     => 'required',
        ]);

        SiteSetting::set('pricing_title',      $this->editTitle);
        SiteSetting::set('pricing_badge',      $this->editBadge);
        SiteSetting::set('pricing_price',      $this->editPrice);
        SiteSetting::set('pricing_period',     $this->editPeriod);
        SiteSetting::set('pricing_btn_label',  $this->editBtnLabel);
        SiteSetting::set('pricing_list1', json_encode(array_filter(array_map('trim', explode("\n", $this->editList1)))));
        SiteSetting::set('pricing_list2', json_encode(array_filter(array_map('trim', explode("\n", $this->editList2)))));

        $this->title     = $this->editTitle;
        $this->badge     = $this->editBadge;
        $this->price     = $this->editPrice;
        $this->period    = $this->editPeriod;
        $this->btnLabel  = $this->editBtnLabel;
        $this->list1     = array_filter(array_map('trim', explode("\n", $this->editList1)));
        $this->list2     = array_filter(array_map('trim', explode("\n", $this->editList2)));

        $this->editing = false;
        session()->flash('pricing_updated');
    }

    public function checkout()
    {
        $stripeSecret = config('services.stripe.secret');

        if (empty($stripeSecret)) {
            session()->flash('error', 'Stripe configuration is missing.');
            return;
        }

        // Parse price (e.g., "$5,995" -> 599500 cents)
        $amountCents = $this->parsePriceToCents($this->price);

        if ($amountCents <= 0) {
            session()->flash('error', 'Invalid price format.');
            return;
        }

        Stripe::setApiKey($stripeSecret);

        // Detect mode and interval
        $isRecurring = str_contains(strtolower($this->period), 'month') || str_contains(strtolower($this->period), 'year');
        $interval = str_contains(strtolower($this->period), 'year') ? 'year' : 'month';

        try {
            $sessionParams = [
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => $amountCents,
                        'product_data' => [
                            'name' => $this->title,
                            'description' => implode(', ', array_slice(array_merge($this->list1, $this->list2), 0, 10)),
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => $isRecurring ? 'subscription' : 'payment',
                'success_url' => url('/thank-you'),
                'cancel_url' => url('/'),
            ];

            if ($isRecurring) {
                $sessionParams['line_items'][0]['price_data']['recurring'] = [
                    'interval' => $interval,
                ];
            }

            $session = Session::create($sessionParams);

            return redirect()->away($session->url);
        } catch (\Exception $e) {
            session()->flash('error', 'Unable to initiate checkout: ' . $e->getMessage());
        }
    }

    private function parsePriceToCents(string $priceString): int
    {
        // Strip non-numeric except dot and comma
        $clean = preg_replace('/[^-0-9,.]/', '', $priceString);
        
        // Handle comma as thousand separator (standard for $5,995)
        // If there's a comma followed by 3 digits, it's likely a thousand separator
        if (preg_match('/,\d{3}/', $clean)) {
            $clean = str_replace(',', '', $clean);
        }
        
        // If there's a dot, it might be cents. 
        // We'll cast to float then multiply by 100.
        return (int) (round((float) $clean * 100));
    }

    public function cancel()
    {
        $this->editing = false;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.editable-pricing-card');
    }
}