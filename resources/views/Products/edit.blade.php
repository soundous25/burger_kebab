@extends('layouts.app')

@section('module_title', 'Modifier un produit')

@section('content')

<h2 class="page-title mb-4">Modifier le produit</h2>

<form action="{{ route('products.update', $product->id) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="form-section">

        <div class="section-title">
            Informations générales
        </div>

        <div class="row">

            <!-- Partie gauche -->
            <div class="col-md-8">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Catégorie</label>

                        <select name="category_id"
                                class="form-control"
                                required>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Prix (CHF)</label>

                        <input type="number"
                               step="0.01"
                               name="price"
                               class="form-control"
                               value="{{ $product->price }}"
                               required>
                    </div>

                </div>

                <div class="mb-3">
                    <label>Nom du produit</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ $product->name }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description"
                              rows="5"
                              class="form-control">{{ $product->description }}</textarea>
                </div>

            </div>

            <!-- Partie droite -->
            <div class="col-md-4">

                <div class="mb-3">

                    <label>Image actuelle</label>

                    <div class="image-preview mb-3">

                        @if($product->image)

                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}">

                        @else

                            <i class="fa-solid fa-image fa-3x text-secondary"></i>

                            <p class="mt-2 text-muted">
                                Aucune image disponible
                            </p>

                        @endif

                    </div>

                    <label>Remplacer l'image</label>

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">

                    @error('image')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Statut</label>

                    <select name="status"
                            class="form-control">

                        <option value="1"
                            {{ $product->status ? 'selected' : '' }}>
                            Actif
                        </option>

                        <option value="0"
                            {{ !$product->status ? 'selected' : '' }}>
                            Inactif
                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

    <div class="form-section">

        <div class="section-title">
            Options disponibles
        </div>

        <div class="row">

            @forelse($options as $option)

                <div class="col-md-4 mb-2">

                    <div class="form-check">

                        <input
                            type="checkbox"
                            name="options[]"
                            value="{{ $option->id }}"
                            class="form-check-input"
                            id="opt{{ $option->id }}"
                            {{ $product->options->contains($option->id) ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label"
                            for="opt{{ $option->id }}"
                        >

                            {{ $option->name }}

                            @if($option->is_required)
                                <span class="badge bg-danger">
                                    Obligatoire
                                </span>
                            @endif

                        </label>

                    </div>

                </div>

            @empty

                <p class="text-muted">
                    Aucune option disponible.
                </p>

            @endforelse

        </div>

    </div>

    <div class="actions-bar">

        <a href="{{ route('products.index') }}"
           class="btn btn-secondary">
            Retour
        </a>

        <button type="submit"
                class="btn btn-save">
            Mettre à jour
        </button>

    </div>

</form>

@endsection