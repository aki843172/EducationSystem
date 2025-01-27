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
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->dropColumn(['curriculum_id', 'user_id']);
        });
    
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('curriculums_id');
            $table->unsignedBigInteger('users_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->dropColumn(['curriculums_id', 'users_id']);
        });
    
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('curriculum_id');
            $table->unsignedBigInteger('user_id');
        });
    }
};
