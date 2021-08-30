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
                ['name'=>'Aprobadas'],
                ['name'=>'Rechazadas']
            ];

            BudgetStatus::insert($data);
    }
}
