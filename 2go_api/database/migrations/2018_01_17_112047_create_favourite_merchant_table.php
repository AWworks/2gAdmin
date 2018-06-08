<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouriteMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_merchant', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('merchant_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('api_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('merchant_id')->references('id')->on('merchants')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'merchant_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourite_merchant');
    }
}
