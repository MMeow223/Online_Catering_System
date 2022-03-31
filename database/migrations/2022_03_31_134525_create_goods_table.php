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
        Schema::create('goods', function (Blueprint $table) {
            $table->id()->unique();
            $table->timestamps();
            $table->string('good_name');
            $table->string('good_description');
            $table->string('good_image');
            $table->string('good_price');
            $table->unsignedBigInteger('good_category_id');
            $table->string('is_warm');
            $table->string('is_available');

            $table->foreign('good_category_id')->references('id')->on('good_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
};
