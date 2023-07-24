<?php

namespace Database\Seeders;

use App\Models\ProductConfig;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(DocumentTypeSeeder::class);
        $this->call(ProductConfigSeeder::class);
    }
}
