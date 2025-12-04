<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Culture Bénin')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        body {
            padding-top: 56px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .footer {
            background-color: #f8f9fa;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.accueil') }}">
                <i class="bi bi-globe-americas"></i> Culture Bénin
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.accueil') }}">
                            <i class="bi bi-house"></i> Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contenus.index') }}">
                            <i class="bi bi-book"></i> Contenus
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languesDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-translate"></i> Langues
                        </a>
                        <ul class="dropdown-menu">
                            @foreach(App\Models\Langue::where('is_active', true)->get() as $langue)
                            <li>
                                <a class="dropdown-item" href="{{ route('front.contenus.langue', $langue->code) }}">
                                    {{ $langue->nom }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <!-- Right side -->
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('front.profil.index') }}">
                                    <i class="bi bi-person"></i> Mon profil
                                </a>
                            </li>
                            @if(Auth::user()->hasRole('contributeur') || Auth::user()->hasRole('admin'))
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Administration
                                </a>
                            </li>
                            @else
                            <li>
                                <a class="dropdown-item" href="{{ route('contributeur.form') }}">
                                    <i class="bi bi-pencil-square"></i> Devenir contributeur
                                </a>
                            </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="flex-shrink-0">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-5 py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Culture Bénin</h5>
                    <p>Plateforme de promotion de la culture béninoise.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('front.accueil') }}" class="text-decoration-none">Accueil</a></li>
                        <li><a href="{{ route('front.contenus.index') }}" class="text-decoration-none">Contenus</a></li>
                        <li><a href="{{ route('login') }}" class="text-decoration-none">Connexion</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <p><i class="bi bi-envelope"></i> contact@culturebenin.bj</p>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Culture Bénin. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
