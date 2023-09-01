<?php

namespace App\Mail;

use App\Exports\RestockingReportExport;
use App\Models\Company;
use App\Models\ProductConfig;
use App\Models\Report;
use App\Models\ReportSaleDetail;
use App\Models\ReportStockDetail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $start;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($report, $start, $user)
    {
        $this->report = $report;
        $this->start = $start;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $start = $this->report->start;
        $end12 = Carbon::create($start)->addMonths(12)->format('Y-m-d');
        $end6 = Carbon::create($end12)->subMonths(6)->format('Y-m-d');

        $companies = Company::all();
        $report = $this->report;

        $productsConfig = ProductConfig::all()->map(function ($pc) {

            $pc->sku_led_concept = strtoupper(str_replace(' ', '', $pc->sku_led_concept));
            $pc->sku_led_center = strtoupper(str_replace(' ', '', $pc->sku_led_center));
            $pc->legacy_sku_led_concept = strtoupper(str_replace(' ', '', $pc->legacy_sku_led_concept));
            $pc->legacy_sku_led_center = strtoupper(str_replace(' ', '', $pc->legacy_sku_led_center));
            return $pc;
        });

        $productsFormatted = $productsConfig->map(function ($pc) {
            return [
                "id" => $pc->id,
                "codes" => [strtoupper($pc->sku_led_concept), strtoupper($pc->sku_led_center), strtoupper($pc->legacy_sku_led_concept), strtoupper($pc->legacy_sku_led_center)]
            ];
        });


        try {
            foreach ($companies as $company) {
                Log::info("Procesando empresa $company->name");
                $response = Http::post('http://localhost:1807/get-info-by-company', [
                    "company" => [
                        "id" =>  $company->id,
                        "name" =>  $company->name,
                        "token" =>  $company->token
                    ],
                    "documents" => $company->documentsTypes->map(function ($document) {
                        return [
                            "id" => $document->id_bsale,
                            "name" => $document->name,
                            "isSum" => $document->is_sum
                        ];
                    }),
                    "start" => $start,
                    "end" => $end6,
                    "withStock" => true,
                ]);

                $response12 = Http::post('http://localhost:1807/get-info-by-company', [
                    "company" => [
                        "id" =>  $company->id,
                        "name" =>  $company->name,
                        "token" =>  $company->token
                    ],
                    "documents" => $company->documentsTypes->map(function ($document) {
                        return [
                            "id" => $document->id_bsale,
                            "name" => $document->name,
                            "isSum" => $document->is_sum
                        ];
                    }),
                    "start" => $start,
                    "end" => $end12,
                    "withStock" => false
                ]);


                $company->sales = collect(json_decode($response->body(), true)['sales']);

                $company->sales12 = collect(json_decode($response12->body(), true)['sales']);

                $company->sales = $company->sales->map(function ($sale) use ($productsFormatted, $company, $report) {
                    $code = $sale['code'];
                    Log::info($sale);
                    $productConfigId = $productsFormatted
                        ->filter(function ($pc) use ($code) {
                            return in_array($code, $pc['codes']);
                        })
                        ->first();

                    if (!$productConfigId) {
                        return null;
                    }

                    return [
                        'quantity' => $sale['sales'],
                        'code' => $code,
                        'product_config_id' => $productConfigId['id'],
                        'report_id' => $report->id,
                        'company_id' => $company->id,
                        'months' => "6"
                    ];
                })->filter(function ($sale) {
                    return $sale !== null;
                });

                $company->sales12 = $company->sales12->map(function ($sale) use ($productsFormatted, $company, $report) {
                    $code = $sale['code'];

                    $productConfigId = $productsFormatted
                        ->filter(function ($pc) use ($code) {
                            return in_array($code, $pc['codes']);
                        })
                        ->first();

                    if (!$productConfigId) {
                        return null;
                    }

                    return [
                        'quantity' => $sale['sales'],
                        'code' => $code,
                        'product_config_id' => $productConfigId['id'],
                        'report_id' => $report->id,
                        'company_id' => $company->id,
                        'months' => "12"
                    ];
                })->filter(function ($sale) {
                    return $sale !== null;
                });

                ReportSaleDetail::upsert($company->sales->toArray(), ['product_config_id', 'code', 'report_id', 'company_id', 'months'], ['quantity']);
                ReportSaleDetail::upsert($company->sales12->toArray(), ['product_config_id', 'code', 'report_id', 'company_id', 'months'], ['quantity']);

                $company->stocks = collect(json_decode($response->body(), true)['stocks']);
                $company->stocks = $company->stocks->map(function ($stock) use ($productsFormatted, $company, $report) {
                    $code = $stock['variant']['code'];

                    $productConfigId = $productsFormatted
                        ->filter(function ($pc) use ($code) {
                            return in_array($code, $pc['codes']);
                        })
                        ->first();

                    if (!$productConfigId) {
                        return null;
                    }

                    return [
                        'quantity' => $stock['total'],
                        'code' => $code,
                        'product_config_id' => $productConfigId['id'],
                        'report_id' => $report->id,
                        'company_id' => $company->id,
                        'offices_details' => json_encode($stock['offices'])
                    ];
                })->filter(function ($stock) {
                    return $stock !== null;
                });

                ReportStockDetail::upsert($company->stocks->toArray(), ['product_config_id', 'code', 'report_id', 'company_id'], ['quantity', 'offices_details']);
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }

        $report->led_concept_offices = $report->reportStockDetails->where('company_id', 1)->first();
        $report->led_concept_offices = $report->led_concept_offices ? $report->led_concept_offices->offices_details : [];
        $report->led_center_offices = $report->reportStockDetails->where('company_id', 2)->first();
        $report->led_center_offices = $report->led_center_offices ? $report->led_center_offices->offices_details : [];



        $report->load('reportSaleDetails', 'reportStockDetails');
        $report->reportSaleDetails = $report->reportSaleDetails->keyBy(function ($rs) {
            return "$rs->code/PI$rs->product_config_id/CO$rs->company_id/MS$rs->months";
        });

        $report->reportStockDetails = $report->reportStockDetails->groupBy(function ($rs) {
            return "PI$rs->product_config_id/CO$rs->company_id";
        });






        $productsConfig = $productsConfig->map(function ($p) use ($report) {
            $led_concept_sales = isset($report->reportSaleDetails["$p->sku_led_concept/PI$p->id/CO1/MS6"]);
            $led_center_sales = isset($report->reportSaleDetails["$p->sku_led_center/PI$p->id/CO2/MS6"]);
            $legacy_led_concept_sales = isset($report->reportSaleDetails["$p->legacy_sku_led_concept/PI$p->id/CO1/MS6"]);
            $legacy_led_center_sales = isset($report->reportSaleDetails["$p->legacy_sku_led_center/PI$p->id/CO2/MS6"]);
            $p->sku_led_concept_sales = $led_concept_sales ? $report->reportSaleDetails["$p->sku_led_concept/PI$p->id/CO1/MS6"]['quantity'] : 0;
            $p->sku_led_center_sales = $led_center_sales ? $report->reportSaleDetails["$p->sku_led_center/PI$p->id/CO2/MS6"]['quantity'] : 0;
            $p->legacy_sku_led_concept_sales = $legacy_led_concept_sales ? $report->reportSaleDetails["$p->legacy_sku_led_concept/PI$p->id/CO1/MS6"]['quantity'] : 0;
            $p->legacy_sku_led_center_sales = $legacy_led_center_sales ? $report->reportSaleDetails["$p->legacy_sku_led_center/PI$p->id/CO2/MS6"]['quantity'] : 0;

            //lo mismo para los 12 meses
            $led_concept_sales12 = isset($report->reportSaleDetails["$p->sku_led_concept/PI$p->id/CO1/MS12"]);
            $led_center_sales12 = isset($report->reportSaleDetails["$p->sku_led_center/PI$p->id/CO2/MS12"]);
            $legacy_led_concept_sales12 = isset($report->reportSaleDetails["$p->legacy_sku_led_concept/PI$p->id/CO1/MS12"]);
            $legacy_led_center_sales12 = isset($report->reportSaleDetails["$p->legacy_sku_led_center/PI$p->id/CO2/MS12"]);
            $p->sku_led_concept_sales12 = $led_concept_sales12 ? $report->reportSaleDetails["$p->sku_led_concept/PI$p->id/CO1/MS12"]['quantity'] : 0;
            $p->sku_led_center_sales12 = $led_center_sales12 ? $report->reportSaleDetails["$p->sku_led_center/PI$p->id/CO2/MS12"]['quantity'] : 0;
            $p->legacy_sku_led_concept_sales12 = $legacy_led_concept_sales12 ? $report->reportSaleDetails["$p->legacy_sku_led_concept/PI$p->id/CO1/MS12"]['quantity'] : 0;
            $p->legacy_sku_led_center_sales12 = $legacy_led_center_sales12 ? $report->reportSaleDetails["$p->legacy_sku_led_center/PI$p->id/CO2/MS12"]['quantity'] : 0;

            //map de stock

            $p->stock_led_concept = isset($report->reportStockDetails["PI$p->id/CO1"]) ? $report->reportStockDetails["PI$p->id/CO1"] : [];
            $p->stock_led_center = isset($report->reportStockDetails["PI$p->id/CO2"]) ? $report->reportStockDetails["PI$p->id/CO2"] : [];


            $p->stock_led_concept = collect($p->stock_led_concept)->flatMap(function ($item) {
                return collect($item->offices_details);
            })->groupBy('id')->map(function ($item) {
                return $item->sum('total');
            });

            $p->stock_led_center = collect($p->stock_led_center)->flatMap(function ($item) {
                return collect($item->offices_details);
            })->groupBy('id')->map(function ($item) {
                return $item->sum('total');
            });


            return $p;
        });

        $report->next = $this->siguienteCadena('V', count($report->led_concept_offices) + count($report->led_center_offices) - 1);

        // return (new RestockingReportExport($dataToExcel))->download('test.xlsx');


        $file = new RestockingReportExport($productsConfig, $report);
        $file = Excel::raw($file, \Maatwebsite\Excel\Excel::XLSX);

        Report::where('id', $report->id)->update(['generated' => true]);


        return $this->view('emails.reportmail')->attachData($file, "Reporte-Desde-$start-Hasta-$end12.xlsx", [
            "mime" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
        ]);
    }

    function siguienteCadena($cadena, $valorInicial)
    {
        $cadena = strtoupper($cadena); // Asegurarse de que la cadena sea en mayúsculas
        $numLetras = strlen($cadena);

        // Convertir la cadena de letras a un número utilizando el valor ASCII de cada letra
        $numero = 0;
        for ($i = 0; $i < $numLetras; $i++) {
            $numero = $numero * 26 + ord($cadena[$i]) - 65 + 1;
        }

        // Sumar el valor inicial al número
        $numero += $valorInicial;

        // Convertir el número resultante nuevamente a la cadena de letras
        $siguienteCadena = '';
        while ($numero > 0) {
            $letraAscii = ($numero - 1) % 26 + 65;
            $siguienteCadena = chr($letraAscii) . $siguienteCadena;
            $numero = intdiv($numero - 1, 26);
        }

        return $siguienteCadena;
    }
}
