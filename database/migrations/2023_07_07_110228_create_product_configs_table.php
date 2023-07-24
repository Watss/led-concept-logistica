<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_configs', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nullable();
            $table->text('proveedor')->nullable();
            $table->string('sku_led_concept')->nullable();
            $table->string('sku_led_center')->nullable();
            $table->string('legacy_sku_led_concept')->nullable();
            $table->string('legacy_sku_led_center')->nullable();
            $table->index(['sku_led_concept', 'sku_led_center']);
            $table->unique(['sku_led_concept', 'sku_led_center']);

            $table->timestamps();
        });
        DB::statement('ALTER TABLE product_configs ADD CONSTRAINT at_least_one_sku_not_null CHECK (sku_led_concept IS NOT NULL OR sku_led_center IS NOT NULL)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_configs');
    }
}
