<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    protected $model = Delivery::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::inRandomOrder()->first()->id
                        ?? Order::factory(),
            'delivery_man_id' => User::where('role','delivery_man')->inRandomOrder()->first()->id
                        ?? User::factory(),
            'delivery_date' => $this->faker->dateTimeBetween('now','+7 days'),
            'delivery_address' => $this->faker->address(),
            'charge' => $this->faker->randomFloat(2, 200, 1000),
            'status' => 'scheduled',
        ];
    }
}
