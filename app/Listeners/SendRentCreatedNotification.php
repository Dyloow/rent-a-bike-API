<?php

namespace App\Listeners;

use App\Events\RentCreated;
use App\Mail\RentCreatedMail;
use Illuminate\Support\Facades\Mail;

class SendRentCreatedNotification
{
    public function handle(RentCreated $event): void
    {
        Mail::to($event->rent->user->email)
            ->send(new RentCreatedMail($event->rent));
    }
}