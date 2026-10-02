<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'user', 'tags'])->latest()->get();

        return view('products.index', compact('products'));
    }

    public function create()
{
    $categories = Category::all();

    return view('products.create', compact('categories'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $validated['user_id'] = auth()->id() ?? 1;

        $product = Product::create($validated);

        $product->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(string $id)
{
    $product = Product::with(['category', 'user', 'tags'])->findOrFail($id);

    return view('products.show', compact('product'));
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();

        $product->load('tags');

        return view('products.edit', compact(
            'product',
            'categories',
            'tags'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $product->update($validated);

        $product->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}