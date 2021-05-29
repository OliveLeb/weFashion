<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        return view('back.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {

        // get the picture
        $img = $request->file('picture');

        // if no img -> is_published = false (protection in case disabled attribute is removed)
        $request->is_published = empty($img) ? false : true;

        // create product in DB
        $product = Product::create($request->all());
        // link it to the sizes
        $product->sizes()->attach($request->sizes);
        // link it to the categories
        $product->categories()->attach($request->categories);

        // if there is an image do :
        if(!empty($img)){

            // choose the right folder
            switch(count($request->categories)){
                case '1':
                    $imgFolder = $request->categories[0] == '1' ? 'hommes' : 'femmes';
                    break;
                case '2':
                    $imgFolder = 'unisex';
                    break;
            }

            // rename the picture
            $imgFullName = $img->getClientOriginalName();
            $imgName = pathinfo($imgFullName, PATHINFO_FILENAME);
            $imgExtension = $img->getClientOriginalExtension();
            $file = time() . '_' . $imgName . '.' . $imgExtension;
            $link = $imgFolder.'/'.$file;

            // store the picture
            $img->storeAs( $imgFolder ,$file);
        }
        // create image in DB
        $product->picture()->create([
            'link' => $link ?? null,
            'title' => $request->name
        ]);

        return redirect()->route('admin.products.index')->with('success' , 'Produit correctement ajouté !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('back.products.show',['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('back.products.edit',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StoreProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        // dd($request->all());
         // get the picture
        $img = $request->file('picture');

        // if no img -> is_published = false (protection in case disabled attribute is removed)
        $request->is_published = empty($img) ? false : true;

        // create product in DB
        $product->update($request->all());
        // link it to the sizes
        $product->sizes()->sync($request->sizes);
        // link it to the categories
        $product->categories()->sync($request->categories);

        // if there is an image do :
        if(!empty($img)){

            // delete previous picture if exists
            if($product->picture->link) {
                Storage::disk('local')->delete($book->picture->link);
                $book->picture()->delete();
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

            // rename the picture
            $imgFullName = $img->getClientOriginalName();
            $imgName = pathinfo($imgFullName, PATHINFO_FILENAME);
            $imgExtension = $img->getClientOriginalExtension();
            $file = time() . '_' . $imgName . '.' . $imgExtension;
            $link = $imgFolder.'/'.$file;

            // store the picture
            $img->storeAs( $imgFolder ,$file);
        }
        // create image in DB
        $product->picture()->update([
            'link' => $link ?? null,
            'title' => $request->name
        ]);

        return redirect()->route('admin.products.index')->with('success' , 'Produit modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // delete the picture if exists
        if($product->picture->link) {
            Storage::disk('local')->delete($product->picture->link);
        }
        // delete the product from table with categories and sizes
        $product->delete();
        return redirect()->route('admin.products.index')->with('success' , 'Produit supprimé avec succès !');
    }
}
