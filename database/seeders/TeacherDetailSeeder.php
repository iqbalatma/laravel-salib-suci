<?php

namespace Database\Seeders;

use App\Models\TeacherDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeacherDetail::create(['user_id' => 1]);
        TeacherDetail::create(['user_id' => 2]);
        TeacherDetail::create(['user_id' => 3]);
        TeacherDetail::create(['user_id' => 4]);
    }
}
