@extends('layouts.app')

@section('title', 'Admin - Commandes')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold mb-4 border-bottom pb-3">📦 Toutes les Commandes (Admin)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info">Aucune commande pour le moment.</div>
    @else
        <div class="table-responsive bg-white rounded shadow-sm p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <strong>{{ $order->user->name }}</strong><br>
                                <small class="text-muted">{{ $order->user->email }}</small>
                            </td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="fw-bold text-danger">{{ number_format($order->total, 2) }} €</td>
                            <td>
                                <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Expédiée</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Livrée</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#orderModal-{{ $order->id }}">Détails</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


@foreach($orders as $order)
    <div class="modal fade" id="orderModal-{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel-{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="orderModalLabel-{{ $order->id }}">Commande #{{ $order->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2 mb-3">📄 Détails de la commande</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Client :</strong> {{ $order->user->name }}</p>
                                <p class="mb-1"><strong>Adresse :</strong> {{ $order->shipping_address }}</p>
                                <p class="mb-0"><strong>Paiement :</strong> {{ $order->payment_method }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Produits :</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach($order->items as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                            <div>
                                                {{ $item->product->name ?? 'Produit supprimé' }}
                                                <span class="text-muted small">(x{{ $item->quantity }})</span>
                                            </div>
                                            <span class="fw-bold text-danger">{{ number_format($item->unit_price * $item->quantity, 2) }} €</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 border rounded border-primary bg-primary bg-opacity-10">
                        <h6 class="fw-bold text-primary mb-3">🚚 Informations de livraison</h6>
                        <form action="{{ route('admin.delivery.store', $order->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label small fw-bold">Numéro de suivi</label>
                                    <input type="text" name="tracking_number" class="form-control form-control-sm" value="{{ $order->delivery->tracking_number ?? '' }}" placeholder="Ex: TN123456789" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label small fw-bold">Statut</label>
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="En préparation" {{ ($order->delivery->status ?? '') == 'En préparation' ? 'selected' : '' }}>En préparation</option>
                                        <option value="Expédiée" {{ ($order->delivery->status ?? '') == 'Expédiée' ? 'selected' : '' }}>Expédiée</option>
                                        <option value="Livrée" {{ ($order->delivery->status ?? '') == 'Livrée' ? 'selected' : '' }}>Livrée</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold mt-2">Enregistrer la livraison</button>
                        </form>
                    </div>
                </div>

                <div class="modal-footer bg-light d-flex justify-content-between">
                    <div>
                        @if(in_array($order->status, ['pending', 'confirmed']))
                            <form action="{{ route('admin.orders.cancel', $order) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger fw-bold" onclick="return confirm('Annuler cette commande ?');">Annuler la commande</button>
                            </form>
                        @endif
                    </div>

                    <div>
                        <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-danger fw-bold me-2">📄 Télécharger Facture PDF</a>
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection