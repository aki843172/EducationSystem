<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
              'name' => 'カツオ',
              'name_kana' => 'カツオ',
              'email' => 'katsuo@gmail.com',
              'password' => Hash::make('katsuotest'),
              'profile_image' => null,
              'grade_id' => '1',
            ],
            [
              'name' => 'ワカメ',
              'name_kana' => 'ワカメ',
              'email' => 'wakame@gmail.com',
              'password' => Hash::make('wakametest'),
              'profile_image' => null,
              'grade_id' => '2',
            ],
          ]);
    }
}
