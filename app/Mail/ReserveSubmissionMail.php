<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReserveSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;
    public $mailSubject;

    public function __construct($formData, $mailSubject)
    {
        $this->formData = $formData;
        $this->mailSubject = $mailSubject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Sent from your Gmail, but labeled with the Guest's Name
            from: new Address(config('mail.from.address'), $this->formData['full_name']),
            subject: $this->mailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reserve_template', // We will create this file next
        );
    }
}
