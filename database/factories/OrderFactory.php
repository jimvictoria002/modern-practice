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
        $customer = Customer::inRandomOrder()->first();
        $drink = Drink::inRandomOrder()->first();
        $quantity = $this->faker->numberBetween(1, 5);
        $total = $drink->price * $quantity;
        return [
            'customer_id' => $customer->id,
            'drink_id' => $drink->id,
            'quantity' => $quantity, // Example: random quantity between 1 and 5
            'total' => $total, // Example: random total amount between 10 and 100 with 2 decimal places
        ];
    }
}
