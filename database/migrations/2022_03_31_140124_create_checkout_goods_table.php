<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_goods', function (Blueprint $table) {
            $table->id()->unique();
            $table->timestamps();
            // order_id, good_id, quantity,variety
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('good_id');
            $table->unsignedBigInteger('variety_id');
            $table->unsignedInteger('quantity');
            $table->string('voucher_code');

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('good_id')->references('id')->on('goods');
            $table->foreign('variety_id')->references('id')->on('good_varieties');
            $table->foreign('voucher_code')->references('voucher_code')->on('promotion_vouchers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkout_goods');
    }
};
