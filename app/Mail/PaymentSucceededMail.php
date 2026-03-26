<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentSucceededMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $description;
    public $price;
    public $cancelUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $description, $price, $cancelUrl)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->cancelUrl = $cancelUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Successful - Welcome to Designjoy!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment-succeeded',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
