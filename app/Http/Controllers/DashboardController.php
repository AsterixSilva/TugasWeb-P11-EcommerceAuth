<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Fitur dashboard untuk SEMUA role (admin, editor, user)
        // Route hanya pakai middleware auth + verified, tanpa role:*.
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $inStockCount = Product::inStock()->count();
        $outOfStockCount = Product::where('stock', 0)->count();
        $lowStockCount = Product::where('stock', '>', 0)->where('stock', '<', 10)->count();

        $latestProducts = Product::with(['category'])->latest()->take(8)->get();
        $productsPerCategory = Category::withCount('products')->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'inStockCount',
            'outOfStockCount',
            'lowStockCount',
            'latestProducts',
            'productsPerCategory'
        ));
    }
}
