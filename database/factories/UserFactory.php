<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'       => $this->faker->name(),
            'email'      => $this->faker->unique()->safeEmail(),
            'password'   => Hash::make('password'), // default hashed password
            'phone'      => $this->faker->optional()->phoneNumber(),
            'house_no'   => $this->faker->buildingNumber(),
            'road_no'    => $this->faker->streetName(),
            'thana'      => $this->faker->citySuffix(), // can adjust for BD context
            'postal_code'=> $this->faker->postcode(),
            'city'       => $this->faker->city(),
            'division'   => $this->faker->state(),
            'role'       => $this->faker->randomElement(['buyer','seller', 'butcher', 'delivery_man']), // leave 'admin' for manual insert
            'verified'   => $this->faker->boolean(20), // 20% chance true
        ];
    }
}
