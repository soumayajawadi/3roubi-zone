@extends('layouts.app')

@section('title', 'Mes Favoris - 3roubi Zone')

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold mb-4 text-danger">❤️ Mes Favoris</h1>

    @if($products->isEmpty())
        <div class="bg-white p-5 rounded shadow-sm text-center">
            <h4 class="text-muted mb-4">Vous n'avez pas encore de produits favoris.</h4>
            <a href="{{ route('shop') }}" class="btn btn-danger rounded-pill px-4">Découvrir la boutique</a>
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card-produit h-100">
                        <div style="height: 200px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" class="w-100 h-100" style="object-fit: cover;">
                            @endif
                        </div>
                        <div class="p-3">
                            <h5 class="fw-bold text-dark text-truncate">{{ $product->name }}</h5>
                            <p class="text-danger fw-bold fs-5">{{ number_format($product->price, 2) }} €</p>
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-dark w-100">Voir</a>
                                <form action="{{ route('wishlist.remove', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection