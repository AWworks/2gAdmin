<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodCategoryDishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_foodCategory', function (Blueprint $table) {
            $table->integer('dish_id')->unsigned();
            $table->integer('foodCategory_id')->unsigned();

            $table->foreign('dish_id')->references('id')->on('dishes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('foodCategory_id')->references('id')->on('food_categories')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['dish_id', 'foodCategory_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foodCategory_dish');
    }
}
