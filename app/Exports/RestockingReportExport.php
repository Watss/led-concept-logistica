<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class RestockingReportExport implements WithMultipleSheets
{
    use Exportable;

    public $productsConfig;
    public $report;

    public function __construct($productsConfig, $report)
    {
        $this->productsConfig = $productsConfig;
        $this->report = $report;
    }

    public function sheets(): array
    {
        $sheets = [new MainReportExport($this->productsConfig, $this->report),/*  new SalesReportExport(), new StockReportExport($this->data['stockTotal']) */];

        return $sheets;
    }
}
