@extends('layouts.app')

@section('module_title', 'Ajouter une valeur')

@section('content')

<h2 class="page-title mb-4">
    Nouvelle valeur pour « {{ $option->name }} »
</h2>

<form action="{{ route('option_values.store', $option) }}" method="POST">
    @csrf

    <div class="form-section">

        <div class="section-title">
            Informations générales
        </div>

        <div class="mb-3">
            <label class="form-label">Nom de la valeur</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name') }}"
                   placeholder="Ex : Ketchup, Saignant, Bacon..."
                   required>

            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>

    <div class="form-section mt-4">

        <div class="section-title">
            Suppléments associés (facultatif)
        </div>

        @forelse($supplements as $supplement)
            <div class="form-check">
                <input type="checkbox"
                       name="supplements[]"
                       value="{{ $supplement->id }}"
                       class="form-check-input"
                       id="supp{{ $supplement->id }}">

                <label class="form-check-label" for="supp{{ $supplement->id }}">
                    {{ $supplement->name }}
                    @if($supplement->price > 0)
                        <span class="badge bg-light text-dark border">+{{ number_format($supplement->price, 2) }} CHF</span>
                    @else
                        <span class="badge bg-info text-dark">Gratuit</span>
                    @endif
                </label>
            </div>
        @empty
            <p class="text-muted mb-0">
                Aucun supplément disponible.
                <a href="{{ route('supplements.create') }}">En créer un</a>.
            </p>
        @endforelse

    </div>

    <div class="actions-bar">

        <a href="{{ route('options.index') }}" class="btn btn-secondary">
            Retour
        </a>

        <button type="submit" class="btn btn-add">
            Ajouter
        </button>

    </div>

</form>

@endsection