<?php

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = \App\Store::all();

        // Faz um seed de um produto para cada loja
        foreach ($stores as $store) {
            $store->product()->save(
                factory(\App\Product::class)->make()
            );
        }
    }
}
