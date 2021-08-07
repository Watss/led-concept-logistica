<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => "Administrador",
                'guard_name' => 'web'
            ],
            [
                'name' => "Vendedor",
                'guard_name' => 'web'
            ],
        ];

        Role::insert($data);
    }
}
