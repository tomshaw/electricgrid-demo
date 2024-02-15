<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderTableSeeder extends Seeder
{
    public function run()
    {
        Order::factory()->count(400)->create();
    }
}
