<?php

namespace App\Imports;

use App\Models\ProductConfig;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductConfigImport implements ToModel
{
    public function model(array $row)
    {
        // Buscar si ya existe un registro con el ID proporcionado
        $existingRecord = ProductConfig::find($row[0]);

        if ($existingRecord) {
            // Actualizar el registro existente con los nuevos valores
            $existingRecord->update([
                'descripcion' => $row[1],
                'proveedor' => $row[2],
                'sku_led_concept' => $row[3],
                'sku_led_center' => $row[4],
                'legacy_sku_led_concept' => $row[5],
                'legacy_sku_led_center' => $row[6],
            ]);

            return null; // Retorna null para evitar la inserción de un nuevo registro
        }

        // Si no existe un registro con el ID, crea uno nuevo
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
