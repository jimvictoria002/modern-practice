<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Drink;
class DrinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Drink::factory()->count(50)->create();
    }
}
