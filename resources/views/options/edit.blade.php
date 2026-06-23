@extends('layouts.app')

@section('content')
<h1>Modifier l'option</h1>

<form action="{{ route('options.update', $option) }}" method="POST">
    @csrf @method('PUT')
    <label>Nom</label>
    <input type="text" name="name" value="{{ $option->name }}" required>

    <label><input type="checkbox" name="is_required" value="1" {{ $option->is_required ? 'checked' : '' }}> Obligatoire</label>

    <label>Sélection minimum</label>
    <input type="number" name="min_select" value="{{ $option->min_select }}" min="0" required>

    <label>Sélection maximum</label>
    <input type="number" name="max_select" value="{{ $option->max_select }}" min="1" required>

    <button type="submit">Mettre à jour</button>
</form>
@endsection