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
            $numProducts = rand(1, 5);
            for ($i = 0; $i < $numProducts; $i++) {
                $product = $products->random();
                $orderProduct = OrderProduct::factory()->for($order, 'order')->for($product, 'product')->create();
                $order->total += $orderProduct->quantity * $product->price;
            }
            $order->save();
        }
    }
}