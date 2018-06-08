<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantPayModeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_payMode', function (Blueprint $table) {
            $table->integer('merchant_id')->unsigned();
            $table->integer('payMode_id')->unsigned();

            $table->foreign('merchant_id')->references('id')->on('merchants')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('payMode_id')->references('id')->on('paymentModes')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['merchant_id', 'payMode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_payMode');
    }
}
