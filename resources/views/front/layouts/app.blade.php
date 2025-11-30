<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Culture du Bénin')</title>

    {{-- BOOTSTRAP --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    {{-- ICONS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- FONTS --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    {{-- CUSTOM DESIGN FRONT --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #faf9f6;
        }

        /* NAVBAR */
        .navbar-custom {
            background: #0d3b24; /* vert foncé raffiné */
            padding: 12px;
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-custom .nav-link:hover {
            color: #ffcc33 !important; /* or béninois */
        }

        /* HERO SECTION */
        .hero {
            background: url('{{ asset("images/bg-culture.jpg") }}') center/cover no-repeat;
            min-height: 320px;
            position: relative;
            display: flex;
            align-items: center;
            color: #fff;
        }

        .hero::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(10, 25, 20, 0.55);
            backdrop-filter: blur(2px);
        }

        .hero .hero-content {
            position: relative;
            z-index: 2;
        }

        /* FOOTER */
        .footer {
            background: #0d3b24;
            color: #fff;
            padding: 25px 0;
            margin-top: 40px;
        }

        .footer a {
            color: #ffcc33;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>

    @stack('styles')

</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <img src="{{ asset('images/logo-culture.png') }}" height="38" class="me-2">
                Culture Bénin
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <i class="bi bi-list text-white"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.accueil') }}">Accueil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contenus.index') }}">Contenus</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.medias.index') }}">Médias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.recherche') }}">Recherche</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.profil') }}">
                                <i class="bi bi-person-circle"></i> Mon profil
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn btn-link nav-link" style="display:inline">
                                    Déconnexion
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>


    {{-- HERO OPTIONNEL --}}
    @if(View::hasSection('hero'))
        <div class="hero mb-4">
            <div class="container hero-content">
                @yield('hero')
            </div>
        </div>
    @endif


    {{-- MAIN CONTENT --}}
    <div class="container my-4">
        @yield('content')
    </div>


    {{-- FOOTER --}}
    <footer class="footer text-center">
        <div class="container">
            <p class="mb-1">
                &copy; {{ date('Y') }} <strong>Culture Bénin</strong>. Tous droits réservés.
            </p>
            <p class="mb-0">
                <a href="#">À propos</a> ·
                <a href="#">Conditions</a> ·
                <a href="#">Confidentialité</a>
            </p>
        </div>
    </footer>

    {{-- BOOTSTRAP JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
