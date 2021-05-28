<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('back.products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::all();
        $categories = Category::all();
        return view('back.products.create',['sizes' => $sizes , 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        // dd($request->all());
        $product = Product::create($request->all());
        $product->sizes()->attach($request->sizes);
        $product->categories()->attach($request->categories);

        // get the picture
        $img = $request->file('picture');

        // rename the picture
        if(!empty($img)){
            $imgFullName = $img->getClientOriginalName();
            $imgName = pathinfo($imgFullName, PATHINFO_FILENAME);
            $imgExtension = $img->getClientOriginalExtension();
            $file = time() . '_' . $imgName . '.' . $imgExtension;
        }

        // choose the right folder
        switch(count($request->categories)){
            case '1':
                $imgFolder = $request->categories[0] == '1' ? 'hommes' : 'femmes';
                break;
            case '2':
                $imgFolder = 'unisex';
                break;
        }
        // store the picture
        $img->storeAs( $imgFolder ,$file);
        // create in DB
        $product->picture()->create([
            'link' => $imgFolder.'/'.$file,
            'title' => $request->name
        ]);

        return redirect()->route('back.products.index')->with('succes' , 'Produit correctement ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
