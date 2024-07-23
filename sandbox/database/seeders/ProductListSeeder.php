<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_lists')->insert(
            [
              [
                'name' => 'テストパン',
                'price' => 500,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
              ],
              [
                'name' => 'テストそば',
                'price' => 600,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
              ],
              [
                'name' => 'テスト丼',
                'price' => 700,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
              ],
              [
                'name' => 'テスト饅頭',
                'price' => 200,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
              ],
              [
                'name' => 'テストサンド',
                'price' => 350,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
              ],
            ]
          );
    }
}
