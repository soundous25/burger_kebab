@extends('layouts.app')

@section('module_title', 'Ajouter un supplément')

@section('content')

<h2 class="page-title mb-4">Ajouter un supplément</h2>

<form action="{{ route('supplements.store') }}" method="POST">
    @csrf

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
                           value="{{ old('name') }}"
                           placeholder="Ex : Bacon, Fromage supplémentaire, Œuf..."
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
                        <option value="1">Actif</option>
                        <option value="0">Inactif</option>
                    </select>
                </div>
            </div>

        </div>

    </div>

    <div class="form-section mt-4">

        <div class="section-title">
            Tarification
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (CHF)</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ old('price', 0) }}"
                   min="0"
                   required>

            <small class="text-muted">Indique 0 si le supplément est gratuit.</small>

            @error('price')
                <br><small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

    </div>

    <div class="actions-bar">

        <a href="{{ route('supplements.index') }}" class="btn btn-secondary">
            Retour
        </a>

        <button type="submit" class="btn btn-add">
            Enregistrer
        </button>

    </div>

</form>

@endsection