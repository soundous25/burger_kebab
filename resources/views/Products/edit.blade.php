@extends('layouts.app')

@section('module_title', 'Modifier un produit')

@section('content')

<h2 class="page-title">Modifier le produit</h2>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control"
               value="{{ $product->name }}" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Prix (CHF)</label>
        <input type="number" step="0.01" name="price" class="form-control"
               value="{{ $product->price }}" required>
    </div>

    <div class="mb-3">
        <label>Catégorie</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Statut</label>
        <select name="status" class="form-control">
            <option value="1" {{ $product->status ? 'selected' : '' }}>Actif</option>
            <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactif</option>
        </select>
    </div>

    <button class="btn btn-save">Mettre à jour</button>

</form>

@endsection