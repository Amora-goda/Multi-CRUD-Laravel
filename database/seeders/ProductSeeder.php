<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{

    public function run()
    {
        $faker = Factory::create();
        $subCats = Subcategory::all();


            foreach ($subCats as $cat) {
                for ($i = 1; $i <= 3; $i++) {

                        $product = Product::create([
                            'name' => $cat->name,
                            'price' => $faker->randomFloat(2, 100, 5000),
                            'image' => 'https://via.placeholder.com/150?text=' . str_replace(' ', '+', $cat->name),
                            'subcategory_id' => $cat->id,
                        
                        ]);
                }

        }
    }
 }
