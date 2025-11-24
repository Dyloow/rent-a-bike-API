<?php

namespace App\Providers;

use App\Events\RentCreated;
use App\Listeners\SendRentCreatedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        RentCreated::class => [
            SendRentCreatedNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}