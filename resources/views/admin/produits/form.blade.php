@extends('layouts.app')

@section('title', isset($produit) ? 'Modifier le Produit' : 'Ajouter un Produit')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        {{ isset($produit) ? 'Modifier le produit : ' . $produit->name : 'Ajouter un nouveau produit' }}
    </h1>

    <form action="{{ isset($produit) ? route('admin.produits.update', $produit) : route('admin.produits.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @csrf
        @if(isset($produit))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Nom -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom du produit *</label>
                <input type="text" name="name" value="{{ old('name', $produit->name ?? '') }}" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Catégorie -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                <select name="category_id" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id', $produit->category_id ?? '') == $cat->id) ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Prix -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prix (€) *</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $produit->price ?? '') }}" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                <input type="number" name="stock" value="{{ old('stock', $produit->stock ?? '') }}" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Description courte -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description courte</label>
            <input type="text" name="short_description" value="{{ old('short_description', $produit->short_description ?? '') }}" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Description longue -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description complète</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('description', $produit->description ?? '') }}</textarea>
        </div>

        <!-- Image -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Image du produit</label>
            @if(isset($produit) && $produit->image)
                <div class="mb-2">
                    <img src="{{ $produit->image }}" class="w-24 h-24 object-cover rounded-lg border">
                </div>
            @endif
            <input type="file" name="image" class="w-full border border-gray-300 rounded-lg p-2 text-sm bg-gray-50">
            <p class="text-xs text-gray-500 mt-1">Format accepté : JPG, PNG. Max 2MB.</p>
            @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-3 border-t pt-6">
            <a href="{{ route('admin.produits.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg font-medium transition">Annuler</a>
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition shadow-sm">
                {{ isset($produit) ? 'Enregistrer les modifications' : 'Créer le produit' }}
            </button>
        </div>
    </form>
</div>
@endsection