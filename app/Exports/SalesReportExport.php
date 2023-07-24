<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class SalesReportExport implements FromView, WithTitle
{
    public function view(): View
    {
        return view('excel.stock-sheet');
    }

    public function title(): string
    {
        return 'Ventas BLA';
    }
}
