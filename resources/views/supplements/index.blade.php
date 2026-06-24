@extends('layouts.app')

@section('module_title', 'Suppléments')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2 class="page-title">Suppléments</h2>

    <a href="{{ route('supplements.create') }}" class="btn btn-add">
        + Ajouter un supplément
    </a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($supplements as $supplement)
        <tr>
            <td>{{ $supplement->name }}</td>
            <td>{{ number_format($supplement->price, 2) }} CHF</td>
            <td>
                <form action="{{ route('supplements.toggle', $supplement) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm {{ $supplement->status ? 'btn-success' : 'btn-inactive' }}">
                        {{ $supplement->status ? 'Actif' : 'Inactif' }}
                    </button>
                </form>
            </td>
            <td>
                <a href="{{ route('supplements.edit', $supplement) }}" class="btn btn-edit d-inline-flex align-items-center justify-content-center" title="Modifier">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('supplements.destroy', $supplement) }}" method="POST"
                      onsubmit="return confirm('Supprimer ce supplément ?');" class="d-inline">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-delete d-inline-flex align-items-center justify-content-center" title="Supprimer">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center text-muted py-3">Aucun supplément trouvé.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection