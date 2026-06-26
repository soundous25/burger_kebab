<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Connexion | Burger Kebab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>

        body{
            background:#f3f4f6;
            font-family:Arial, Helvetica, sans-serif;
        }

        .login-container{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{

            width:430px;

            background:white;

            border-radius:18px;

            padding:40px;

            box-shadow:0 10px 30px rgba(0,0,0,.08);

        }

        .logo{

            width:75px;
            height:75px;

            background: #1b0c0c;

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

        .btn-login{

            background:#03543f;

            color:white;

            height:48px;

            border:none;

            border-radius:10px;

            font-weight:600;

        }

        .btn-login:hover{

            background:#024c38;

            color:white;

        }

        .register-link{

            text-align:center;

            margin-top:20px;

        }

        .register-link a{

            text-decoration:none;

            font-weight:bold;

            color:#ef4444;

        }

        .register-link a:hover{

            text-decoration:underline;

        }

    </style>

</head>

<body>

<div class="login-container">

    <div class="login-card">

        <div class="logo">
            🍔
        </div>

        <div class="title">
            Burger Kebab
        </div>

        <div class="subtitle">
            Connectez-vous à votre espace d'administration
        </div>

        @if ($errors->any())

            <div class="alert alert-danger">

                {{ $errors->first() }}

            </div>

        @endif

        <form method="POST" action="{{ route('login') }}">

            @csrf

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

            <div class="mb-4">

                <label class="form-label">

                    Mot de passe

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <button class="btn btn-login w-100">

                <i class="fa-solid fa-right-to-bracket"></i>

                Se connecter

            </button>

        </form>

        <div class="register-link">

            Vous n'avez pas de compte ?

            <br>

            <a href="{{ route('register') }}">

                Créer un compte

            </a>

        </div>

    </div>

</div>

</body>

</html>