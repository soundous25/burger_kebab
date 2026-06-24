@extends('layouts.app')

@section('module_title', 'Options')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2 class="page-title">Options</h2>

    <a href="{{ route('options.create') }}" class="btn btn-add">
        + Ajouter une option
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Obligatoire</th>
            <th>Min</th>
            <th>Max</th>
            <th>Statut</th>
            <th>Valeurs</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($options as $option)
        <tr>
            <td>{{ $option->name }}</td>
            <td>
                @if($option->is_required)
                    <span class="badge bg-danger">Obligatoire</span>
                @else
                    <span class="badge bg-secondary">Facultatif</span>
                @endif
            </td>
            <td>{{ $option->min_select }}</td>
            <td>{{ $option->max_select }}</td>
            <td>
                <form action="{{ route('options.toggle', $option) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm {{ $option->status ? 'btn-success' : 'btn-inactive' }}">
                        {{ $option->status ? 'Actif' : 'Inactif' }}
                    </button>
                </form>
            </td>
            <td>
                <ul class="list-unstyled mb-2">
                    @foreach($option->values as $value)
                        <li class="d-flex align-items-center gap-2 mb-1">
                            <span class="{{ $value->status ? '' : 'text-muted' }}">{{ $value->name }}</span>
                            <a href="{{ route('option_values.edit', $value) }}" class="btn btn-sm btn-edit" title="Modifier">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('option_values.toggle', $value) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <button class="btn btn-sm {{ $value->status ? 'btn-success' : 'btn-inactive' }}">
                                    {{ $value->status ? 'Actif' : 'Inactif' }}
                                </button>
                            </form>
                            <form action="{{ route('option_values.destroy', $value) }}" method="POST"
                                  onsubmit="return confirm('Supprimer cette valeur ?');" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('option_values.create', $option) }}" class="btn btn-sm btn-primary">
                    + Valeur
                </a>
            </td>
            <td>
                <a href="{{ route('options.edit', $option) }}" class="btn btn-edit d-inline-flex align-items-center justify-content-center" title="Modifier">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('options.destroy', $option) }}" method="POST"
                      onsubmit="return confirm('Supprimer cette option ?');" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-delete d-inline-flex align-items-center justify-content-center" title="Supprimer">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center text-muted py-3">Aucune option trouvée.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection