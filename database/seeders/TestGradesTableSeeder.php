<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;


class TestGradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // 小学生（1-6年）
        Grade::create([
            'name' => '小学1年生',
        ]);
        Grade::create([
            'name' => '小学2年生',
        ]);
        Grade::create([
            'name' => '小学3年生',
        ]);
        Grade::create([
            'name' => '小学4年生',
        ]);
        Grade::create([
            'name' => '小学5年生',
        ]);
        Grade::create([
            'name' => '小学6年生',
        ]);

        // 中学生（1-3年）
        Grade::create([
            'name' => '中学1年生',
        ]);
        Grade::create([
            'name' => '中学2年生',
        ]);
        Grade::create([
            'name' => '中学3年生',
        ]);

        // 高校生（1-3年）
        Grade::create([
            'name' => '高校1年生',
        ]);
        Grade::create([
            'name' => '高校2年生',
        ]);
        Grade::create([
            'name' => '高校3年生',
        ]);
    }
}
    