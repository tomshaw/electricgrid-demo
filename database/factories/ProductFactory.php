<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->word;

        return [
            'name' => $name,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            // 'image' => $this->faker->image('public/images', 640, 480, null, false),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'slug' => Str::slug($name)
        ];
    }
}
