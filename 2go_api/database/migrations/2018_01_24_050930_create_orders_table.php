<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->string('transaction_id');
            $table->integer('user_id');
            $table->integer('foodItem_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('addOnItem_id')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('combo_id')->nullable();
            $table->integer('count');
            $table->string('price');
            $table->string('totalPrice');
            $table->string('voucher_id')->nullable();
            $table->string('discount');
            $table->string('discountedAmount');
            $table->string('Status');
            $table->string('orderTime');
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
        Schema::dropIfExists('orders');
    }
}
