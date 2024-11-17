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
        DB::table('admins')->insert([
            [
              'kana' => 'カツオ',
              'name' => 'カツオ',
              'email' => 'katsuo@gmail.com',
              'password' => Hash::make('katsuotest'),
            ],
            [
              'kana' => 'ワカメ',
              'name' => 'ワカメ',
              'email' => 'wakame@gmail.com',
              'password' => Hash::make('wakametest'),
            ],
          ]);
    }
}
