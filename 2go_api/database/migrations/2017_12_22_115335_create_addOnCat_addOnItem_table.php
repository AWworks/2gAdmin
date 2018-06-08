<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddOnCatAddOnItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addOnCat_addOnItem', function (Blueprint $table) {
            $table->integer('addOnCat_id')->unsigned();
            $table->integer('addOnItem_id')->unsigned();

            $table->foreign('addOnCat_id')->references('id')->on('add_on_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('addOnItem_id')->references('id')->on('add_on_items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['addOnCat_id', 'addOnItem_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addOnCat_addOnItem');
    }
}
