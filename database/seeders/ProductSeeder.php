<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $json = file_get_contents(database_path("data/electronic-catalog.json"));
        $data = json_decode($json,true);

        foreach ($data['products'] as $product) {
            Product::create($product);
        }
    }
}
