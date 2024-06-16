<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Jimuel',
            'middlename' => null,
            'lastname' => 'Victoria',
            'email' => 'jimuelvictoria002@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Jimjim0090602'),
            'access' => 1,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'firstname' => 'Jimuel',
            'middlename' => 'Hayan',
            'lastname' => 'Victoria',
            'email' => 'jimuelhayan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'access' => 2,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
