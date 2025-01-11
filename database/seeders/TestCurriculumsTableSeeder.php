<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class TestCurriculumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curriculum::create([
            'title' => 'テスト動画1',
            'description' => 'これはテスト用の動画です',
            'video_url' => 'videos/test_video1.mp4',
            'grade_id' => 1,
            'always_delivery_flg' => 1
        ]);

        Curriculum::create([
            'title' => 'テスト動画2',
            'description' => 'これは非公開のテスト用動画です',
            'video_url' => 'https://example.com/video2.mp4',
            'grade_id' => 1,
            'always_delivery_flg' => 0  // falseを0に変更
        ]);
    
        
        
    }

}
