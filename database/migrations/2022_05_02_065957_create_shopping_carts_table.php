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
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('good_id');
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('variation_id')->nullable();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('good_id')->references('id')->on('goods');
            $table->foreign('variation_id')->references('id')->on('good_varieties');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_carts');
    }
};
