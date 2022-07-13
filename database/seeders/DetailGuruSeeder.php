<?php

namespace Database\Seeders;

use App\Models\DetailGuru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailGuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DetailGuru::create(['user_id' => 1]);
        DetailGuru::create(['user_id' => 2]);
        DetailGuru::create(['user_id' => 3]);
        DetailGuru::create(['user_id' => 4]);
    }
}
