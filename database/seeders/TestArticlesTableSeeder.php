<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'title' => '＜テスト＞サイトリニューアルのお知らせ',
            'posted_date' => '2025-01-10',
            'article_contents' => 'ウェブサイトをリニューアルしました。新機能も追加されています！'
        ]);

        Article::create([
            'title' => '＜テスト＞新サービス開始のお知らせ',
            'posted_date' => '2025-01-11',
            'article_contents' => '新しいサービスの提供を開始しました。ぜひご利用ください。'
        ]);
    }
}
