<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('packageName')->unique();
            $table->string('packageDescription');
            $table->string('packagePrice');
            $table->string('packagePromoPrice');
            $table->string('packageExpiration');
            $table->string('packageUsage');
            $table->string('packageNoItem');
            $table->string('packageLimit');
            $table->string('packageStatus');
            $table->string('packageCreator');
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
        Schema::dropIfExists('packages');
    }
}
