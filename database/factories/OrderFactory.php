<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;
use DateInterval;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    private static $orderDate;

    public function definition()
    {
        if (!isset(self::$orderDate)) {
            self::$orderDate = (new DateTime())->modify('-2 years');
        } else {
            // Correctly handle Daylight Saving Time changes
            self::$orderDate->add(new DateInterval('P1D'));
        }
    
        return [
            'order_date' => self::$orderDate->format('Y-m-d'),
            'order_time' => $this->faker->time('H:i:s'),
            'status' => $this->faker->numberBetween(0, 4),
            'invoiced' => $this->faker->boolean,
            'total' => $this->faker->randomFloat(2, 20, 200),
            'created_at' => self::$orderDate,
            'updated_at' => self::$orderDate,
        ];
    }
}
