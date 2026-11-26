<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $items = [];
        foreach ($this->cart->all() as $id => $qty) {
            $p = Product::find($id);
            if ($p) $items[] = ['product' => $p, 'qty' => $qty];
        }
        return view('cart.index', ['items' => $items, 'total' => $this->cart->total()]);
    }

    public function add(Request $request, Product $product)
    {
        // HNA EL FIX: nzid el quantité (par défaut 1 ken ma jach mel formulaire)
        $qty = $request->input('qty', 1);
        
        $this->cart->add($product->id, $qty);
        
        return redirect()->back()->with('success', 'Produit ajouté au panier avec succès !');
    }

    public function update(Request $request, Product $product)
    {
        $this->cart->update($product->id, $request->input('qty', 0));
        return redirect()->back();
    }

    public function remove(Product $product)
    {
        $this->cart->remove($product->id);
        return redirect()->back();
    }
}