<?php

namespace Database\Seeders;

use App\Models\ButcherOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ButcherOrderSeeder extends Seeder
{
    public function run(): void
    {
        ButcherOrder::factory(10)->create();
    }
}

