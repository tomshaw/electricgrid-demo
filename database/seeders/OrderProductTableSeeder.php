<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderProduct;
use App\Models\Order;
use App\Models\Product;

class OrderProductTableSeeder extends Seeder
{
    public function run()
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $product = $products->random();
            OrderProduct::factory()->for($order, 'order')->for($product, 'product')->create();
        }
    }
}