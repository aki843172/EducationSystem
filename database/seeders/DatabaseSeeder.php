<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // 実行順序を指定
         $this->call([
            TestGradesTableSeeder::class,
            TestUsersTableSeeder::class,
            TestCurriculumsTableSeeder::class,
            TestArticlesTableSeeder::class,
            TestBannerTableSeeder::class
        ]);
    }
}
