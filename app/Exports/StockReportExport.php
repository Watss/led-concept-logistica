<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class StockReportExport implements FromView, WithTitle
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('excel.stock-sheet', [
            "data" => $this->data
        ]);
    }

    public function title(): string
    {
        return 'Stock BLA';
    }

    public function headings(): array
    {
        return [
            'SKU 1',
            'SKU 2',
            'SKU 3',
            'Nombre Producto',
            'Stock',
        ];
    }
}
