@extends('layouts.app')

@section('content')

<h2 class="page-title">Modifier une catégorie</h2>

<form action="{{ route('categories.update',$category) }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nom</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name',$category->name) }}">

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
               value="{{ old('order',$category->order) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Statut</label>

        <select name="status" class="form-select">

            <option value="1"
                {{ $category->status ? 'selected' : '' }}>
                Actif
            </option>

            <option value="0"
                {{ !$category->status ? 'selected' : '' }}>
                Inactif
            </option>

        </select>
    </div>

    <button class="btn btn-edit">
        Modifier
    </button>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
        Retour
    </a>

</form>

@endsection