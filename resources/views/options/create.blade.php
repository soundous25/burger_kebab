@extends('layouts.app')

@section('content')
<h1>Nouvelle option</h1>

<form action="{{ route('options.store') }}" method="POST">
    @csrf
    <label>Nom</label>
    <input type="text" name="name" value="{{ old('name') }}" required>

    <label><input type="checkbox" name="is_required" value="1"> Obligatoire</label>

    <label>Sélection minimum</label>
    <input type="number" name="min_select" value="0" min="0" required>

    <label>Sélection maximum</label>
    <input type="number" name="max_select" value="1" min="1" required>

    @error('name') <p style="color:red">{{ $message }}</p> @enderror
    @error('max_select') <p style="color:red">{{ $message }}</p> @enderror

    <button type="submit">Créer</button>
</form>
@endsection