<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('count')->nullable();
            $table->integer('foodItem_id')->unsigned()->nullable();
            $table->integer('size_id')->unsigned()->nullable();
            $table->integer('addOnItem_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('combo_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('foodItem_id')->references('id')->on('food_items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('api_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('addOnItem_id')->references('id')->on('add_on_items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('combo_id')->references('id')->on('combos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('food_items')
                ->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
