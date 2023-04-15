<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        // return response()->json($products);
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->photo);
        $validatedData = $request->validate([
            'name' => 'required|string|min:2',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->photo->store('products-image', 'public');
            $validatedData['photo'] = $path;
        }

        Product::create($validatedData);
        // return "validasi aman";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category:id,name')->findOrFail($id);
        // return response()->json($product);
        return new ProductDetailResource($product); // display detail use API resource
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
        ]);
        $product = Product::find($id);
        $product->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedProduct = Product::find($id);
        File::delete('storage/' . $deletedProduct->photo);
        $deletedProduct->delete();
    }
}
