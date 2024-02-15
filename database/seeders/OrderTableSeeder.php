<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;

class OrderTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all()->shuffle();

        foreach ($users as $user) {
            Order::factory()->for($user, 'user')->create();
        }
    }
}
