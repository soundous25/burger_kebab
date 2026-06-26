<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Créer un compte | Burger Kebab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>

        body{
            background:#f3f4f6;
            font-family:Arial, Helvetica, sans-serif;
        }

        .register-container{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .register-card{

            width:460px;

            background:white;

            border-radius:18px;

            padding:40px;

            box-shadow:0 10px 30px rgba(0,0,0,.08);

        }

        .logo{

            width:75px;
            height:75px;

            background:#ef4444;

            color:white;

            border-radius:50%;

            display:flex;

            justify-content:center;

            align-items:center;

            font-size:34px;

            margin:auto;

            margin-bottom:18px;

        }

        .title{

            text-align:center;

            font-size:28px;

            font-weight:bold;

            color:#111827;

        }

        .subtitle{

            text-align:center;

            color:#6b7280;

            margin-bottom:35px;

        }

        .form-label{

            font-weight:600;

        }

        .form-control{

            height:48px;

            border-radius:10px;

        }

        .btn-register{

            background:#03543f;

            color:white;

            height:48px;

            border:none;

            border-radius:10px;

            font-weight:600;

        }

        .btn-register:hover{

            background:#024c38;

            color:white;

        }

        .login-link{

            text-align:center;

            margin-top:20px;

        }

        .login-link a{

            text-decoration:none;

            color:#ef4444;

            font-weight:bold;

        }

        .login-link a:hover{

            text-decoration:underline;

        }

    </style>

</head>

<body>

<div class="register-container">

    <div class="register-card">

        <div class="logo">
            🍔
        </div>

        <div class="title">
            Burger Kebab
        </div>

        <div class="subtitle">
            Créer un compte administrateur
        </div>

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form method="POST" action="{{ route('register') }}">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Nom complet

                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Adresse e-mail

                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Mot de passe

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Confirmer le mot de passe

                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required>

            </div>

            <button type="submit" class="btn btn-register w-100">

                <i class="fa-solid fa-user-plus"></i>

                Créer un compte

            </button>

        </form>

        <div class="login-link">

            Vous avez déjà un compte ?

            <br>

            <a href="{{ route('login') }}">

                Se connecter

            </a>

        </div>

    </div>

</div>

</body>

</html>