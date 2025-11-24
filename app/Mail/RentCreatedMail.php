<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Content, Envelope};
use Illuminate\Queue\SerializesModels;
use App\Models\Rent;

class RentCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Rent $rent;

    public function __construct(Rent $rent)
    {
        $this->rent = $rent;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de location',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.rent-created',
        );
    }
}