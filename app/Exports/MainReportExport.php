<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;

class MainReportExport implements FromView, WithTitle, WithDefaultStyles, ShouldAutoSize
{
    public $productsConfig;
    public $report;

    public function __construct($productsConfig, $report)
    {
        $this->productsConfig = $productsConfig;
        $this->report = $report;
    }

    public function defaultStyles(Style $defaultStyle)
    {
        // Configure the default styles
        return $defaultStyle->getFill()->setFillType(Fill::FILL_SOLID);

        // Or return the styles array
        return [
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => Color::COLOR_BLACK],
            ],
        ];
    }

    public function view(): View
    {
        return view('excel.restocking-report')->with(['productsConfig' =>  $this->productsConfig, 'report' => $this->report]);
    }

    public function title(): string
    {
        return 'Ventas BLA';
    }
}
