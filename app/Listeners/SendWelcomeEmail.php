<?php

namespace App\Listeners;

use App\Events\ClientCreated;
use App\Mail\WelcomeClientMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    public function handle(ClientCreated $event): void
    {
        $client = $event->client;

        if ($client->email) {
            Mail::to($client->email)->queue(new WelcomeClientMail($client));
        }
    }
}