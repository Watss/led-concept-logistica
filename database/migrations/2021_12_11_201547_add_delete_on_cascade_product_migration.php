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
        Schema::table('details_budgets', function (Blueprint $table) {

            $table->dropForeign(['product_id']);

            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade')
                ->change();
                
            $table->dropForeign(['budget_id']);

            $table->foreign('budget_id')
                ->references('id')->on('budgets')
                ->onDelete('cascade')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
