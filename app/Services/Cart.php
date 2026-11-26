<?php

namespace App\Services;

class Cart
{
    public function add($productId, $qty = 1)
    {
        $cart = session()->get('cart', []);
        $cart[$productId] = ($cart[$productId] ?? 0) + $qty;
        session()->put('cart', $cart);
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    public function update($productId, $qty)
    {
        $cart = session()->get('cart', []);
        if ($qty <= 0) unset($cart[$productId]);
        else $cart[$productId] = $qty;
        session()->put('cart', $cart);
    }

    public function all()
    {
        return session()->get('cart', []);
    }

    public function clear()
    {
        session()->forget('cart');
    }

    public function total()
    {
        $total = 0;
        foreach ($this->all() as $id => $qty) {
            $product = \App\Models\Product::find($id);
            if ($product) $total += $product->price * $qty;
        }
        return $total;
    }

    public function count()
    {
        return array_sum($this->all());
    }
}