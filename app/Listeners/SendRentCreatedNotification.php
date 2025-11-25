<?php

namespace App\Listeners;

use App\Events\RentCreated;
use App\Mail\RentCreatedMail;

class SendRentCreatedNotification
{
    public function handle(RentCreated $event): void
    {
        $rent = $event->rent;
        $user = $rent->user;

        $user->notify(new RentCreatedMail($rent));
    }
}
