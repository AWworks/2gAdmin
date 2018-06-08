<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucherName')->unique();
            $table->string('voucherType');
            $table->string('voucherAmount');
            $table->string('voucherExpiry');
            $table->integer('voucherMerchant')->unsigned();
            $table->string('voucherTimes');
            $table->string('voucherCount');
            $table->string('voucherStatus');
            $table->string('voucherCreator');
            $table->timestamps();

            $table->foreign('voucherMerchant')->references('id')->on('merchants')
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
        Schema::dropIfExists('vouchers');
    }
}
