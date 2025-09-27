<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a fixed Admin User
        User::create([
            'name'       => 'admin',
            'email'      => 'ggg@gg.com',
            'password'   => Hash::make('gggg'), 
            'phone'      => '01700000000',
            'house_no'   => '10',
            'road_no'    => '5',
            'thana'      => 'Banani',
            'postal_code'=> '1213',
            'city'       => 'Dhaka',
            'division'   => 'Dhaka Division',
            'role'       => 'admin',
            'verified'   => true,
        ]);

        // Generate 20 fake users
        User::factory(20)->create();
    }
}
