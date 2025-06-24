<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Sidetours'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.clients.welcome'
        );
    }
}
