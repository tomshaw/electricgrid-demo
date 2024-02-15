<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    protected $model = OrderProduct::class;

    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
