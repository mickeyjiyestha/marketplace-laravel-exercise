<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('products')->insert([
        'name' => 'Produk A',
        'price' => 100,
        'stock' => 50,
        'category_id' => 1,
        'brand_id' => 1,
        'created_at' => $now,
        'updated_at' => $now
        ]);

        DB::table('products')->insert([
        'name' => 'Produk B',
        'price' => 150,
        'stock' => 30,
        'category_id' => 2,
        'brand_id' => 2,
        'created_at' => $now,
        'updated_at' => $now,
        ]);

        DB::table('products')->insert([
            'name' => 'Produk C',
            'price' => 150,
            'stock' => 30,
            'category_id' => 2,
            'brand_id' => 2,
            'created_at' => $now,
            'updated_at' => $now,
            ]);

            DB::table('products')->insert([
                'name' => 'Produk D',
                'price' => 150,
                'stock' => 30,
                'category_id' => 2,
                'brand_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
                ]);

                DB::table('products')->insert([
                    'name' => 'Produk E',
                    'price' => 150,
                    'stock' => 30,
                    'category_id' => 2,
                    'brand_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                    ]);
            
    }
}