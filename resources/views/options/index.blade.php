@extends('layouts.app')

@section('content')
<h1>Options</h1>

@if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif
@if(session('error')) <p style="color:red">{{ session('error') }}</p> @endif

<a href="{{ route('options.create') }}">+ Nouvelle option</a>

<table border="1" cellpadding="6">
    <tr>
        <th>Nom</th><th>Obligatoire</th><th>Min</th><th>Max</th><th>Statut</th><th>Valeurs</th><th>Actions</th>
    </tr>
    @foreach($options as $option)
    <tr>
        <td>{{ $option->name }}</td>
        <td>{{ $option->is_required ? 'Oui' : 'Non' }}</td>
        <td>{{ $option->min_select }}</td>
        <td>{{ $option->max_select }}</td>
        <td>{{ $option->status ? 'Actif' : 'Inactif' }}</td>
        <td>
            <ul>
                @foreach($option->values as $value)
                    <li>
                        {{ $value->name }} ({{ $value->status ? 'actif' : 'inactif' }})
                        <a href="{{ route('option_values.edit', $value) }}">Modifier</a>
                        <form action="{{ route('option_values.destroy', $value) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Supprimer cette valeur ?')">Supprimer</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('option_values.create', $option) }}">+ Ajouter une valeur</a>
        </td>
        <td>
            <a href="{{ route('options.edit', $option) }}">Modifier</a>
            <form action="{{ route('options.toggle', $option) }}" method="POST" style="display:inline">
                @csrf @method('PATCH')
                <button>{{ $option->status ? 'Désactiver' : 'Activer' }}</button>
            </form>
            <form action="{{ route('options.destroy', $option) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Supprimer cette option ?')">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection