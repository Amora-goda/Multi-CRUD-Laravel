<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Category;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Factory::create();
        $categories = Category::all();
        foreach ($categories as $category) {
            for ($i = 1; $i <= 2; $i++) {
                Subcategory::create([
                    'name' => $category->name . ' ' . $i,
                    'category_id' => $category->id,
                ]);
            }



        }

    }
}
