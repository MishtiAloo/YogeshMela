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
            'city'       => $this->faker->city(),
            'division'   => $this->faker->state(),
            'role'       => $this->faker->randomElement(['buyer','seller', 'butcher', 'delivery_man']), // leave 'admin' for manual insert
            'verified'   => $this->faker->randomElement(['unverified', 'pending', 'verified']),
        ];
    }
}
