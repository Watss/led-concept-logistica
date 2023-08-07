<?php

namespace App\Exports;

use App\Models\ProductConfig;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\BeforeSheet;

class ProductConfigExport implements FromCollection, WithHeadings, WithEvents
{

    public function headings(): array
    {
        return [
            'ID(NO MODIFICAR NI AGREGAR)',
            'Descripción',
            'Proveedor',
            'SKU LED Concept',
            'SKU LED Center',
            'Legacy SKU LED Concept',
            'Legacy SKU LED Center',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProductConfig::all();
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {

                $event->sheet->getDelegate()
                    ->getStyle('A:A')->getProtection()
                    ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
            },
        ];
    }
}
