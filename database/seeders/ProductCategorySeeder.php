<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'slug' => 'torty',
                'name' => 'Торты',
                'created_at' => today(),
                'updated_at' => today(),
            ],
            [
                'slug' => 'kapkeiki',
                'name' => 'Капкейки',
                'created_at' => today(),
                'updated_at' => today(),
            ],
        ];

        DB::table('product_categories')->insert($data);
    }
}
