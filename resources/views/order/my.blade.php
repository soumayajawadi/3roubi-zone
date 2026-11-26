@extends('layouts.app')

@section('title', 'Mes Commandes - 3roubi Zone')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold mb-4 border-bottom pb-3">Mes Commandes</h1>

    @if($orders->isEmpty())
        <div class="bg-white p-5 rounded shadow-sm text-center">
            <h4 class="text-muted mb-4">Vous n'avez pas encore passé de commande.</h4>
            <a href="{{ route('shop') }}" class="btn btn-danger rounded-pill px-4">Découvrir la boutique</a>
        </div>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0">
                        
                        <!-- Header mte3 el commande -->
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <div>
                                <strong>Commande #{{ $order->id }}</strong> 
                                <span class="text-muted ms-3">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @elseif($order->status == 'confirmed')
                                    <span class="badge bg-info text-dark">Confirmée</span>
                                @elseif($order->status == 'shipped')
                                    <span class="badge bg-primary">Expédiée</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge bg-success">Livrée</span>
                                @else
                                    <span class="badge bg-danger">Annulée</span>
                                @endif
                                
                                <!-- Bouton Annuler (Ken mazelt En attente wala Confirmée) -->
                                @if(in_array($order->status, ['pending', 'confirmed']))
                                    <form action="{{ route('orders.cancel', $order) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">Annuler</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <!-- Body mte3 el commande -->
                        <div class="card-body">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td style="width: 70px;">
                                                @if($item->product && $item->product->image_src)
                                                    <img src="{{ $item->product->image_src }}" alt="{{ $item->product->name }}" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                @endif
                                            </td>
                                            <td>
                                                <h6 class="mb-0 fw-bold">{{ $item->product->name ?? 'Produit supprimé' }}</h6>
                                                <small class="text-muted">Quantité : {{ $item->quantity }}</small>
                                            </td>
                                            <td class="text-end fw-bold">
                                                {{ number_format($item->unit_price * $item->quantity, 2) }} €
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="2" class="text-end fw-bold fs-5">Total :</td>
                                        <td class="text-end fw-bold text-danger fs-5">{{ number_format($order->total, 2) }} €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Blasa mte3 el Livraison -->
                        @if($order->delivery)
                            <div class="card-footer bg-info bg-opacity-10 border-top border-info">
                                <h6 class="fw-bold text-info mb-2">🚚 Suivi de livraison</h6>
                                <p class="mb-1"><strong>Numéro de suivi :</strong> {{ $order->delivery->tracking_number }}</p>
                                <p class="mb-0"><strong>Statut :</strong> <span class="badge bg-info text-dark">{{ $order->delivery->status }}</span></p>
                            </div>
                        @else
                            <div class="card-footer bg-light border-top">
                                <p class="mb-0 text-muted small">Aucune information de livraison disponible pour le moment.</p>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection