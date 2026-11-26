@extends('layouts.app')

@section('title', 'Notre Histoire - 3roubi Zone')

@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-4 text-danger">Notre Histoire</h1>
        <p class="fs-5 text-muted">Pourquoi 3roubi Zone ? Parce que la nostalgie n'a pas de prix.</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="https://i.pinimg.com/736x/8e/5e/85/8e5e850b32cf8e33ff6e1b8abe3d0ff9.jpg" class="img-fluid rounded-4 shadow-lg" alt="Tunisie">
        </div>
        <div class="col-md-6">
            <h3 class="fw-bold mb-3">Le goût de chez soi, partout dans le monde.</h3>
            <p class="text-muted" style="line-height: 1.8;">
                Tu es tunisien et tu vis à l'étranger ? Tu as déjà cherché une vraie harissa, une bonne huile d'olive, ou des makroudhs qui goûtent vraiment la Tunisie ? On sait que c'est difficile.
            </p>
            <p class="text-muted" style="line-height: 1.8;">
                <strong>3roubi Zone</strong> est né d'un constat simple : il est trop compliqué de trouver des produits tunisiens authentiques à l'étranger. Alors on a décidé de créer la solution.
            </p>
            <p class="text-muted" style="line-height: 1.8;">
                Notre mission est simple : te ramener un petit bout de la Tunisie chez toi, à travers des produits soigneusement sélectionnés, au prix le plus juste, et avec une livraison rapide.
            </p>
        </div>
    </div>

    <div class="row text-center mt-5">
        <div class="col-md-4 mb-4">
            <div class="p-4 rounded-4 shadow-sm bg-white border">
                <span class="fs-1">🇹🇳</span>
                <h4 class="fw-bold mt-3">100% Authentique</h4>
                <p class="text-muted">Directement importé de Tunisie.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 rounded-4 shadow-sm bg-white border">
                <span class="fs-1">🚚</span>
                <h4 class="fw-bold mt-3">Livraison Rapide</h4>
                <p class="text-muted">Partout en Europe et dans le monde.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="p-4 rounded-4 shadow-sm bg-white border">
                <span class="fs-1">❤️</span>
                <h4 class="fw-bold mt-3">Fait avec Passion</h4>
                <p class="text-muted">Par des Tunisiens, pour des Tunisiens.</p>
            </div>
        </div>
    </div>
</div>
@endsection