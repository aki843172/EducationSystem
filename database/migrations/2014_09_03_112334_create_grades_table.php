<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 学年の名前を登録
        DB::table('grades')->insert([
            ['id' => 1, 'name' => '小学校１年生'],
            ['id' => 2, 'name' => '小学校２年生'],
            ['id' => 3, 'name' => '小学校３年生'],
            ['id' => 4, 'name' => '小学校４年生'],
            ['id' => 5, 'name' => '小学校５年生'],
            ['id' => 6, 'name' => '小学校６年生'],
            ['id' => 7, 'name' => '中学校１年生'],
            ['id' => 8, 'name' => '中学校２年生'],
            ['id' => 9, 'name' => '中学校３年生'],
            ['id' => 10, 'name' => '高校１年生'],
            ['id' => 11, 'name' => '高校２年生'],
            ['id' => 12, 'name' => '高校３年生'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
};
