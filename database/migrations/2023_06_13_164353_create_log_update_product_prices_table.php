<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogUpdateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_update_product_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prices_updated')->default(0);
            $table->bigInteger('products_matched')->default(0);
            $table->bigInteger('products_actually_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_update_product_prices');
    }
}
