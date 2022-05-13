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
        Schema::create('promotion_vouchers', function (Blueprint $table) {
            $table->string('voucher_code')->unique()->primary();
            $table->timestamps();
            $table->string("voucher_name");
            $table->string("voucher_description");
            $table->integer("discount");
            $table->dateTime("expiry_date");
            $table->integer("price_limit");
            $table->string("discount_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_vouchers');
    }
};
