<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteOnCascadeProductMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_budgets', function (Blueprint $table) {

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->change();

            $table->foreign('budget_id')
                ->references('id')->on('budgets')
                ->onDelete('cascade')
                ->change();
        });
    }
}
