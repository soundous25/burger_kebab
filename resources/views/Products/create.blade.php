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
        <textarea name="description" class="form-control" required></textarea>
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
                <option value="{{ $category->id }}"> {{ $category->name }} </option>
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

    <div class="mb-3">
        <label>Image du produit</label>
        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        <small class="text-muted">Formats acceptés : JPG, JPEG, PNG, WEBP — 2 Mo max.</small>
        @error('image') <br><small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Options disponibles pour ce produit</label>
        @forelse($options as $option)
            <div class="form-check">
                <input type="checkbox" name="options[]" value="{{ $option->id }}" class="form-check-input" id="opt{{ $option->id }}">
                <label class="form-check-label" for="opt{{ $option->id }}">
                    {{ $option->name }}
                    @if($option->is_required) <span class="badge bg-danger">Obligatoire</span> @endif
                </label>
            </div>
        @empty
            <p class="text-muted">Aucune option disponible. <a href="{{ route('options.create') }}">En créer une</a>.</p>
        @endforelse
    </div>

    <button class="btn btn-add">Enregistrer</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>

</form>

@endsection