<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            "id" => 1,
            "name" => "LED CONCEPT",
            "token" => "8c61e6d761ecedd08e7b473ec3adb173fa5564f5"
        ]);

        Company::create([
            "id" => 2,
            "name" => "LED CENTER SPA",
            "token" => "5efbef07b3afdc015e4d45fba4535c4d7e095698"
        ]);
    }
}
