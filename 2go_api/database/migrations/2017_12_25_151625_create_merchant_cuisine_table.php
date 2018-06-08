<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantCuisineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_cuisine', function (Blueprint $table) {
            $table->integer('merchant_id')->unsigned();
            $table->integer('cuisine_id')->unsigned();

            $table->foreign('merchant_id')->references('id')->on('merchants')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cuisine_id')->references('id')->on('cuisines')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['merchant_id', 'cuisine_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_cuisine');
    }
}
