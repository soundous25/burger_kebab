@extends('layouts.app')

@section('module_title', 'Ajouter un produit')

@section('content')

<h2 class="page-title">Ajouter un produit</h2>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Prix (CHF)</label>
        <input type="number" step="0.01" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Catégorie</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Choisir une catégorie --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Statut</label>
        <select name="status" class="form-control">
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select>
    </div>

    <button class="btn btn-save">Enregistrer</button>

</form>

@endsection