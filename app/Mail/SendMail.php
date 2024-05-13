<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $MailMessage;
    public $subject;
    public function __construct($message,$subject)
    {
        $this->MailMessage = $message;
        $this->subject = $subject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('mehdihmoudou2@gmail.com','mehdi hmoudou'),
            replyTo: [
                new Address('mehdihmoudou2@gmail.com','mehdi hmoudou'),
            ],
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'welcome',
        );
    }

}
