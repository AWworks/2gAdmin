<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('merchantName');
            $table->string('merchantDescription');
            $table->string('merchantMobile');
            $table->string('merchantEmail');
            $table->string('merchantAddress');
            $table->string('merchantArea');
            $table->string('merchantCoordinates');
            $table->string('merchantOpenClose');
            $table->string('merchantAvgTime');
            $table->string('merchantCurrentStatus');
            $table->string('merchantAge');
            $table->string('merchantAvgBill');
            $table->string('merchantParkingStatus');
            $table->string('merchantStatus');
            $table->string('merchantCreator');
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
        Schema::dropIfExists('merchants');
    }
}
