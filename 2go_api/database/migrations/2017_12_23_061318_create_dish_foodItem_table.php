<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishFoodItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_foodItem', function (Blueprint $table) {
            $table->integer('dish_id')->unsigned();
            $table->integer('foodItem_id')->unsigned();

            $table->foreign('dish_id')->references('id')->on('dishes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('foodItem_id')->references('id')->on('food_items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['dish_id', 'foodItem_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_foodItem');
    }
}
