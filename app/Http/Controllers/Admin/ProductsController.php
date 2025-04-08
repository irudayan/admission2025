<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Products::all();

        // // if($categories->isEmpty())
        // $categories = ProductCategory::all();
        // if ($categories->isEmpty()) {
        //     return view('admin.products.index', compact('products', 'categories'))
        //         ->with('message', 'No categories found.');
        // }
        $products = Products::with('category')->get(); // Eager load category
    $categories = ProductCategory::all();

    if ($categories->isEmpty()) {
        return view('admin.products.index', compact('products', 'categories'))
            ->with('message', 'No categories found.');
    }
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Products::create($request->all());
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        return view('admin.products.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        return view('admin.products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products, $id)
    {
    //     $request->validate([
    //     'name' => 'required|string|max:255',
    //     'category_id' => 'required|exists:product_categories,id',
    //     'description' => 'required|string|max:1000',
    //     'price' => 'required|numeric',
    //     'tax' => 'required|numeric',
    //     'assigned_name' => 'required|string|max:255',
    //     ]);

    //    $se= $products->update($request->all());
    //    dd($se);

    //     return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
      // Validate the request
      $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:product_categories,id',
        'description' => 'string|max:1000',
        'price' => 'required|numeric',
        'tax' => 'required|numeric',
        // 'assigned_name' => 'required|string|max:255',
    ]);

    // Fetch product by ID
    $product = Products::findOrFail($id);

    // Update product
    $updated = $product->update($request->all());

    // Debugging
    if ($updated) {
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update product.');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products)
    {
        $products->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }


    public function getProductDetails($id)
{
    $product = Products::where('id', $id)->select('name', 'price')->first();

    if ($product) {
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ]);
    }
}

}
