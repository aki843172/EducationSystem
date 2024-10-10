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
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->id();
            // 外部キー制約
            $table->unsignedBigInteger('curriculums_id');
            $table->foreign('curriculums_id')->references('id')->on('curriculums');
            $table->dateTime('delivery_from');
            $table->dateTime('delivery_to');
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
        Schema::dropIfExists('delivery_times');
    }
};
