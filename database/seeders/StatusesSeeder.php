<?php

namespace Database\Seeders;

use App\Models\BudgetStatus;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                ['id' => 1, 'name'=>'Pendiente', 'color' => '#FFEC00'],
                ['id' => 2 , 'name' => 'Pendiente de aceptación', 'color' => '#FF8300'],
                ['id' => 3 , 'name' => 'Aprobada', 'color' => '#21FF16'],
                ['id' => 4 , 'name' => 'Rechazada', 'color' => '#FF0303'],
                ['id' => 5 , 'name' => 'Terminada', 'color' => '#000000'],
            ];

            BudgetStatus::insert($data);
    }
}
