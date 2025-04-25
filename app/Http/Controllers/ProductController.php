<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('sizes', 'images')->get();
        return view('pages.products.index', compact('products')); // Path updated to pages.products.index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = Size::all();
        return view('pages.products.create', compact('sizes')); // Path updated to pages.products.create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::create($request->only('name', 'price', 'description', 'category_id'));

        // Sync sizes
        $product->sizes()->sync($request->sizes);

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::with('sizes', 'images')->findOrFail($id);
        $sizes = Size::all();
        return view('pages.products.edit', compact('product', 'sizes')); // Path updated to pages.products.edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->only('name', 'price', 'description', 'category_id'));

        // Update sizes
        $product->sizes()->sync($request->sizes);

        // Optional: Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.'); // Updated route
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->sizes()->detach();
        $product->images()->delete();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.'); // Use 'products.index' here
    }

}
