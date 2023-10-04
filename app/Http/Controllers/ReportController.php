<?php

namespace App\Http\Controllers;

use App\Events\SendMailEvent;
use App\Exports\ProductConfigExport;
use App\Exports\RestockingReportExport;
use App\Imports\ProductConfigImport;
use App\Jobs\JobWorker;
use App\Mail\ReportMail;
use App\Models\Company;
use App\Models\ProductConfig;
use App\Models\Report;
use App\Models\ReportSaleDetail;
use App\Models\ReportStockDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('reports.index', compact('companies'));
    }

    public function getReports()
    {
        $reports = Report::orderBy('created_at', 'DESC')->get();
        $reports->map(function ($r) {
            $r->userName = $r->user->name;
            return $r;
        });
        return $reports;
    }

    public function all_by_dates(Request $request)
    {
        $user = auth()->user();

        $reportId = $request->input('report', null);

        if ($reportId) {
            $report = Report::find($reportId);
        } else {
            $report = null;
        }

        JobWorker::dispatch($report, $request->input('start'), $request->input('emails', []), $user);
        return "correo enviado";
    }

    public function testMail()
    {
        /* Mail::to('dyjps2012@gmail.com')->send(new ReportMail()); */
        return "correo enviado";
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

    public function updateMassiveProducts(Request $request)
    {
        try {
            $file = $request->file('file');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('product_configs')->truncate();
            DB::table('reports')->truncate();
            DB::table('report_stock_details')->truncate();
            DB::table('report_sale_details')->truncate();
            DB::table('jobs')->truncate();
            DB::table('failed_jobs')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Excel::import(new ProductConfigImport, $file);
            return redirect()->back();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function downloadExcel()
    {
        return Excel::download(new ProductConfigExport, 'productos-plantilla.xlsx');
    }
}
