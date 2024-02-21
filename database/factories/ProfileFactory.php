<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use DateTime;
use DateInterval;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    private static $profileDate;

    public function definition()
    {
        if (!isset(self::$profileDate)) {
            self::$profileDate = (new DateTime())->modify('-2 years');
        } else {
            // Correctly handle Daylight Saving Time changes
            self::$profileDate->add(new DateInterval('P1D'));
        }
    
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
            'newsletter' => $this->faker->boolean,
            // Filter testing
            'profile_badge' => $this->faker->numberBetween(1, 5),
            'profile_date' => self::$profileDate->format('Y-m-d'),
            'profile_time' => $this->faker->time('H:i:s'),
            'created_at' => self::$profileDate,
            'updated_at' => self::$profileDate,
        ];
    }
}