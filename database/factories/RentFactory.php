<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bike_id' => \App\Models\Bike::factory(),
            'user_id' => \App\Models\User::factory(),
            'rent_start' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'rent_end' => $this->faker->dateTimeBetween('now', '+1 month'),
            'total_price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
