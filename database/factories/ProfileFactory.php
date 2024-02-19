<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\User;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition()
    {
        return [
            'billing_address_line_1' => $this->faker->streetAddress,
            'billing_address_line_2' => $this->faker->secondaryAddress,
            'billing_city' => $this->faker->city,
            'billing_state' => $this->faker->state,
            'billing_zip' => $this->faker->postcode,
            'billing_country' => $this->faker->country,
            'shipping_address_line_1' => $this->faker->streetAddress,
            'shipping_address_line_2' => $this->faker->secondaryAddress,
            'shipping_city' => $this->faker->city,
            'shipping_state' => $this->faker->state,
            'shipping_zip' => $this->faker->postcode,
            'shipping_country' => $this->faker->country,
            'phone_number' => $this->faker->phoneNumber,
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people'),
            // Filter testing
            'profile_badge' => $this->faker->numberBetween(1, 5),
            'profile_date' => $this->faker->date('Y-m-d'),
            'profile_time' => $this->faker->time('H:i:s'),
        ];
    }
}