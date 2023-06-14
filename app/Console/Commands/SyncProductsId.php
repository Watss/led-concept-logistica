<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncProductsId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:sync-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando sincroniza los productos internos del cotizador con los id de variantes de bsale';

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
        $this->info('Iniciando sync...');

        $url = 'https://api.bsale.io/v1/variants.json';
        $itemsPerPage = 50;
        $offset = 0;

        $products = Product::get(['sku', 'id', 'bsale_variant_id']);


        do {
            $response = Http::withHeaders([
                "access_token" => '8c61e6d761ecedd08e7b473ec3adb173fa5564f5'
            ])->get($url, [

                'fields' => '[description,code]',
                'limit' => $itemsPerPage,
                'offset' => $offset

            ]);

            $data = json_decode($response->getBody(), true);
            $items = collect($data['items']);

            $items->each(function ($variant) use ($products) {
                $match = $products->where('sku', $variant['code'])->first();

                if ($match) {
                    $match->bsale_variant_id = $variant['id'];
                    $match->save();
                }
            });


            $offset += $itemsPerPage;
        } while ($offset < $data['count']);

        return 1;
    }
}
