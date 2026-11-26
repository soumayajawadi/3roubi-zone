@extends('layouts.app')

@section('title', 'Passer Commande - 3roubi Zone')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold mb-4 border-bottom pb-3">Finaliser la commande</h1>

    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="bg-white p-4 rounded shadow-sm">
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <h4 class="mb-3">Adresse de livraison</h4>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Adresse complète *</label>
                        <textarea name="shipping_address" class="form-control" rows="3" required placeholder=""></textarea>
                    </div>

                    <h4 class="mb-3 mt-4">Méthode de paiement</h4>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" checked>
                        <label class="form-check-label" for="cash">
                            Paiement à la livraison
                        </label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                        <label class="form-check-label" for="card">
                            Carte bancaire (Bientôt disponible)
                        </label>
                    </div>

                    <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold">Confirmer la commande</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="bg-white p-4 rounded shadow-sm">
                <h4 class="border-bottom pb-2 mb-3">votre commande</h4>
                <div class="d-flex justify-content-between mb-2">
                    <span>Total à payer :</span>
                    <span class="fw-bold text-danger fs-5">{{ number_format($total, 2) }} €</span>
                </div>
                <p class="text-muted small mt-3">Les frais de livraison seront calculés après confirmation.</p>
            </div>
        </div>
    </div>
</div>
@endsection
