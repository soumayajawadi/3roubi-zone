<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // HNA EL FIX: Fonction Dashboard m3a les Stats
    public function dashboard()
    {
        $totalSales = Order::where('status', 'delivered')->sum('total');
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->with('product')
            ->get();

        $lowStock = Product::where('stock', '<', 5)->get();

        $salesData = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->get();

        return view('admin.dashboard', compact('totalSales', 'totalOrders', 'pendingOrders', 'topProducts', 'lowStock', 'salesData'));
    }

    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Statut de la commande mis à jour !');
    }

    public function addDelivery(Request $request, $orderId)
    {
        $request->validate([
            'tracking_number' => 'required|string',
            'status' => 'required|string'
        ]);
        
        Delivery::updateOrCreate(
            ['order_id' => $orderId],
            ['tracking_number' => $request->tracking_number, 'status' => $request->status]
        );

        return back()->with('success', 'Informations de livraison mises à jour !');
    }

    public function cancel(Order $order)
    {
        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Commande annulée avec succès.');
    }
}