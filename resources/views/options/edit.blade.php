@extends('layouts.app')

@section('module_title', 'Modifier une option')

@section('content')

<h2 class="page-title">Modifier l'option</h2>

<form action="{{ route('options.update', $option) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nom de l'option</label>
        <input type="text" name="name" class="form-control" value="{{ $option->name }}" required>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_required" value="1" class="form-check-input" id="is_required" {{ $option->is_required ? 'checked' : '' }}>
        <label class="form-check-label" for="is_required">Option obligatoire</label>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Sélection minimum</label>
            <input type="number" name="min_select" class="form-control" value="{{ $option->min_select }}" min="0" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Sélection maximum</label>
            <input type="number" name="max_select" class="form-control" value="{{ $option->max_select }}" min="1" required>
        </div>
    </div>

    <button class="btn btn-save">Mettre à jour</button>
    <a href="{{ route('options.index') }}" class="btn btn-secondary">Retour</a>
</form>

@endsection