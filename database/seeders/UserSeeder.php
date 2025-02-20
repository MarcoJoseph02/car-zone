<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //factory(\App\Models\User::class, 10)->create();
        \App\Models\User::factory(10)->create();

        // $faker = \Faker\Factory::create();
        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('users')->insert([
        //         'fname' => $faker->firstName(),
        //         'lname' => $faker->lastName(),
        //         'address' => $faker->address(),
        //         'email' => Str::random(10).'@example.com',
        //         'password' => Hash::make('password'),
        //     ]);
        //}
    }
}
