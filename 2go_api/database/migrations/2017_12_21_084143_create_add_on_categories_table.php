<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddOnCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addOnCatName')->unique();
            $table->string('addOnCatDescription');
            $table->string('addOnCatStatus');
            $table->string('addOnCatCreator');
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
        Schema::dropIfExists('add_on_categories');
    }
}
