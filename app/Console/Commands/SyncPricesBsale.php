<?php

namespace App\Console\Commands;

use App\Models\LogUpdateProductPrice;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SyncPricesBsale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:sync-bsale-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza los precios de bsale con los del sistema';

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
        $this->info('Iniciando sync de precios...');

        $url = 'https://api.bsale.io/v1/price_lists/3/details.json';
        $itemsPerPage = 50;
        $offset = 0;

        $products = Product::whereNotNull('bsale_variant_id')->get(['id', 'sku', 'bsale_variant_id', 'price']);

        $timesUpdate = 0;
        $timesMatch = 0;

        Log::info('SYNC PRICES');

        do {
            $response = Http::withHeaders([
                "access_token" => '8c61e6d761ecedd08e7b473ec3adb173fa5564f5'
            ])->get($url, [
                'limit' => $itemsPerPage,
                'offset' => $offset
            ]);

            $data = json_decode($response->getBody(), true);
            $items = collect($data['items']);

            $items->each(function ($priceItem) use ($products, &$timesUpdate, &$timesMatch) {
                $variantId = $priceItem['variant']['id'];
                $match = $products->firstWhere('bsale_variant_id', $variantId);
                if ($match) {
                    $this->info('Match de producto...');
                    if ($match->price != $priceItem['variantValueWithTaxes']) {
                        $match->price = $priceItem['variantValueWithTaxes'];
                        $match->save();
                        $timesUpdate++;
                    } else {
                        $timesMatch++;
                    }
                }
            });


            $offset += $itemsPerPage;
        } while ($offset < $data['count']);

        LogUpdateProductPrice::create([
            'prices_updated' => $timesUpdate,
            'products_actually_price' => $timesMatch,
            'products_matched' => $products->count(),
        ]);

        return true;
    }
}
