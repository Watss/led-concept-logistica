<?php

namespace App\Http\Controllers;

use App\Events\SendMailEvent;
use App\Exports\RestockingReportExport;
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
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function all_by_dates(Request $request)
    {

        $next = $this->siguienteCadena('V', 8);
        /* $start = '2022-07-19';

        


        $end6 = Carbon::create($start)->addMonths(6)->format('Y-m-d');
        $end12 = Carbon::create($start)->addMonths(12)->format('Y-m-d');; */

        JobWorker::dispatch();
        return "correo enviado";

        //return view('excel.restocking-report', compact('productsConfig', 'report', 'next'));
        //return view('reports.all_by_dates', compact('totalProductos'));
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
}
