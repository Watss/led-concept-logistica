<?php

namespace Database\Seeders;

use App\Models\User;
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

        $resources= ['product','user','budget','client','brand','budget-status'];
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

        //usuarios
        $userAdmin=User::factory()->create(['email'=>'admin@gmail.com']);
        $userVendedor=User::factory()->create(['email'=>'vendedor@gmail.com']);
        //asignacion de roles
        $userAdmin->assignRole($Admin);
        $userVendedor->assignRole( $Vendedor);

        $Admin->givePermissionTo(['product:index','product:view','product:create','product:edit','product:update','product:delete']);
        $Admin->givePermissionTo(['user:index','user:view','user:create','user:edit','user:update','user:delete']);
        $Admin->givePermissionTo(['budget:index','budget:view','budget:create','budget:edit','budget:update','budget:delete']);
        $Admin->givePermissionTo(['client:index','client:view','client:create','client:edit','client:update','client:delete']);
        $Admin->givePermissionTo(['brand:index','brand:view','brand:create','brand:edit','brand:update','brand:delete']);
        $Admin->givePermissionTo(['budget-status:index','budget-status:view','budget-status:create','budget-status:edit','budget-status:update','budget-status:delete']);


        $Vendedor->givePermissionTo(['product:index','product:view']);
        $Vendedor->givePermissionTo(['client:index','client:view','client:edit','client:update','client:create']);
        $Vendedor->givePermissionTo(['budget:index','budget:view','budget:edit','budget:update','budget:create']);
        //$Vendedor->givePermissionTo(['user:index','user:view','user:create','user:edit','user:update']);

    }
}
