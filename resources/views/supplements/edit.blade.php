@extends('layouts.app')

@section('module_title', 'Modifier un supplément')

@section('content')

<h2 class="page-title mb-4">Modifier le supplément</h2>

<form action="{{ route('supplements.update', $supplement) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-section">

        <div class="section-title">
            Informations générales
        </div>

        <div class="row">

            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Nom du supplément</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $supplement->name) }}"
                           required>

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Statut</label>

                    <select name="status" class="form-control">
                        <option value="1" {{ $supplement->status ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !$supplement->status ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

        </div>

    </div>

    <div class="form-section">

        <div class="section-title">
            Tarification
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (CHF)</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ old('price', $supplement->price) }}"
                   min="0"
                   required>

            <small class="text-muted">Indique 0 si le supplément est gratuit.</small>

            @error('price')
                <br><small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>

    @if($supplement->optionValues->count() > 0)
    <div class="form-section">
        <div class="section-title">
            Valeurs d'options associées
        </div>
        <ul class="list-unstyled mb-0">
            @foreach($supplement->optionValues as $value)
                <li class="mb-1">
                    <span class="badge bg-light text-dark border">
                        {{ $value->option->name }} → {{ $value->name }}
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="actions-bar">

        <a href="{{ route('supplements.index') }}" class="btn btn-secondary">
            Retour
        </a>

        <button type="submit" class="btn btn-add">
            Mettre à jour
        </button>

    </div>

</form>

@endsection