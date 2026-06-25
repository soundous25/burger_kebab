@extends('layouts.app')

@section('module_title', 'Suppléments')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h2 class="page-title">Suppléments</h2>

    <a href="{{ route('supplements.create') }}" class="btn btn-add">
        + Ajouter un supplément
    </a>
</div>

<table class="table align-middle">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Utilisé par</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($supplements as $supplement)
        <tr>
            <td>{{ $supplement->name }}</td>
            <td>
                @if($supplement->price > 0)
                    +{{ number_format($supplement->price, 2) }} CHF
                @else
                    <span class="badge bg-info text-dark">Gratuit</span>
                @endif
            </td>
            <td>
                <form action="{{ route('supplements.toggle', $supplement) }}" method="POST" class="d-inline">
                    @csrf @method('PATCH')
                    <button class="btn btn-sm {{ $supplement->status ? 'btn-success' : 'btn-inactive' }}">
                        {{ $supplement->status ? 'Actif' : 'Inactif' }}
                    </button>
                </form>
            </td>
            <td>
                {{ $supplement->optionValues->count() }} valeur(s) d'option
            </td>
            <td>
                <a href="{{ route('supplements.edit', $supplement) }}" class="btn btn-edit d-inline-flex align-items-center justify-content-center" title="Modifier">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <form action="{{ route('supplements.destroy', $supplement) }}" method="POST"
                      onsubmit="return confirm('Confirmer la suppression ?');" class="d-inline">
                    @csrf @method('DELETE')
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
            <td colspan="5" class="text-center text-muted py-3">Aucun supplément trouvé.</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection