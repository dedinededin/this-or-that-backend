<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $faker = \Faker\Factory::create();

        // Let's make sure everyone has the same password and
        // let's hash it before the loop, or else our seeder
        // will be too slow.
        $password = Hash::make('toptal');

        User::create([
            'username' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
            'api_token' => 'admin',
        ]);

        // And now let's generate a few dozen users for our app:
        for ($i = 0; $i < 9; $i++) {
            User::create([
                'username' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'api_token' => Str::random(60),
            ]);
        }
    }
}
