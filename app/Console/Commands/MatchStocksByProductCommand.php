<?php

namespace App\Console\Commands;

use App\Models\ProductConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

use function PHPUnit\Framework\isEmpty;

class MatchStocksByProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:match-stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $arregloA = [
            "A660040" => 200,
            "X42" => 300,
            "IWU2" => 100
        ];

        $arregloB = [
            "A1FS" => 200,
            "X42" => 300,
            "IWU2" => 100
        ];

        $productos =  ProductConfig::get(['id', 'sku1', 'sku2', 'sku3']);

        $totalProductos = $productos->map(function ($producto) use ($arregloA, $arregloB) {
            $nombre = $producto->id;
            $skus = collect([strtoupper($producto->sku1), strtoupper($producto->sku2), strtoupper($producto->sku3)])
                ->filter(function ($sku) {
                    return !is_null($sku);
                });

            $total = $skus->sum(function ($codigo) use ($arregloA, $arregloB) {
                $suma = 0;
                if (array_key_exists($codigo, $arregloA) && is_numeric($arregloA[$codigo])) {
                    $suma += $arregloA[$codigo];
                }
                if (array_key_exists($codigo, $arregloB) && is_numeric($arregloB[$codigo])) {
                    $suma += $arregloB[$codigo];
                }
                return $suma;
            });



            return collect([$nombre => $total]);
        });



        return true;
    }
}
