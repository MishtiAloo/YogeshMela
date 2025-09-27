<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'buyer_id' => User::where('role','buyer')->inRandomOrder()->first()->id
                        ?? User::factory(),
            'listing_id' => Listing::inRandomOrder()->first()->id
                        ?? Listing::factory(),
            'quantity' => 1,
            'butcher_service' => $this->faker->boolean(40),
            'delivery_service' => $this->faker->boolean(60),
            'status' => 'confirmed',
        ];
    }
}

