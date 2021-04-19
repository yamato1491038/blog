<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'id' => 1,
                'name' => 'ナイト'
            ],
            [
                'id' => 2,
                'name' => '黒魔道士'
            ],
            [
                'id' => 3,
                'name' => 'モンク'
            ],
            [
                'id' => 4,
                'name' => '召喚士'
            ],
            [
                'id' => 5,
                'name' => '竜騎士'
            ],
            [
                'id' => 6,
                'name' => 'ものまね師'
            ],
            [
                'id' => 7,
                'name' => 'すっぴん'
            ],
        ]);
    }
}
