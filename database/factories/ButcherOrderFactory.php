<?php

namespace Database\Factories;

use App\Models\ButcherOrder;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ButcherOrder>
 */
class ButcherOrderFactory extends Factory
{
    protected $model = ButcherOrder::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id
                        ?? Order::factory(),
            'butcher_id' => User::where('role','butcher')->inRandomOrder()->first()->id
                        ?? User::factory(),
            'scheduled_date' => $this->faker->dateTimeBetween('now','+3 days'),
            'charge' => $this->faker->randomFloat(2, 300, 1500),
            'status' => 'scheduled',
        ];
    }
}

