<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SekolahSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Sekolah::create([
      "nama_sekolah" => "SMA MANTAP",
    ]);
    Sekolah::create([
      "nama_sekolah" => "SMA JIWA",
    ]);
    Sekolah::create([
      "nama_sekolah" => "SMA MANTAP JIWA",
    ]);
  }
}
