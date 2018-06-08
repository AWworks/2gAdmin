<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodCategoryFoodItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodCategory_foodItem', function (Blueprint $table) {
            $table->integer('foodCategory_id')->unsigned();
            $table->integer('foodItem_id')->unsigned();

            $table->foreign('foodCategory_id')->references('id')->on('food_categories')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('foodItem_id')->references('id')->on('food_items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['foodCategory_id', 'foodItem_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foodCategory_foodItem');
    }
}
