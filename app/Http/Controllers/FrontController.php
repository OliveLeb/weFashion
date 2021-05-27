<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    // SEND CATEGORIES TO THE MENU
    // public function __construct() {
    //     view()->composer('partials.menu',function($view) {
    //         $categories = Category::pluck('category','id')->all();
    //         $view->with('categories' , $categories);
    //     });
    // }

    // FETCH PUBLISHED PRODUCTS WITH THEIR PICTURE & CATEGORY
    public function index() {
        $products = Product::published()->with('picture','categories')->paginate(6);
        return view('front.index',['products' => $products]);
    }

    // FETCH ONE PRODUCT BY PRODUCT'S ID
    public function show(int $id) {
        $product = Product::find($id);
        return view('front.show',['product' => $product]);
    }

    // FETCH PUBLISHED PRODUCTS BY CATEGORY'S NAME WITH PICTURE
    public function showProductsByCategory(int $id) {
        $category = Category::find($id);
        $products = $category->products()->published()->with('picture')->paginate(6);
        return view('front.index',['products' => $products]);
    }

    // FETCH PUBLISHED AND DISCOUNTED PRODUCTS WITH PICTURE
    public function showDiscountedProducts() {
        $products = Product::where('is_discounted',true)->published()->with('picture')->paginate(6);
        return view('front.index',['products' => $products]);
    }
}
