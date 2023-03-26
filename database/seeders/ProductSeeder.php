<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "name" => "Es Rendang",
            "stock" => 3,
            "category_id" => 2,
        ]);
        Product::create([
            "name" => "Nasi Dingin",
            "stock" => 3,
            "category_id" => 1,
        ]);
    }
}
