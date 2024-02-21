<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesPermissionsSeeder::class,
            UserTableSeeder::class,
            ProductTableSeeder::class,
            OrderTableSeeder::class,
            OrderProductTableSeeder::class,
            ExampleTableSeeder::class,
        ]);
    }
}
