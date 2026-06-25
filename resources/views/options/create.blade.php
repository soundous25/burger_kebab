@extends('layouts.app')

@section('module_title', 'Ajouter une option')

@section('content')

<h2 class="page-title mb-4">Ajouter une option</h2>

<form action="{{ route('options.store') }}" method="POST">
    @csrf

    <div class="form-section">

        <div class="section-title">
            Informations générales
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="mb-3">
                    <label class="form-label">Nom de l'option</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           placeholder="Ex : Choix sauce, Taille, Cuisson..."
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
            Configuration des sélections
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox"
                   name="is_required"
                   value="1"
                   class="form-check-input"
                   id="is_required"
                   {{ old('is_required') ? 'checked' : '' }}>

            <label class="form-check-label" for="is_required">
                Option obligatoire
            </label>
        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Sélection minimum
                </label>

                <input type="number"
                       name="min_select"
                       class="form-control"
                       value="{{ old('min_select', 0) }}"
                       min="0"
                       required>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Sélection maximum
                </label>

                <input type="number"
                       name="max_select"
                       class="form-control"
                       value="{{ old('max_select', 1) }}"
                       min="1"
                       required>

                @error('max_select')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

        </div>

    </div>

    <div class="actions-bar">

        <a href="{{ route('options.index') }}"
           class="btn btn-secondary">
            Retour
        </a>

        <button type="submit"
                class="btn btn-add">
            Enregistrer
        </button>

    </div>

</form>

@endsection