@extends('layouts.app')

@section('title', 'Mon Panier - 3roubi Zone')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold mb-4 border-bottom pb-3">🛒 Mon panier</h1>

    @if(empty($items))
        <div class="bg-white p-5 rounded shadow-sm text-center">
            <h4 class="text-muted mb-4">Votre panier est vide.</h4>
            <a href="{{ route('shop') }}" class="btn btn-danger rounded-pill px-4">Découvrir la boutique</a>
        </div>
    @else
        <div class="row">
          
            <div class="col-md-8 mb-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th style="width: 120px;">Quantité</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="fw-bold">{{ $item['product']->name }}</td>
                                    <td>{{ number_format($item['product']->price, 2) }} €</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update', $item['product']) }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="0" 
                                                   class="form-control text-center" onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold text-danger">{{ number_format($item['product']->price * $item['qty'], 2) }} €</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $item['product']) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    
            <div class="col-md-4">
                <div class="bg-white rounded shadow-sm p-4 h-100 d-flex flex-column">
                    <h5 class="fw-bold border-bottom pb-3 mb-3">Résumé de la commande</h5>

                  
                    <div class="mb-4 mt-2">
                        <h6 class="fw-bold mb-3">🎟️ Code Promo</h6>
                        @if(session()->has('promo_code'))
                            <div class="alert alert-success d-flex justify-content-between align-items-center py-2">
                                <div>
                                    Code <strong>{{ session('promo_code') }}</strong> <br>
                                    <small class="text-success">-{{ number_format(session('promo_discount'), 2) }} € appliqué</small>
                                </div>
                                <form action="{{ route('promo.remove') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('promo.apply') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <input type="text" name="code" class="form-control" placeholder="Entrez votre code..." required>
                                <button type="submit" class="btn btn-dark fw-bold px-3">OK</button>
                            </form>
                        @endif
                    </div>

                    <div class="mt-auto border-top pt-3">
                        
                        @if(session()->has('promo_discount'))
                            <div class="d-flex justify-content-between mb-1 text-muted small">
                                <span>Sous-total :</span>
                                <span>{{ number_format($total, 2) }} €</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 text-success small fw-bold">
                                <span>Promo ({{ session('promo_code') }}) :</span>
                                <span>-{{ number_format(session('promo_discount'), 2) }} €</span>
                            </div>
                        @endif

                    
                        <div class="d-flex justify-content-between mb-2 text-muted small">
                            <span>Frais de livraison :</span>
                            <span>7.00 €</span>
                        </div>

                       
                        @php
                            $finalTotal = max(0, $total - session('promo_discount', 0)) + 7.00;
                        @endphp
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-bold fs-5">Total à payer :</span>
                            <span class="fw-bold text-danger fs-4">{{ number_format($finalTotal, 2) }} €</span>
                        </div>
                        
                        <a href="{{ route('order.checkout') }}" class="btn btn-danger btn-lg w-100 fw-bold">Passer la commande</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection