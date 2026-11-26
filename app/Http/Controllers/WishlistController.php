<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        $products = Product::whereIn('id', array_keys($wishlist))->get();
        return view('wishlist.index', compact('products'));
    }

    public function add(Product $product)
    {
        $wishlist = session()->get('wishlist', []);
        if (!isset($wishlist[$product->id])) {
            $wishlist[$product->id] = true;
            session()->put('wishlist', $wishlist);
            return back()->with('success', 'Produit ajouté aux favoris !');
        }
        return back()->with('info', 'Déjà dans vos favoris.');
    }

    public function remove(Product $product)
    {
        $wishlist = session()->get('wishlist', []);
        if (isset($wishlist[$product->id])) {
            unset($wishlist[$product->id]);
            session()->put('wishlist', $wishlist);
        }
        return back()->with('success', 'Produit retiré des favoris.');
    }
}