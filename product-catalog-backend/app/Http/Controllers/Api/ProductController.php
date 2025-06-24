<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cover_image' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'cover_image' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $product->update($validated);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}