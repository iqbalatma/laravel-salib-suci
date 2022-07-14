<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    School::create([
      "name" => "SMA MANTAP",
    ]);
    School::create([
      "name" => "SMA JIWA",
    ]);
    School::create([
      "name" => "SMA MANTAP JIWA",
    ]);
  }
}
