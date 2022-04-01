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
        Schema::create('good_varieties', function (Blueprint $table) {
            $table->id()->unique();
            $table->timestamps();
            $table->unsignedBigInteger('good_id');
            $table->string('variety_name');
            $table->boolean('is_available')->default(true);

            $table->foreign('good_id')->references('id')->on('goods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('good_varieties');
    }
};
