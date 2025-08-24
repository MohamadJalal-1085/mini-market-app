<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
// We removed: use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        if ($request->has('min_price') && $request->input('min_price') != '') {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->has('sort')) {
            if ($request->input('sort') == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->input('sort') == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create(Request $request): View
    {
        
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:png,jpg,gif,webp|max:2048', // Added webp support
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('photos', 'public');
        }

        Product::create($validatedData);
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('photos', 'public');
        }

        $product->update($validatedData);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}