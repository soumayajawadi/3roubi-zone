<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        // Njibou 8 produits (ghir el actifs) lel page d'accueil
        $featured = Product::active()->latest()->take(8)->get();
        return view('shop.home', compact('featured'));
    }

    public function index(Request $request)
    {
        $query = Product::active();

        // Filtre mte3 el recherche
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filtre mte3 el categories
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::active()->findOrFail($id);
        return view('shop.show', compact('product'));
    }

    public function about()
    {
        return view('about');
    }
}