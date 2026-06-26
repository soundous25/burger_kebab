@extends('layouts.app')

@section('module_title', 'Tableau de bord')

@section('content')

<div class="mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h2 class="fw-bold mb-3">
                    Bienvenue, {{ Auth::user()->name ?? 'Administrateur' }} 👋
                </h2>

                <p class="text-muted mb-0">
                    Gérez facilement les catégories, produits, options et suppléments
                    de votre restaurant Burger Kebab.
                </p>
            </div>

            <div>
                <img src="{{ asset('images/burger kebab.png') }}"
                     width="170"
                     alt="Burger">
            </div>

        </div>
    </div>
</div>


<div class="row">

    <div class="col-lg-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fa-solid fa-folder fa-3x text-success mb-3"></i>
                <h3>{{ \App\Models\Category::count() }}</h3>
                <p class="text-muted mb-0">Catégories</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fa-solid fa-burger fa-3x text-danger mb-3"></i>
                <h3>{{ \App\Models\Product::count() }}</h3>
                <p class="text-muted mb-0">Produits</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fa-solid fa-gear fa-3x text-primary mb-3"></i>
                <h3>{{ \App\Models\Option::count() }}</h3>
                <p class="text-muted mb-0">Options</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <i class="fa-solid fa-circle-plus fa-3x text-warning mb-3"></i>
                <h3>{{ \App\Models\Supplement::count() }}</h3>
                <p class="text-muted mb-0">Suppléments</p>
            </div>
        </div>
    </div>

</div>


<div class="row">

    {{-- Accès rapides --}}
    <div class="col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">
                <strong>Accès rapides</strong>
            </div>

            <div class="card-body">

                <a href="{{ route('categories.create') }}" class="btn btn-success w-100 mb-3">
                    <i class="fa-solid fa-folder-plus"></i>
                    Ajouter une catégorie
                </a>

                <a href="{{ route('products.create') }}" class="btn btn-danger w-100 mb-3">
                    <i class="fa-solid fa-burger"></i>
                    Ajouter un produit
                </a>

                <a href="{{ route('options.create') }}" class="btn btn-primary w-100 mb-3">
                    <i class="fa-solid fa-gear"></i>
                    Ajouter une option
                </a>

                <a href="{{ route('supplements.create') }}" class="btn btn-warning w-100">
                    <i class="fa-solid fa-circle-plus"></i>
                    Ajouter un supplément
                </a>

            </div>

        </div>

    </div>


    {{-- Dernières modifications --}}
    <div class="col-md-6 mb-4">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white">
                <strong>Dernières modifications</strong>
            </div>

            <div class="card-body">

               @forelse($activities as $activity)

<div class="d-flex justify-content-between align-items-center border-bottom py-3">

    <div class="d-flex align-items-center">

        <i class="fa-solid {{ $activity['icon'] }} text-{{ $activity['color'] }} me-3 fs-4"></i>

        <div>
            <strong>{{ $activity['name'] }}</strong><br>

            <small class="text-muted">
                {{ $activity['module'] }} ajouté ou modifié
            </small>
        </div>

    </div>

    <small class="text-muted">
        {{ $activity['date']->diffForHumans() }}
    </small>

</div>

@empty

<p class="text-muted mb-0">
    Aucune modification récente.
</p>

@endforelse

            </div>

        </div>

    </div>

</div>

@endsection