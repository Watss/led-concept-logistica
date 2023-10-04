<?php

namespace App\Imports;

use App\Models\ProductConfig;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductConfigImport implements ToModel
{
    public $isFirstRow = true;
    public function model(array $row)
    {

        // Eliminar la primera fila (encabezados) usando shift()
        if ($this->isFirstRow) {
            $this->isFirstRow = false;
            return null; // O simplemente return; para omitir la importación de la primera fila
        }

        return new ProductConfig([
            //'id' => $row[0],
            'descripcion' => $row[1],
            'proveedor' => $row[2],
            'sku_led_concept' => $row[3],
            'sku_led_center' => $row[4],
            'legacy_sku_led_concept' => $row[5],
            'legacy_sku_led_center' => $row[6],
        ]);
    }
}
