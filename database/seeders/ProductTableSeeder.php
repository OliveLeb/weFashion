<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
        ->count(80)
        ->create()->each(function($product) {

            // get random array of sizes for the product
            $sizes = Size::pluck('id')->shuffle()->slice(0,rand(1,5))->all();
            $product->sizes()->attach($sizes);

            // get the category and add the right type of picture
            $category = Category::pluck('id')->shuffle()->shift();
            $product->categories()->attach($category);

            if($category == '1') {
                $file = Storage::disk('local')->files('hommes');
            }else {
                $file = Storage::disk('local')->files('femmes');
            }

            $link = collect($file)->shuffle()->shift();

            $product->picture()->create([
                'title'=>$product->name,
                'link' => $link
            ]);

            $product->save();
        });
    }
}
