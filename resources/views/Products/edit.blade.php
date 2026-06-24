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

    <div class="mb-3">
        <label class="d-block">Image actuelle</label>
        @if($product->image_path)
            <img src="{{ asset('storage/' . $product->image_path) }}" width="120" class="rounded mb-2">
        @else
            <p class="text-muted">Aucune image — une image par défaut est affichée.</p>
        @endif
        <label>Remplacer l'image</label>
        <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Options disponibles pour ce produit</label>
        @forelse($options as $option)
            <div class="form-check">
                <input type="checkbox" name="options[]" value="{{ $option->id }}" class="form-check-input" id="opt{{ $option->id }}"
                    {{ $product->options->contains($option->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="opt{{ $option->id }}">
                    {{ $option->name }}
                    @if($option->is_required) <span class="badge bg-danger">Obligatoire</span> @endif
                </label>
            </div>
        @empty
            <p class="text-muted">Aucune option disponible.</p>
        @endforelse
    </div>

    <button class="btn btn-save">Mettre à jour</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>

</form>

@endsection