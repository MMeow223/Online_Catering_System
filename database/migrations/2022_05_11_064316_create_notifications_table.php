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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('notification_title');
            $table->string('notification_description');
            $table->string('notification_image');
            $table->unsignedBigInteger('notification_type_id');
            $table->timestamps();

            $table->foreign('notification_type_id')->references('id')->on('notification_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
