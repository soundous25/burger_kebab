@extends('layouts.app')

@section('module_title', 'Ajouter un produit')

@section('content')

<h2 class="page-title mb-4">Ajouter un produit</h2>

<form action="{{ route('products.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="form-section">

        <div class="section-title">
            Informations générales
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Catégorie</label>

                        <select name="category_id"
                                class="form-control"
                                required>

                            <option value="">
                                -- Choisir une catégorie --
                            </option>

                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">
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
                               required>
                    </div>

                </div>

                <div class="mb-3">
                    <label>Nom du produit</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description"
                              rows="5"
                              class="form-control"
                              required></textarea>
                </div>

            </div>

            <div class="col-md-4">

                <div class="mb-3">

                    <label>Image du produit</label>

                    <div class="image-preview mb-3">
                        <i class="fa-solid fa-image fa-3x text-secondary"></i>
                        <p class="mt-2 text-muted">
                            Aucune image sélectionnée
                        </p>
                    </div>

                    <input type="file"
                           name="image"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">

                </div>

                <div class="mb-3">
                    <label>Statut</label>

                    <select name="status"
                            class="form-control">

                        <option value="1">
                            Actif
                        </option>

                        <option value="0">
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

        <button class="btn btn-add">
            Enregistrer
        </button>

    </div>

</form>

@endsection