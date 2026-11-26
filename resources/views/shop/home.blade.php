@extends('layouts.app')

@section('title', 'Accueil - 3roubi Zone')

@section('content')
    <!-- Bannière (Hero Section) -->
    <div class="hero-section position-relative overflow-hidden rounded-4 shadow-lg mb-5" style="background-image: url('https://i.pinimg.com/736x/8e/5e/85/8e5e850b32cf8e33ff6e1b8abe3d0ff9.jpg'); background-size: cover; background-position: center; min-height: 450px; display: flex; align-items: center; justify-content: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.7);"></div>
        
        <div class="position-relative text-center text-white p-5 z-index-2">
            <h1 class="display-3 fw-bold mb-3" style="color: #ff1a1a; text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.9), 0 0 20px rgba(220, 38, 38, 0.5);">3roubi Zone <span>🌶️</span></h1>
            <p class="fs-4 mb-2 text-light">Retrouvez le goût authentique de votre pays, où que vous soyez</p>
            <p class="fs-5 mb-4 text-warning" dir="rtl">نكهات تونس الأصيلة في كل بيت</p>
            
            <a href="{{ route('shop') }}" class="btn btn-danger btn-lg rounded-pill px-5 py-3 fw-bold">🛒 Découvrir nos produits</a>
        </div>
    </div>

    <!-- Categories (Cercles) -->
    <div class="d-flex justify-content-center gap-4 mt-5 flex-wrap">
        <a href="{{ route('shop') }}" class="text-center text-decoration-none">
            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px; border: 2px solid #dc2626; box-shadow: 0 0 15px rgba(220, 38, 38, 0.4);">
                <span class="fs-2">🌶️</span>
            </div>
            <span class="text-dark fw-bold">Épices</span>
        </a>
        <a href="{{ route('shop') }}" class="text-center text-decoration-none">
            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px; border: 2px solid #dc2626; box-shadow: 0 0 15px rgba(220, 38, 38, 0.4);">
                <span class="fs-2">🫒</span>
            </div>
            <span class="text-dark fw-bold">Huiles</span>
        </a>
        <a href="{{ route('shop') }}" class="text-center text-decoration-none">
            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px; border: 2px solid #dc2626; box-shadow: 0 0 15px rgba(220, 38, 38, 0.4);">
                <span class="fs-2">🍰</span>
            </div>
            <span class="text-dark fw-bold">Pâtisseries</span>
        </a>
        <a href="{{ route('shop') }}" class="text-center text-decoration-none">
            <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px; border: 2px solid #dc2626; box-shadow: 0 0 15px rgba(220, 38, 38, 0.4);">
                <span class="fs-2">🧵</span>
            </div>
            <span class="text-dark fw-bold">Artisanat</span>
        </a>
    </div>

    <!-- Produits Phares -->
    <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
        <h2 class="fw-bold text-dark">Produits Phares</h2>
        <a href="{{ route('shop') }}" class="text-decoration-none fw-bold" style="color: #dc2626;">Voir tout →</a>
    </div>
    
    <div class="row g-4">
        @foreach($featured as $p)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card-produit h-100" 
                     style="background: #fff; border: 1px solid #e5e7eb; border-radius: 15px; overflow: hidden; transition: all 0.4s ease-in-out; box-shadow: 0 2px 10px rgba(0,0,0,0.05);"
                     onmouseover="this.style.boxShadow='0 0 25px 5px rgba(220, 38, 38, 0.6)'; this.style.borderColor='#dc2626'; this.style.transform='translateY(-8px)';"
                     onmouseout="this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)'; this.style.borderColor='#e5e7eb'; this.style.transform='translateY(0)';">
                    
                    <div style="height: 200px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                        @if($p->image_url)
                            <img src="{{ $p->image_url }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $p->name }}">
                        @else
                            <span class="text-muted fst-italic">Pas d'image</span>
                        @endif
                    </div>
                    <div class="p-3 d-flex flex-column flex-grow-1">
                        <span class="text-muted small mb-1">{{ $p->category->name ?? 'Catégorie' }}</span>
                        <h5 class="fw-bold text-dark text-truncate">{{ $p->name }}</h5>
                        <p class="text-muted small mb-3">{{ $p->short_description }}</p>
                        
                        <div class="mt-auto">
                            <p class="text-danger fw-bold fs-5 mb-3">{{ number_format($p->price, 2) }} €</p>
                            <a href="{{ route('product.show', $p->id) }}" class="btn btn-danger w-100 fw-bold">Voir le produit</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection