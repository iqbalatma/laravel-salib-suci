<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "budi",
            "username" => "budi",
            "email" => "budi@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "saleh",
            "username" => "saleh",
            "email" => "saleh@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "yanto",
            "username" => "yanto",
            "email" => "yanto@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "eko",
            "username" => "eko",
            "email" => "eko@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "admin",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 2
        ]);
    }
}
