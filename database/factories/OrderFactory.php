<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Drink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'drink_id' => Drink::inRandomOrder()->first()->id,
            'quantity' => $this->faker->numberBetween(1, 5), // Example: random quantity between 1 and 5
            'total' => $this->faker->randomFloat(2, 10, 100), // Example: random total amount between 10 and 100 with 2 decimal places
        ];
    }
}
