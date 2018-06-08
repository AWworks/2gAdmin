<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('restaurantName');
            $table->string('restaurantNumber');
            $table->string('contactNumber');
            $table->string('restaurantAddress');
            $table->integer('pincode');
            $table->string('restaurantCuisine_id');
            $table->string('restaurantMenu_id');
            $table->string('open_close_Time');
            $table->string('restaurantImages');
            $table->string('restaurantStatus');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
