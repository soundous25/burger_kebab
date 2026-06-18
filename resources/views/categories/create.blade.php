@extends('layouts.app')

@section('content')

<h2 class="page-title">Ajouter une catégorie</h2>

<form action="{{ route('categories.store') }}" method="POST">

    @csrf

    <div class="mb-3">
        <label class="form-label">Nom</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name') }}">

        @error('name')
            <small class="text-danger">
                {{ $message }}
            </small>
        @enderror


    </div>

    <div class="mb-3">
        <label class="form-label">Ordre d'affichage</label>

        <input type="number"
               name="order"
               class="form-control"
               value="{{ old('order') }}">

               @error ('order')
           <small class="text-danger">
            {{ $message }}
            </small>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Statut</label>

        <select name="status" class="form-select">
            <option value="1">Actif</option>
            <option value="0">Inactif</option>
        </select>
    </div>

    <button class="btn btn-add">
        Enregistrer
    </button>

    <a href="{{ route('categories.index') }}"
       class="btn btn-secondary">
        Retour
    </a>

</form>

@endsection