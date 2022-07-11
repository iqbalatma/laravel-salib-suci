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
            "name" => "iqbal atma muliawan",
            "username" => "iqbalatma",
            "email" => "iqbalatma@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "saleh budiman",
            "username" => "salehbudiman",
            "email" => "salehbudiman@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "ovianto",
            "username" => "ovianto",
            "email" => "ovianto@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "bagas",
            "username" => "bagas",
            "email" => "bagas@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "ucup",
            "username" => "ucup",
            "email" => "ucup@gmail.com",
            "password" => Hash::make("admin"),
            "role_id" => 1
        ]);
        User::create([
            "name" => "andi",
            "username" => "andi",
            "email" => "andi@gmail.com",
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
