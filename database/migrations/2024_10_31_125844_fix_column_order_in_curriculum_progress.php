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
            
                // 一旦全部のカラムを削除
                $table->dropColumn([
                    'clear_flg',
                    'created_at',
                    'updated_at',
                    'curriculums_id',
                    'users_id'
                ]);
            });
        
            Schema::table('curriculum_progress', function (Blueprint $table) {
                // 望む順序で追加し直す
                $table->unsignedBigInteger('curriculums_id')->after('id');
                $table->unsignedBigInteger('users_id')->after('curriculums_id');
                $table->tinyInteger('clear_flg')->default(0)->after('users_id');
                $table->timestamps();  // created_atとupdated_atを追加
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
            $table->dropColumn([
                'curriculums_id',
                'users_id',
                'clear_flg',
                'created_at',
                'updated_at'
            ]);
        });
    
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->unsignedBigInteger('curriculums_id');
            $table->unsignedBigInteger('users_id');
            $table->tinyInteger('clear_flg')->default(0);
            $table->timestamps();
        });
       
    }
};
