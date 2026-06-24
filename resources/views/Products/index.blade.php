@extends('layouts.app')

@section('content')

<h2 class="page-title">Produits</h2>

<div class="row align-items-center mb-4 g-2">
    <div class="col-md-8">
        <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">

    <input 
        type="text"
        name="search"
        class="form-control"
        placeholder="Rechercher un produit..."
        value="{{ request('search') }}"
    >

    <select name="category_id" class="form-select" style="width: 220px;">
        <option value="">Toutes les catégories</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach

    </select>

    <button type="submit" class="btn btn-primary">
        Filtrer
    </button>

    @if(request('search') || request('category_id'))
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            Réinitialiser
        </a>
    @endif

</form>
    </div>

    <div class="col-md-4 text-end">
        <a href="{{ route('products.create') }}" class="btn btn-add m-0">
             + Ajouter un produit
         </a>
    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($products as $product)
        <tr>
            <td>
               @if($product->image_path)
                 <img src="{{ asset('storage/' . $product->image_path) }}" width="50" class="rounded">
              @else
                 <img src="{{ asset('images/no-image.png') }}" width="50" class="rounded">
             @endif
           </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'Sans catégorie' }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ number_format($product->price, 2) }} CHF</td>

            <td>
                <form action="{{ route('products.toggle', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                   <button class="btn btn-sm {{ $product->status ? 'btn-success' : 'btn-inactive' }}">
                        {{ $product->status ? 'Actif' : 'Inactif' }}
                    </button>
                </form>
            </td>

     <td>
               @if($product->image_path)
                 <img src="{{ asset('storage/' . $product->image_path) }}" width="60">
           @else
                <img src="{{ asset('images/no-image.png') }}" width="60">
          @endif
    </td>

            <td>

               <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary" title="Voir">
                   <i class="fa-solid fa-eye"></i>
              </a>

                <a href="{{ route('products.edit', $product) }}" class="btn btn-edit d-inline-flex align-items-center justify-content-center" title="Modifier">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                       <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                       <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </a>

                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline" onsubmit="return confirm ('confirmer la suppression');" >
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
            <td colspan="6" class="text-center text-muted py-3">
                Aucun produit trouvé.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $products->appends(request()->query())->links() }}
</div>

@endsection