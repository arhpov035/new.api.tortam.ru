<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Filling;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(FillingSeeder::class);
//        Product::factory(30)->create();
    }
}
