<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ## user 1 ##
        User::updateOrCreate([
            'email' => 'user1@gmail.com'
        ], [
            'name'              => 'mohammed',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456789'),
            'remember_token'    => Str::random(10),
        ]);

        ## user 2 ##
        User::updateOrCreate([
            'email' => 'user2@gmail.com'
        ], [
            'name'              => 'ahmed',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456789'),
            'remember_token'    => Str::random(10),
        ]);

        ## user 3 ##
        User::updateOrCreate([
            'email' => 'user3@gmail.com'
        ], [
            'name'              => 'ali',
            'email_verified_at' => now(),
            'password'          => Hash::make('123456789'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
