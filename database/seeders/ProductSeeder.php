<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Name 1',
                'sku' => 'Sku 1'
            ],
            [
                'name' => 'Name 2',
                'sku' => 'Sku 2'
            ],
            [
                'name' => 'Name 3',
                'sku' => 'Sku 3'
            ],
            [
                'name' => 'Name 4',
                'sku' => 'Sku 4'
            ]
        ];
        foreach ($products as $product)
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
    }
}
