<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => $faker->address(),
                'nomor_hp' => $faker->numerify('08##########'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User One',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => $faker->address(),
                'nomor_hp' => $faker->numerify('08##########'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@gmail.com',
                'password' => Hash::make('password'),
                'alamat' => $faker->address(),
                'nomor_hp' => $faker->numerify('08##########'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

