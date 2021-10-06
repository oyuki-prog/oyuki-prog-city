<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => '1', 'name' => 'グルメ'],
            ['id' => '2', 'name' => 'イベント'],
            ['id' => '3', 'name' => '自然'],
            ['id' => '4', 'name' => '観光'],
            ['id' => '5', 'name' => '偉人'],
            ['id' => '6', 'name' => '遊び場'],
        ];
        DB::table('categories')->insert($categories);
    }
}
