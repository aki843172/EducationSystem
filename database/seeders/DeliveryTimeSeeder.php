<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $delivery_date1 = Carbon::parse('2024-04-01');
        $delivery_date2 = Carbon::parse('2024-09-30');
        $delivery_date3 = Carbon::parse('2024-10-01');
        $delivery_date4 = Carbon::parse('2025-03-31');

        // 1日の初め（00:00:00）
        $delivery_from1 = $delivery_date1->startOfDay();
        $delivery_from2 = $delivery_date3->startOfDay();

        // 1日の終わり（23:59:59）
        $delivery_to1 = $delivery_date2->endOfDay();
        $delivery_to2 = $delivery_date4->endOfDay();


        // コピー用
        // 'delivery_from' => $delivery_from1,
        // 'delivery_to' => $delivery_to1,

        // 'delivery_from' => $delivery_from2,
        // 'delivery_to' => $delivery_to2,


        DB::table('delivery_times')->insert([

            [ //小学1年生オフ
                'id' => null,
                'curriculums_id' => '1',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '2',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '3',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [ //小学1年生オン
                'id' => null,
                'curriculums_id' => '4',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '5',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '6',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学2年生オフ
                'id' => null,
                'curriculums_id' => '7',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '8',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '9',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学2年生オン
                'id' => null,
                'curriculums_id' => '10',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '11',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '12',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学3年生オフ
                'id' => null,
                'curriculums_id' => '13',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '14',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '15',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学3年生オン
                'id' => null,
                'curriculums_id' => '16',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '17',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '18',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学4年生オフ
                'id' => null,
                'curriculums_id' => '19',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '20',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '21',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学4年生オン
                'id' => null,
                'curriculums_id' => '22',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '23',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '24',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学5年生オフ
                'id' => null,
                'curriculums_id' => '25',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '26',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '27',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
                    ],
            [//小学5年生オン
                'id' => null,
                'curriculums_id' => '28',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '29',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '30',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//小学6年生オフ
                'id' => null,
                'curriculums_id' => '31',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '32',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '33',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//小学6年生オン
                'id' => null,
                'curriculums_id' => '34',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '35',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [
                'id' => null,
                'curriculums_id' => '36',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//中学1年生オフ
                'id' => null,
                'curriculums_id' => '37',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [//中学1年生オン
                'id' => null,
                'curriculums_id' => '38',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//中学2年生オフ
                'id' => null,
                'curriculums_id' => '39',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [//中学2年生オン
                'id' => null,
                'curriculums_id' => '40',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//中学3年生オフ
                'id' => null,
                'curriculums_id' => '41',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [//中学3年生オン
                'id' => null,
                'curriculums_id' => '42',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//高校1年生オフ
                'id' => null,
                'curriculums_id' => '43',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [//高校1年生オン
                'id' => null,
                'curriculums_id' => '44',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//高校2年生オフ
                'id' => null,
                'curriculums_id' => '45',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [//高校2年生オン
                'id' => null,
                'curriculums_id' => '46',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ],
            [//高校3年生オフ
                'id' => null,
                'curriculums_id' => '47',
                'delivery_from' => $delivery_from1,
                'delivery_to' => $delivery_to1,
            ],
            [//高校3年生オン
                'id' => null,
                'curriculums_id' => '48',
                'delivery_from' => $delivery_from2,
                'delivery_to' => $delivery_to2,
            ]
        ]);
    }
}
