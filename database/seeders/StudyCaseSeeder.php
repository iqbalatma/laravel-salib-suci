<?php

namespace Database\Seeders;

use App\Models\StudyCase;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyCaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudyCase::create([
            "case_name" => "Guru Terbaik"
        ]);
    }
}
