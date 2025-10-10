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
        $animalType = $this->faker->randomElement(['cow','goat','sheep','camel']);

        return [
            'user_id' => \App\Models\User::where('role', 'seller')->inRandomOrder()->first()->id
                        ?? \App\Models\User::factory(),
            'animal_type' => $animalType,
            'breed' => $this->faker->word(),
            'age' => $this->faker->numberBetween(6,120),
            'weight' => $this->faker->randomFloat(2, 50, 800),
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'location' => $this->faker->city(),
            'vaccination_info' => $this->faker->optional()->sentence(),
            'status' => 'available',
            'image' => fn (array $attributes) => match($attributes['animal_type']) {
                'cow' => $this->faker->randomElement([
                    'image/cera-Pn2XcR70E_g-unsplash.jpg',
                    'image/felicia-varzari-apE2kS6IYmI-unsplash.jpg',
                    'image/Gemini_Generated_Image_gqgdk7gqgdk7gqgd - Copy (2) - Copy.png',
                    'image/shalev-cohen-KTLEYHsy8CU-unsplash.jpg',
                    'image/veronica-white-uhMQmjSK6Iw-unsplash.jpg',
                    'image/wouter-r-S-UIYnAqME8-unsplash.jpg'
                ]),
                'goat' => $this->faker->randomElement([
                    'image/goats/50m-above-9chhynuIz28-unsplash.jpg',
                    'image/goats/jess-manthey-CiQOc9z4LbY-unsplash.jpg',
                    'image/goats/jorge-salvador-Cg_Di4KHxPE-unsplash.jpg',
                    'image/goats/mana5280-e8T_r8Q3kNg-unsplash.jpg',
                    'image/goats/muddy-toes-farm-llc-OJ3Zu5dtHVc-unsplash.jpg',
                    'image/goats/nataliya-melnychuk-2V8luifFK7w-unsplash.jpg',
                    'image/goats/robert-schwarz-ftlkViNWWKo-unsplash.jpg'
                ]),
                'sheep' => $this->faker->randomElement([
                    'image/sheeps/jose-llamas-B_QP667GyPY-unsplash.jpg',
                    'image/sheeps/peter-hoogmoed-hKGWrHVj1H8-unsplash.jpg',
                    'image/sheeps/peter-hoogmoed-p-ARv5y0nKc-unsplash.jpg',
                    'image/sheeps/ronan-furuta-9xNiHyYuo-c-unsplash.jpg',
                    'image/sheeps/sophia-hopkins-CAAbbD7N9EE-unsplash.jpg'
                ]),
                'camel' => $this->faker->randomElement([
                    'image/camels/maksim-golovko-EBPTkCcVeDE-unsplash.jpg',
                    'image/camels/maksim-golovko-nQvu3rMWkI0-unsplash.jpg',
                    'image/camels/wolfgang-hasselmann-3fuKZxFP2ow-unsplash.jpg'
                ]),
                default => null,
            },
        ];
    }
}

