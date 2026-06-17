<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍔BURGER KEBAB</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #111827;
            color: white;
            padding: 20px;
        }

        .brand {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            color: #d1d5db;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: 0.2s;
        }

        .nav-link-custom:hover {
            background: #1f2937;
            color: white;
        }

        .nav-link-custom.active {
            background: #ef4444;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        .card-custom {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .topbar {
            margin-bottom: 20px;
            font-weight: bold;
            color: #111827;
        }

         .btn-save {
            background: #2E7D32;
            color: #FFFFFF;
            border: none;
        }

        .btn-save:hover {
            background: #1D4ED8;
            color: #FFFFFF;
        }

        .btn-edit {
            background: #2563EB;
            color: #FFFFFF;
            border: none;
        }

        .btn-edit:hover {
            background: #1D4ED8;
            color: #FFFFFF;
        }

        .btn-delete {
           background-color: #DC3545;
           color: #FFFFFF;
           border: none;
        }

        .btn-delete:hover {
            background: #DC3545;
            color: #FFFFFF;
        }

        .btn-add {
            background: #2E7D32;
            color: #FFFFFF;
            border: none;
        }

        .btn-sm {
            background: #6C757D;
            color: #FFFFFF;
            border: none;
        }

        .btn-success {
            background: #2E7D32;
            color: #FFFFFF;
            border: none;
        }

        .page-item.active .page-link {
            background-color: #2E7D32;
            border-color: #2E7D32;
            color: white;
        }

        .page-link {
            color: #2E7D32;
        }

        .page-link:hover {
            color: #2E7D32;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <div class="brand">
        🍔 BURGER KEBAB
    </div>

    <a href="{{ route('categories.index') }}"
       class="nav-link-custom {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="fa-solid fa-list"></i>
        Catégories
    </a>

    <a href="{{ route('products.index') }}"
       class="nav-link-custom {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <i class="fa-solid fa-burger"></i>
        Produits
    </a>

</div>

<div class="content">

    <div class="topbar">
        @yield('module_title', 'Dashboard')
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-custom">
        @yield('content')
    </div>

</div>

</body>
</html>