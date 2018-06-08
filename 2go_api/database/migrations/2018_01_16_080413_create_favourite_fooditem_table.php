<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouriteFooditemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourite_fooditem', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('foodItem_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('api_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('foodItem_id')->references('id')->on('food_items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'foodItem_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_fooditem');
    }
}
