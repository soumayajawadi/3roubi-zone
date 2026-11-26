@extends('layouts.app')

@section('title', 'Gestion des Produits')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Produits</h1>
        <a href="{{ route('admin.produits.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition">
            + Ajouter un produit
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Image</th>
                    <th class="p-4 font-semibold">Nom</th>
                    <th class="p-4 font-semibold">Catégorie</th>
                    <th class="p-4 font-semibold">Prix</th>
                    <th class="p-4 font-semibold">Stock</th>
                    <th class="p-4 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4">
                        @if($product->image)
                            <img src="{{ $product->image }}" class="w-12 h-12 object-cover rounded-lg border">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-500">N/A</div>
                        @endif
                    </td>
                    <td class="p-4 text-gray-800 font-medium">{{ $product->name }}</td>
                    <td class="p-4 text-gray-600">{{ $product->category->name ?? 'Sans catégorie' }}</td>
                    <td class="p-4 text-gray-800 font-bold">{{ number_format($product->price, 2) }} €</td>
                    <td class="p-4">
                        @if($product->stock > 0)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold">{{ $product->stock }} en stock</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">Rupture</span>
                        @endif
                    </td>
                    <td class="p-4 flex gap-3">
                        <a href="{{ route('admin.produits.edit', $product) }}" class="text-blue-600 hover:underline text-sm font-medium">Modifier</a>
                        <form action="{{ route('admin.produits.destroy', $product) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm font-medium">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">Aucun produit trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
@endsection