<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestBannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::create([
            'image'=>'storage\images\banner\test_banner.png'
        ]);

        Banner::create([
            'image'=>'storage\images\banner\バナー画像１.png'
        ]);

        Banner::create([
            'image'=>'storage\images\banner\バナー画像2.png'
        ]);
    }
}
