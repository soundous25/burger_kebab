@extends('layouts.app')

@section('module_title', 'Ajouter un supplément')

@section('content')

<h2 class="page-title">Ajouter un supplément</h2>

<form action="{{ route('supplements.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Prix (CHF) — 0 = gratuit</label>
        <input type="number" step="0.01" name="price" class="form-control" value="0" min="0" required>
    </div>

    <button class="btn btn-add">Enregistrer</button>
    <a href="{{ route('supplements.index') }}" class="btn btn-secondary">Retour</a>
</form>

@endsection