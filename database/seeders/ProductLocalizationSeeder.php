<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductLocalizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_localization')->insert([
            [
                'product_id' => '2',
                'localization_name' => 'en',
                'product_description' => 'boots'
            ],
            [
                'product_id' => '2',
                'localization_name' => 'ru',
                'product_description' => 'боты'
            ],
            [
                'product_id' => '3',
                'localization_name' => 'en',
                'product_description' => 'white hoodie'
            ],
            [
                'product_id' => '3',
                'localization_name' => 'ru',
                'product_description' => 'белый худи'
            ],
            [
                'product_id' => '4',
                'localization_name' => 'en',
                'product_description' => 'red hoodie'
            ],
            [
                'product_id' => '4',
                'localization_name' => 'ru',
                'product_description' => 'красный худи'
            ],
            [
                'product_id' => '5',
                'localization_name' => 'en',
                'product_description' => 'black hoodie'
            ],
            [
                'product_id' => '5',
                'localization_name' => 'ru',
                'product_description' => 'черный худи'
            ],
            [
                'product_id' => '25',
                'localization_name' => 'en',
                'product_description' => 'tapki'
            ],
            [
                'product_id' => '25',
                'localization_name' => 'ru',
                'product_description' => 'тапки'
            ],
        ]);
    }
}
