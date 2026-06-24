@extends('layouts.app')

@section('module_title', 'Modifier un supplément')

@section('content')

<h2 class="page-title">Modifier le supplément</h2>

<form action="{{ route('supplements.update', $supplement) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="name" class="form-control" value="{{ $supplement->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prix (CHF)</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ $supplement->price }}" min="0" required>
    </div>

    <button class="btn btn-save">Mettre à jour</button>
    <a href="{{ route('supplements.index') }}" class="btn btn-secondary">Retour</a>
</form>

@endsection