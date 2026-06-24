@extends('layouts.app')

@section('module_title', 'Ajouter une valeur')

@section('content')

<h2 class="page-title">Nouvelle valeur pour « {{ $option->name }} »</h2>

<form action="{{ route('option_values.store', $option) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nom de la valeur</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Suppléments associés (facultatif)</label>
        @forelse($supplements as $supplement)
            <div class="form-check">
                <input type="checkbox" name="supplements[]" value="{{ $supplement->id }}" class="form-check-input" id="supp{{ $supplement->id }}">
                <label class="form-check-label" for="supp{{ $supplement->id }}">
                    {{ $supplement->name }} (+{{ number_format($supplement->price, 2) }} CHF)
                </label>
            </div>
        @empty
            <p class="text-muted">Aucun supplément disponible. <a href="{{ route('supplements.create') }}">En créer un</a>.</p>
        @endforelse
    </div>

    <button class="btn btn-add">Ajouter</button>
    <a href="{{ route('options.index') }}" class="btn btn-secondary">Retour</a>
</form>

@endsection