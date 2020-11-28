<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryLocalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_localization')->insert([
            [
                'category_id' => 1,
                'localization_name' => 'en',
                'category_name' => 'shoes'
            ],
            [
                'category_id' => 1,
                'localization_name' => 'ru',
                'category_name' => 'обувь'
            ],
            [
                'category_id' => 2,
                'localization_name' => 'en',
                'category_name' => 'outerwear'
            ],
            [
                'category_id' => 2,
                'localization_name' => 'ru',
                'category_name' => 'верхняя одежда'
            ]
        ]);
    }
}
