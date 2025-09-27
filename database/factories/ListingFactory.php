<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::where('role', 'seller')->inRandomOrder()->first()->id
                        ?? \App\Models\User::factory(),
            'animal_type' => $this->faker->randomElement(['cow','goat','sheep','camel']),
            'breed' => $this->faker->word(),
            'age' => $this->faker->numberBetween(6,120),
            'weight' => $this->faker->randomFloat(2, 50, 800),
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'location' => $this->faker->city(),
            'vaccination_info' => $this->faker->optional()->sentence(),
            'status' => 'available',
        ];
    }
}

