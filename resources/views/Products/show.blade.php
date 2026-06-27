@extends('layouts.app')

@section('module_title', 'Voir le produit')

@section('content')

<h2 class="page-title mb-4">Détails du produit</h2>

<div class="form-section">

    <div class="section-title">
        Informations générales
    </div>

    <div class="row">

        <div class="col-md-8">

            <div class="mb-3">
                <label class="form-label fw-bold">Nom</label>
                <input type="text"
                       class="form-control"
                       value="{{ $product->name }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Catégorie</label>
                <input type="text"
                       class="form-control"
                       value="{{ $product->category->name }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Prix (CHF)</label>
                <input type="text"
                       class="form-control"
                       value="{{ number_format($product->price,2) }}"
                       readonly>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea class="form-control"
                          rows="5"
                          readonly>{{ $product->description }}</textarea>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <label class="form-label fw-bold">Statut</label>

                    <input type="text"
                           class="form-control"
                           value="{{ $product->status ? 'Actif' : 'Inactif' }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">ID</label>

                    <input type="text"
                           class="form-control"
                           value="{{ $product->id }}"
                           readonly>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-6">
                    <label class="form-label fw-bold">Date de création</label>

                    <input type="text"
                           class="form-control"
                           value="{{ $product->created_at->format('d/m/Y H:i') }}"
                           readonly>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Dernière modification</label>

                    <input type="text"
                           class="form-control"
                           value="{{ $product->updated_at->format('d/m/Y H:i') }}"
                           readonly>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <label class="form-label fw-bold">Image du produit</label>

            <div class="image-preview">

                @if($product->image)

                    <img src="{{ asset('storage/'.$product->image) }}"
                         alt="{{ $product->name }}">

                @else

                    <p class="text-muted mt-5">
                        Aucune image disponible
                    </p>

                @endif

            </div>

        </div>

    </div>

</div>

<div class="actions-bar">

    <a href="{{ route('products.index') }}"
       class="btn btn-secondary">

        Retour

    </a>

</div>

@endsection