<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Deliverytime extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 未作成
        DB::table('delivery_times')->insert([
            [
              'curriculums_id' => '1',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '2',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '3',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '4',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '5',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '6',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '7',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '8',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '9',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '10',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            [
              'curriculums_id' => '11',
              'delivery_from' => '20240401',
              'delivery_to' => '20240930',
            ],
            
          ]);
    }
}
