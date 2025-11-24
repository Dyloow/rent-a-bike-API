<?php

namespace App\Events;

use App\Models\Rent;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RentCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Rent $rent;

    public function __construct(Rent $rent)
    {
        $this->rent = $rent;
    }
}