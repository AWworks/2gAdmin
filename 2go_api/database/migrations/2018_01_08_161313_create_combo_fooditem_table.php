<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboFooditemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_fooditem', function (Blueprint $table) {
            $table->integer('combo_id')->unsigned();
            $table->integer('foodItem_id')->unsigned();

            $table->foreign('combo_id')->references('id')->on('combos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('foodItem_id')->references('id')->on('food_items')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['combo_id', 'foodItem_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combo_fooditem');
    }
}
