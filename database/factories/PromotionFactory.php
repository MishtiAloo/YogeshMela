<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    public function definition(): array
    {
        return [
            'listing_id' => Listing::inRandomOrder()->first()->id ?? Listing::factory(),
            'amount_paid' => $this->faker->randomFloat(2, 500, 5000),
            'fixed_discount' => $this->faker->optional()->randomFloat(2, 100, 1000),
            'percent_discount' => $this->faker->optional()->randomFloat(2, 5, 30),
            'status' => $this->faker->randomElement(['pending', 'active', 'expired']),
            'start_date' => $this->faker->dateTimeBetween('now','+5 days'),
            'end_date' => $this->faker->dateTimeBetween('+6 days','+20 days'),
        ];
    }
}
