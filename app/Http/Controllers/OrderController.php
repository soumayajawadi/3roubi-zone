<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Cart;
use App\Mail\OrderPlaced; // <-- Zidna hedha
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail; // <-- Zidna hedha

class OrderController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function checkout()
    {
        $total = $this->cart->total();
        $discount = session('promo_discount', 0);
        $shippingFee = 7.00; 
        $finalTotal = max(0, $total - $discount) + $shippingFee;

        return view('order.checkout', compact('total', 'discount', 'finalTotal', 'shippingFee'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_address' => 'required|string',
            'payment_method'   => 'required|string',
        ]);

        $cartItems = $this->cart->all();
        if (empty($cartItems)) return redirect()->route('cart.index')->with('error', 'Panier vide.');

        $shippingFee = 7.00; 
        $total = $this->cart->total();
        $discount = session('promo_discount', 0);
        $finalTotal = max(0, $total - $discount) + $shippingFee;

        $order = null;

        DB::transaction(function () use ($cartItems, $data, $finalTotal, &$order) {
            $order = Order::create([
                'user_id'          => auth()->id(),
                'total'            => $finalTotal,
                'status'           => 'pending',
                'shipping_address' => $data['shipping_address'],
                'payment_method'   => $data['payment_method'],
            ]);

            foreach ($cartItems as $id => $qty) {
                $p = Product::find($id);
                if (! $p) continue;

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $p->id,
                    'quantity'   => $qty,
                    'unit_price' => $p->price,
                ]);
                $p->decrement('stock', $qty);
            }
        });

        // HNA EL FIX: Envoi email de confirmation
        Mail::to(auth()->user()->email)->send(new OrderPlaced($order));

        $this->cart->clear();
        session()->forget(['promo_discount', 'promo_code']);

        return redirect()->route('orders.my')->with('success', 'Commande passée avec succès !');
    }

    public function myOrders()
    {
        $orders = Order::with('items.product')->where('user_id', auth()->id())->latest()->get();
        return view('order.my', compact('orders'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (in_array($order->status, ['pending', 'confirmed'])) {
            $order->update(['status' => 'cancelled']);
            return back()->with('success', 'Commande annulée avec succès.');
        }

        return back()->with('error', 'Vous ne pouvez pas annuler cette commande.');
    }

    public function invoice(Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') { 
            abort(403); 
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('order.invoice', compact('order'));
        return $pdf->download('facture-'.$order->id.'.pdf');
    }
}