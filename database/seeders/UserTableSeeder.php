<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Tom Shaw',
            'email' => 'dev@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);
        
        $user->assignRole('Admin');

        Profile::factory()->for($user)->create();
    
        User::factory()->count(199)->has(Profile::factory()->count(1))->create()->each(function ($user) {
            $user->assignRole('Member');
        });
    }
}
