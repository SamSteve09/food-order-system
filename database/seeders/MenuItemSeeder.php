<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_items')->insert([
            [
                'name' => 'Double Cheeseburger',
                'description' => 'Burger dengan dua keju yang lezat.',
                'price' => 30000,
                'category' => 'Burger',
                'order_frequency' => 0,
                'availability' => true,
                'image' => 'https://drive.google.com/file/d/1I-JW8PmDH_gwB95LyoIFlj78t2x4ycNc/view?usp=drive_link',
                'menu_item_date' => now(),
            ],
            [
                'name' => 'Chicken Burger',
                'description' => 'Burger klasik dengan isi ayam kriuk.',
                'price' => 20000,
                'category' => 'Burger',
                'order_frequency' => 100,
                'availability' => true,
                'image' => 'https://drive.google.com/file/d/1I-JW8PmDH_gwB95LyoIFlj78t2x4ycNc/view?usp=drive_link',
                'menu_item_date' => now(),
            ],
            [
                'name' => 'TC Fried Chicken',
                'description' => 'Ayam goreng tepung khas KTC.',
                'price' => 25000,
                'rating' => 4,
                'category' => 'Favorite',
                'order_frequency' => 80,
                'availability' => true,
                'image' => 'https://drive.google.com/file/d/1MS7DQwjKUef6_w5Jfwhi5mXbJ5gNHCy5/view?usp=drive_link',
                'menu_item_date' => now(),
            ]
        ]);
    }
}
