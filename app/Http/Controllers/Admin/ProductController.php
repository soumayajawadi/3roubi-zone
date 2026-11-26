<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        // Njibou les produits m3a les catégories mta3hom
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.produits.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.produits.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // T7e9i9 image
        ]);

        $data['slug'] = Str::slug($request->name);

        // Gestion mta3 l'image (Upload)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        Product::create($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit créé avec succès.');
    }

    public function edit(Product $produit)
    {
        $categories = Category::all();
        return view('admin.produits.form', compact('produit', 'categories'));
    }

    public function update(Request $request, Product $produit)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['slug'] = Str::slug($request->name);

        // Gestion mta3 l'image (Update)
        if ($request->hasFile('image')) {
            // N7iwou l'image l9dima ila kenet mawjouda
            if ($produit->image) {
                $oldPath = str_replace('/storage/', '', $produit->image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $produit->update($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Product $produit)
    {
      
        if ($produit->image) {
            $oldPath = str_replace('/storage/', '', $produit->image);
            Storage::disk('public')->delete($oldPath);
        }
        
        $produit->delete();
        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé.');
    }
    public function archive(Product $produit)
{
    $produit->update(['archived_at' => now()]);
    return back()->with('success', 'Produit archivé.');
}

public function unarchive(Product $produit)
{
    $produit->update(['archived_at' => null]);
    return back()->with('success', 'Produit restauré.');
}
    
}