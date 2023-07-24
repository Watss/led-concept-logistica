<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportStockDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_stock_details', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->string('code', 255);
            $table->foreignId('product_config_id')->constrained('product_configs')->onDelete('cascade');
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies');
            $table->json('offices_details');
            $table->unique(['code', 'product_config_id', 'report_id', 'company_id'], 'unique_code_product_config_report_company');
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
        Schema::dropIfExists('report_stock_details');
    }
}
