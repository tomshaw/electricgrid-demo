<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Example;

class ExampleTableSeeder extends Seeder
{
    public function run()
    {
        Example::create([
            'title' => 'Users Table',
            'description' => 'This is an example of creating a system users table.',
            'route' => 'users',
        ]);

        Example::create([
            'title' => 'Orders Table',
            'description' => 'This is an example of creating a system orders table.',
            'route' => 'orders',
        ]);
    }
}
