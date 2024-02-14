<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderProduct;

class OrderProductTableSeeder extends Seeder
{
    public function run()
    {
        OrderProduct::factory()->count(500)->create();
    }
}
