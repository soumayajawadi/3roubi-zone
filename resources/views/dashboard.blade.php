@extends('layouts.app')

@section('title', 'Mon Compte - 3roubi Zone')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="bg-white p-4 rounded shadow-sm text-center">
                <div class="mb-3">
                    <span class="display-1">👤</span>
                </div>
                <h4 class="fw-bold">{{ Auth::user()->name }}</h4>
                <p class="text-muted">{{ Auth::user()->email }}</p>
                <hr>
                <a href="{{ route('orders.my') }}" class="btn btn-outline-dark w-100 mb-2">📦 Mes Commandes</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">🚪 Déconnexion</button>
                </form>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="bg-white p-4 rounded shadow-sm">
                <h3 class="fw-bold border-bottom pb-3 mb-4">Bienvenue dans votre espace</h3>
                <p class="text-muted">Ici, vous pouvez gérer vos informations personnelles et consulter l'historique de vos commandes.</p>
                
                @if(Auth::user()->role === 'admin')
                    <div class="alert alert-warning mt-4">
                        <strong>Vous êtes administrateur.</strong> <br>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-dark mt-2">Accéder au panneau Admin</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection