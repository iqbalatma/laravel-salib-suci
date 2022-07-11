<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataRole = [
            'guru',
            'admin-ict',
            'kepala-yayasan',
        ];

        foreach ($dataRole as $key => $role) {
            Role::create(['role_name' => $role]);
        }
    }
}
