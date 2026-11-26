<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ───── Changement de langue ─────
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// ───── Site public ─────
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/boutique', [ShopController::class, 'index'])->name('shop');
Route::get('/produit/{id}', [ShopController::class, 'show'])->name('product.show');
Route::get('/a-propos', function () { return view('about'); })->name('about');
Route::get('/notre-histoire', function () { return view('histoire'); })->name('histoire');
Route::get('/promotions', function () { return view('promotions'); })->name('promotions');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ───── Panier ─────
Route::prefix('panier')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/modifier/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/supprimer/{product}', [CartController::class, 'remove'])->name('cart.remove');
});

// ───── Auth users ─────
Route::middleware('auth')->group(function () {
    Route::get('/commande/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/commande/valider', [OrderController::class, 'store'])->name('order.store');
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::post('/commande/{order}/annuler', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/commande/{order}/facture', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::post('/produit/{product}/avis', [ReviewController::class, 'store'])->name('review.store');
    Route::post('/promo/apply', [PromotionController::class, 'apply'])->name('promo.apply');
    Route::post('/promo/remove', [PromotionController::class, 'remove'])->name('promo.remove');

    // Chat Client
    Route::get('/chat', [MessageController::class, 'clientChat'])->name('chat.client');
    Route::post('/chat/send', [MessageController::class, 'send'])->name('chat.send');

    // Wishlist (Favoris)
    Route::get('/favoris', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/favoris/ajouter/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/favoris/supprimer/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ───── Admin ─────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminOrderController::class, 'dashboard'])->name('dashboard');

    // Produits (CRUD + archivage)
    Route::patch('produits/{produit}/archiver', [ProductController::class, 'archive'])->name('produits.archive');
    Route::patch('produits/{produit}/restaurer', [ProductController::class, 'unarchive'])->name('produits.unarchive');
    Route::resource('produits', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::get('commandes', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('commandes/{order}/statut', [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::post('commandes/{order}/livraison', [AdminOrderController::class, 'addDelivery'])->name('delivery.store');
    Route::post('commandes/{order}/annuler', [AdminOrderController::class, 'cancel'])->name('orders.cancel');

    Route::get('chat/{clientId?}', [MessageController::class, 'adminChat'])->name('chat.admin');
});

Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard')->middleware('auth');

require __DIR__.'/auth.php';