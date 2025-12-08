<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Culture Bénin | Plateforme culturelle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Découvrez la richesse culturelle du Bénin : patrimoine, art, histoire, traditions et modernité.">

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>

    {{-- Style personnalisé --}}
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <style>
        :root {
            --primary: #1a365d;
            --secondary: #d4af37;
            --accent: #c53030;
            --light: #f7fafc;
            --dark: #1a202c;
            --indigo: #2d3748;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
        }

        /* NAVBAR */
        .front-navbar {
            background: #ffffff !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary) !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--accent) !important;
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.3rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent) !important;
            background-color: rgba(197, 48, 48, 0.08);
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background: var(--secondary);
            border-radius: 2px;
        }

        /* Boutons */
        .btn-accent {
            background: linear-gradient(135deg, var(--accent), #e53e3e);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .btn-accent:hover {
            background: linear-gradient(135deg, #e53e3e, var(--accent));
            color: white;
            transform: translateY(-2px);
        }

        .btn-gold {
            background: var(--secondary);
            border-color: var(--secondary);
            color: #1f2933;
            font-weight: 600;
        }
        .btn-gold:hover {
            background: #f6e05e;
            border-color: #f6e05e;
            color: #111827;
        }

        /* HERO STANDARD UTILISÉ PAR LES PAGES (home, show, etc.) */
        .page-header-hero {
            background: radial-gradient(circle at top left, #1d2960, #020617);
            color: #f9fafb;
            padding: 40px 0 30px;
            margin-bottom: 20px;
        }

        /* Cartes de contenu (pour harmoniser avec les pages) */
        .contenu-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all .3s;
            height: 100%;
        }
        .contenu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 22px rgba(0,0,0,0.15);
        }

        .contenu-cover {
            width: 100%;
            height: 170px;
            object-fit: cover;
        }

        .badge-premium {
            background: #d4a017;
            color: #fff;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: .75rem;
        }

        /* Overlay de recherche */
        .search-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(26, 54, 93, 0.97);
            backdrop-filter: blur(10px);
            z-index: 9999;
            display: none;
            padding-top: 20vh;
        }

        .search-input {
            max-width: 700px;
            margin: 0 auto;
            border-radius: 50px;
            padding: 1.5rem 2rem;
            font-size: 1.3rem;
            border: 2px solid var(--secondary);
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .nav-search-btn {
            background: var(--secondary);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        .nav-search-btn:hover {
            background: var(--accent);
            transform: rotate(15deg);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        /* Footer */
        .site-footer {
            background: var(--primary);
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }
        .footer-links {
            list-style: none;
            padding-left: 0;
        }
        .footer-links li {
            margin-bottom: .7rem;
        }
        .footer-links a {
            color: #e2e8f0;
            text-decoration: none;
            transition: all .2s;
        }
        .footer-links a:hover {
            color: var(--secondary);
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .social-icon {
            width: 38px;
            height: 38px;
            border-radius: 999px;
            background: rgba(255,255,255,0.1);
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.4rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- OVERLAY DE RECHERCHE --}}
    <div id="searchOverlay" class="search-overlay">
        <div class="container">
            <form action="{{ route('front.search') }}" method="GET" class="mb-4 position-relative">
                <input type="text" name="q" class="form-control search-input"
                       placeholder="Rechercher un contenu, un article, une tradition...">
                <button type="submit"
                        class="btn btn-accent position-absolute"
                        style="right: 20px; top: 50%; transform: translateY(-50%);">
                    <i class="bi bi-search"></i> Rechercher
                </button>
            </form>

            <div class="text-center">
                <button onclick="closeSearch()"
                        class="btn btn-outline-light rounded-circle"
                        style="width: 50px; height: 50px;">
                    <i class="bi bi-x-lg"></i>
                </button>
                <p class="text-light mt-3">Appuyez sur Échap pour fermer</p>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg front-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-3" href="{{ url('/') }}">
                <img src="{{ asset('images/slides/logo-b.jpg') }}"
                     alt="Logo Culture Bénin"
                     style="height:45px; width:auto; border-radius:8px;">
                <div>
                    <div style="line-height:1.1">Culture Bénin</div>
                    <small style="font-size:0.7rem; color: var(--accent);">
                        Patrimoine • Tradition • Modernité
                    </small>
                </div>
            </a>

            <button class="navbar-toggler border-1" type="button"
                    data-bs-toggle="collapse" data-bs-target="#frontNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="frontNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}"
                           href="{{ route('front.home') }}">
                            <i class="bi bi-house-door me-1"></i> Accueil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.contenus.*') ? 'active' : '' }}"
                           href="{{ route('front.contenus.index') }}">
                            <i class="bi bi-book me-1"></i> Contenus
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.medias.*') ? 'active' : '' }}"
                           href="{{ route('front.medias.index') }}">
                            <i class="bi bi-camera-reels me-1"></i> Médias
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.apropos') ? 'active' : '' }}"
                           href="{{ route('front.apropos') }}">
                            <i class="bi bi-info-circle me-1"></i> À propos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}"
                           href="{{ route('front.contact') }}">
                            <i class="bi bi-envelope me-1"></i> Contact
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item me-3">
                        <button class="nav-search-btn" onclick="openSearch()" title="Recherche">
                            <i class="bi bi-search"></i>
                        </button>
                    </li>

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                               href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span style="color: var(--dark);">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('front.profil.edit', auth()->user()) }}">
                                        <i class="bi bi-person me-2"></i> Mon profil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('front.mes.achats') ?? '#' }}">
                                        <i class="bi bi-bag-check me-2"></i> Mes achats
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        <button class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="nav-link" style="color: var(--primary) !important;">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-accent">
                                <i class="bi bi-person-plus me-1"></i> Inscription
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- HERO SPÉCIFIQUE À CHAQUE PAGE --}}
    @hasSection('hero')
        @yield('hero')
    @endif

    {{-- CONTENU PRINCIPAL --}}
    <main class="min-vh-100">
        <div class="container py-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="mb-3" style="color: var(--secondary); font-family:'Playfair Display',serif;">
                        Culture Bénin
                    </h3>
                    <p class="text-light" style="opacity: 0.8;">
                        Plateforme numérique dédiée à la préservation et à la promotion du riche patrimoine culturel béninois.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="mb-3" style="color: var(--secondary);">Navigation</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('front.home') }}">Accueil</a></li>
                        <li><a href="{{ route('front.contenus.index') }}">Contenus</a></li>
                        <li><a href="{{ route('front.medias.index') }}">Médias</a></li>
                        <li><a href="{{ route('front.apropos') }}">À propos</a></li>
                        <li><a href="{{ route('front.contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3" style="color: var(--secondary);">Ressources</h6>
                    <ul class="footer-links">
                        <li><a href="#">Articles de recherche</a></li>
                        <li><a href="#">Documentaires</a></li>
                        <li><a href="#">Cartes interactives</a></li>
                        <li><a href="#">Calendrier culturel</a></li>
                        <li><a href="#">Publications</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <h6 class="mb-3" style="color: var(--secondary);">Contact</h6>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt me-2"></i> Porto-Novo, Bénin</li>
                        <li><i class="bi bi-envelope me-2"></i> contact@culturebenin.bj</li>
                        <li><i class="bi bi-phone me-2"></i> +229 XX XX XX XX</li>
                    </ul>
                </div>
            </div>

            <div class="pt-3 mt-3 border-top border-white border-opacity-10 text-center small">
                &copy; {{ date('Y') }} Culture Bénin — Tous droits réservés
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        function openSearch() {
            document.getElementById('searchOverlay').style.display = 'block';
            const input = document.querySelector('.search-input');
            if (input) input.focus();
        }

        function closeSearch() {
            document.getElementById('searchOverlay').style.display = 'none';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeSearch();
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                openSearch();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
