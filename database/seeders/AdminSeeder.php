<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
              'id' => null,
              'name' => 'サザエ',
              'kana' => 'サザエ',
              'email' => 'sazae@gmail.com',
              'password' => Hash::make('sazaetest'),
            ],
            [
              'id' => null,
              'name' => 'マスオ',
              'kana' => 'マスオ',
              'email' => 'masuo@gmail.com',
              'password' => Hash::make('masuotest'),
            ],
          ]);
    }
}
