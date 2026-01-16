<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address; // Add this
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData; // Changed name for clarity
    public $mailSubject;

    public function __construct($formData, $mailSubject)
    {
        $this->formData = $formData;
        $this->mailSubject = $mailSubject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Sender shows as the customer's name, but sent via your Gmail
            from: new Address(config('mail.from.address'), $this->formData['name']),
            subject: $this->mailSubject,
            // Clicking "Reply" goes to the customer
            replyTo: [new Address($this->formData['email'], $this->formData['name'])],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_template', // Make sure this file exists
        );
    }
}
