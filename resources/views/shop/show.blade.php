@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mt-4">
    <div class="bg-white rounded shadow-sm p-4 p-md-5">
        <div class="row align-items-center">
            
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="min-height: 400px;">
                    @if($product->image_src)
                        <img src="{{ $product->image_src }}" class="img-fluid rounded" style="max-height: 500px; object-fit: cover;" alt="{{ $product->name }}">
                    @else
                        <span class="text-muted fst-italic">Pas d'image</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <span class="badge bg-danger mb-2">{{ $product->category->name ?? 'Produit' }}</span>
                <h1 class="fw-bold mb-3">{{ $product->name }}</h1>
                <h3 class="text-danger fw-bold mb-4">{{ number_format($product->price, 2) }} €</h3>
                
                <p class="text-muted mb-4">{{ $product->description ?? $product->short_description }}</p>

                <div class="mb-4">
                    <span class="fw-bold">Disponibilité : </span>
                    @if($product->stock > 0)
                        <span class="text-success fw-bold">En stock ({{ $product->stock }})</span>
                    @else
                        <span class="text-danger fw-bold">Rupture de stock</span>
                    @endif
                </div>

                @if($product->stock > 0)
                    <div class="d-flex gap-3">
                        <form method="POST" action="{{ route('cart.add', $product) }}" class="d-flex gap-3 flex-grow-1">
                            @csrf
                            <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" class="form-control text-center" style="width: 80px;">
                            <button type="submit" class="btn btn-danger btn-lg flex-grow-1 fw-bold">🛒 Ajouter au panier</button>
                        </form>

                        <form action="{{ route('wishlist.add', $product) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg h-100" title="Ajouter aux favoris">❤️</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h3 class="fw-bold border-bottom pb-3 mb-4">⭐ Avis des clients</h3>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="bg-white p-4 rounded shadow-sm border">
                    <h5 class="fw-bold">Donnez votre avis</h5>
                    <form action="{{ route('review.store', $product) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Note</label>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="5" id="5" checked> <label for="5">⭐⭐⭐⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="4" id="4"> <label for="4">⭐⭐⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="3" id="3"> <label for="3">⭐⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="2" id="2"> <label for="2">⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="1" id="1"> <label for="1">⭐</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Commentaire</label>
                            <textarea name="comment" class="form-control" rows="3" placeholder="Votre expérience..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-bold">Envoyer</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                @forelse($product->reviews as $review)
                    <div class="bg-white p-3 rounded shadow-sm border mb-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold">{{ $review->user->name }}</h6>
                            <span class="text-warning">{{ str_repeat('⭐', $review->rating) }}</span>
                        </div>
                        <small class="text-muted">{{ $review->created_at->format('d/m/Y') }}</small>
                        <p class="mt-2 mb-0">{{ $review->comment }}</p>
                    </div>
                @empty
                    <div class="alert alert-info">Aucun avis pour le moment. Soyez le premier !</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection