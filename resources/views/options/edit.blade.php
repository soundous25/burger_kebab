@extends('layouts.app')

@section('module_title', 'Modifier une option')

@section('content')

<nav style="font-size:13px; color:#888; margin-bottom:10px;">
    <a href="{{ route('options.index') }}">Options</a> &gt; Modifier option
</nav>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- BLOC 1 : Informations de l'option --}}
<div class="form-section">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="section-title mb-0">Informations de l'option</div>

        <form action="{{ route('options.destroy', $option) }}" method="POST"
              onsubmit="return confirm('Supprimer cette option ?');">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-delete">Supprimer l'option</button>
        </form>
    </div>

    <form action="{{ route('options.update', $option) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Nom de l'option</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $option->name) }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Champ</label>
                <select name="is_required" class="form-control">
                    <option value="1" {{ $option->is_required ? 'selected' : '' }}>Obligatoire</option>
                    <option value="0" {{ !$option->is_required ? 'selected' : '' }}>Facultatif</option>
                </select>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Sélection min</label>
                <input type="number" name="min_select" class="form-control"
                       value="{{ old('min_select', $option->min_select) }}" min="0" required>
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Sélection max</label>
                <input type="number" name="max_select" class="form-control"
                       value="{{ old('max_select', $option->max_select) }}" min="1" required>
                @error('max_select') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Statut</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $option->status ? 'selected' : '' }}>Actif</option>
                    <option value="0" {{ !$option->status ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>
        </div>

        <div class="actions-bar">
            <a href="{{ route('options.index') }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-add">Enregistrer</button>
        </div> 
    </form>

</div>

{{-- BLOC 2 : Valeurs de l'option --}}
<div class="form-section mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="section-title mb-0">Valeurs de l'option</div>

        <a href="{{ route('option_values.create', $option) }}" class="btn btn-add">
            + Ajouter une valeur
        </a>
    </div>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>Nom de la valeur</th>
                <th>Suppléments associés</th>
                <th>Statut</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($option->values as $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>
                    @forelse($value->supplements as $supplement)
                        <span class="badge bg-light text-dark border">
                            {{ $supplement->name }}
                            @if($supplement->price > 0)
                                +{{ number_format($supplement->price, 2) }} CHF
                            @endif
                        </span>
                    @empty
                        <span class="text-muted">—</span>
                    @endforelse
                </td>
                <td>
                    <form action="{{ route('option_values.toggle', $value) }}" method="POST" class="d-inline">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm {{ $value->status ? 'btn-success' : 'btn-inactive' }}">
                            {{ $value->status ? 'Actif' : 'Inactif' }}
                        </button>
                    </form>
                </td>
                <td class="text-end">
                <a href="{{ route('option_values.edit', $value) }}" class="btn btn-edit d-inline-flex align-items-center justify-content-center" title="Modifier">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                       <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                       <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </a>
                    <form action="{{ route('option_values.destroy', $value) }}" method="POST" style="display:inline" onsubmit="return confirm ('confirmer la suppression');" >
                         @csrf
                          @method('DELETE')
                        <button type="submit" class="btn btn-delete d-inline-flex align-items-center justify-content-center" title="Supprimer">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                             <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                          </svg>
                      </button>
                  </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-3">Aucune valeur pour cette option.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <p class="text-muted small mb-0">{{ $option->values->count() }} valeur(s) pour cette option</p>

</div>

@endsection