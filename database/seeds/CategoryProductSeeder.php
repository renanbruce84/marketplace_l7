<?php

use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = \App\Product::all();

        foreach ($products as $product) {
            $product->category()->save(
                factory(\App\Category::class)->make()
            );
        }
    }
}
