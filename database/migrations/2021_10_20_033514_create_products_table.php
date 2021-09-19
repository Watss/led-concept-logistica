<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->nullable()->constrained();
            $table->string('sku', 100);
            $table->longText('name');
            $table->string('barcode', 20)->nullable();
            $table->string('brand_id')->nullable();
            $table->boolean('temporary')->default(0);
            $table->integer('price');
            $table->boolean('status')->default(0);
            $table->string('image', 300)->nullable();
            $table->timestamps();

            Schema::enableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
