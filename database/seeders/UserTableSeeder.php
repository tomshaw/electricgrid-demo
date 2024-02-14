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
        $user->profile()->create(Profile::factory()->make()->toArray());
    
        User::factory()->count(200)->create()->each(function ($user) {
            $user->assignRole('Member');
            $user->profile()->create(Profile::factory()->make()->toArray());
        });
    }
}
