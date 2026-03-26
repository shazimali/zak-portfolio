<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeWebhookController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/thank-you', function () {
    return view('thank-you');
});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class)
    ->name('stripe.webhook');

Route::get('/billing-portal', [StripeWebhookController::class, 'billingPortal'])
    ->name('billing.portal');

Route::get('/test-email', function () {
    \Illuminate\Support\Facades\Mail::raw('This is a test email to verify your SMTP configuration is working perfectly!', function ($message) {
        $message->to('shazimali03@gmail.com')
                ->subject('SMTP Verification Test - Designjoy');
    });
    return 'Test email successfully dispatched! Check your shazimali03@gmail.com inbox.';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
