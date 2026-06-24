@extends('layouts.app')

@section('module_title', 'Ajouter une option')

@section('content')

<h2 class="page-title">Ajouter une option</h2>

<form action="{{ route('options.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nom de l'option</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" name="is_required" value="1" class="form-check-input" id="is_required" {{ old('is_required') ? 'checked' : '' }}>
        <label class="form-check-label" for="is_required">Option obligatoire</label>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Sélection minimum</label>
            <input type="number" name="min_select" class="form-control" value="{{ old('min_select', 0) }}" min="0" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Sélection maximum</label>
            <input type="number" name="max_select" class="form-control" value="{{ old('max_select', 1) }}" min="1" required>
            @error('max_select') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <button class="btn btn-add">Enregistrer</button>
    <a href="{{ route('options.index') }}" class="btn btn-secondary">Retour</a>
</form>

@endsection