@extends('layouts.app')

@section('title', 'Admin - Produits')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h1 class="fw-bold mb-0">🛍️ Produits (Admin)</h1>
        <a href="{{ route('admin.produits.create') }}" class="btn btn-danger fw-bold">+ Créer un produit</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-info">Aucun produit pour le moment.</div>
    @else
        <div class="table-responsive bg-white rounded shadow-sm p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="{{ $product->archived_at ? 'table-secondary' : '' }}">
                            <td>#{{ $product->id }}</td>
                            <td>
                                @if($product->image_src)
                                    <img src="{{ $product->image_src }}" alt="{{ $product->name }}"
                                         style="width:50px;height:50px;object-fit:cover;" class="rounded">
                                @endif
                            </td>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td class="fw-bold text-danger">{{ number_format($product->price, 2) }} €</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if($product->archived_at)
                                    <span class="badge bg-secondary">Archivé</span>
                                @else
                                    <span class="badge bg-success">Actif</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.produits.edit', $product) }}"
                                       class="btn btn-sm btn-primary">Modifier</a>

                                    @if($product->archived_at)
                                        <form action="{{ route('admin.produits.unarchive', $product) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Restaurer</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.produits.archive', $product) }}" method="POST"
                                              onsubmit="return confirm('Archiver ce produit ?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-warning">Archiver</button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.produits.destroy', $product) }}" method="POST"
                                          onsubmit="return confirm('Supprimer définitivement ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection