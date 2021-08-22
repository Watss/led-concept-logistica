<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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

        $resources= ['product','user','budget','client','brand'];
        $abilities=['index','view','create','edit','update','delete'];
        foreach ($resources as $resource ) {

            foreach ($abilities as $abilitie) {
                Permission::firstOrCreate([
                    'name' =>"{$resource}:{$abilitie}",
                    'guard_name'=>'web'
                ]);
            }
        }

        $Admin=Role::find(1);
        $Vendedor=Role::find(2);

        $Admin->givePermissionTo(['product:index','product:view','product:create','product:edit','product:update','product:delete']);
        $Vendedor->givePermissionTo(['budget:index','budget:view','budget:edit']);

    }
}
