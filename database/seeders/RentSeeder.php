<?php

namespace Database\Seeders;

use App\Events\RentCreated;
use App\Models\Rent;
use Illuminate\Database\Seeder;

class RentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rent = Rent::factory()->count(10)->create();
    }
}
