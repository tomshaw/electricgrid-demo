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
            'name' => env('DB_SEED_NAME', 'Full Stack Developer'),
            'email' => env('DB_SEED_EMAIL', 'placeholder@email.com'),
            'email_verified_at' => now(),
            'password' => bcrypt(env('DB_SEED_PASSWORD', Str::random(10))),
            'remember_token' => Str::random(10),
        ]);
        
        $user->assignRole('Admin');
    
        Profile::factory()->for($user)->create();
    
        $roles = ['Editor', 'Moderator', 'Manager', 'Guest', 'Subscriber', 'Contributor'];

        User::factory()->count(199)->has(Profile::factory()->count(1))->create()->each(function ($user) use ($roles) {
            $randomRoles = array_rand(array_flip($roles), rand(2, 3));
            $user->assignRole(['Member', ...$randomRoles]);
        });
    }
}
