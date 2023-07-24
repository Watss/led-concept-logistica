<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //LED CENTER DOCUMENTS TYPES
        DocumentType::create([
            "name" => "Boleta Electrónica",
            "id_bsale" => 1,
            "is_sum" => true,
            "company_id" => 2,
        ]);

        DocumentType::create([
            "name" => "Boleta No Afecta o Excenta Electrónica",
            "id_bsale" => 28,
            "is_sum" => true,
            "company_id" => 2,
        ]);

        DocumentType::create([
            "name" => "Boleta No Afecta o Excenta Electrónica T",
            "id_bsale" => 29,
            "is_sum" => true,
            "company_id" => 2,
        ]);

        DocumentType::create([
            "name" => "Factura Electrónica",
            "id_bsale" => 6,
            "is_sum" => true,
            "company_id" => 2,
        ]);

        DocumentType::create([
            "name" => "Factura No Afecta o Excenta Electrónica",
            "id_bsale" => 15,
            "is_sum" => true,
            "company_id" => 2,
        ]);

        DocumentType::create([
            "name" => "Factura No Afecta o Excenta Electrónica T",
            "id_bsale" => 27,
            "is_sum" => true,
            "company_id" => 2,
        ]);

        DocumentType::create([
            "name" => "Nota de Crédito Electrónica",
            "id_bsale" => 9,
            "is_sum" => false,
            "company_id" => 2,
        ]);

        //LED CONCEPT DOCUMENTS TYPES
        DocumentType::create([
            "name" => "Boleta Electrónica",
            "id_bsale" => 22,
            "is_sum" => true,
            "company_id" => 1,
        ]);

        DocumentType::create([
            "name" => "Factura Electrónica",
            "id_bsale" => 5,
            "is_sum" => true,
            "company_id" => 1,
        ]);

        DocumentType::create([
            "name" => "Nota de Crédito Electrónica",
            "id_bsale" => 2,
            "is_sum" => false,
            "company_id" => 2,
        ]);
    }
}
