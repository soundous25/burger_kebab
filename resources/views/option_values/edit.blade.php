@extends('layouts.app')

@section('module_title', 'Modifier une valeur')

@section('content')

<h2 class="page-title">Modifier la valeur « {{ $value->name }} »</h2>

<form action="{{ route('option_values.update', $value) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nom de la valeur</label>
        <input type="text" name="name" class="form-control" value="{{ $value->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Suppléments associés</label>
        @foreach($supplements as $supplement)
            <div class="form-check">
                <input type="checkbox" name="supplements[]" value="{{ $supplement->id }}" class="form-check-input" id="supp{{ $supplement->id }}"
                    {{ $value->supplements->contains($supplement->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="supp{{ $supplement->id }}">
                    {{ $supplement->name }} (+{{ number_format($supplement->price, 2) }} CHF)
                </label>
            </div>
        @endforeach
    </div>

    <button class="btn btn-save">Mettre à jour</button>
    <a href="{{ route('options.index') }}" class="btn btn-secondary">Retour</a>
</form>

@endsection