<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
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
                'name' => "COMERCIAL",
                'created_at' => now()
            ],
            [
                'name' => "INDUSTRIAL",
                'created_at' => now()
            ],
            [
                'name' => "LAMPARA LED",
                'created_at' => now()
            ],
            [
                'name' => "PANEL LED",
                'created_at' => now()
            ],
            [
                'name' => "PERFIL",
                'created_at' => now()
            ],
            [
                'name' => "SOLAR",
                'created_at' => now()
            ],
            [
                'name' => "TRASFORMADOR",
                'created_at' => now()
            ],
            [
                'name' => "TUBOS LED",
                'created_at' => now()
            ],
        ];

        Type::insert($data);
    }
}
