<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Culture Bénin | Plateforme culturelle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Découvrez la richesse culturelle du Bénin : patrimoine, art, histoire, traditions et modernité.">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('images/slides/logo-b.jpg') }}">

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Swiper & Icons & Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>

    {{-- Style personnalisé (pour les styles qui ne sont PAS dans <style>) --}}
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <style>
        /* 1. PALETTE DE COULEURS UNIFIÉE */
        :root {
            --primary: #1E2B4D; /* Bleu Marine Profond */
            --secondary: #E8C676; /* Or Vibrant / Accent de Richesse */
            --accent: #A52A2A; /* Rouge Carmin / Terre Cuite (Boutons CTA) */
            --light: #f7fafc; /* Fond très clair */
            --dark: #16161D; /* Texte */
            --dark-footer: #0f172a; /* Bleu très foncé pour le footer */
            --indigo: #2d3748;
        }

        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
        }

        /* 2. DIAPORAMA D'IMAGES EN ARRIÈRE-PLAN (Background Slideshow) */
        .background-slideshow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            overflow: hidden;
        }

        .slide-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .background-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 2s ease-in-out;
            will-change: opacity; /* Optimisation de l'animation */
        }

        .background-slide.active {
            opacity: 0.15; /* Très subtil et élégant */
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Gradient pour forcer le blanc/lisibilité sur le fond */
            background: linear-gradient(135deg, rgba(247, 250, 252, 0.95) 0%, rgba(247, 250, 252, 0.85) 100%);
            z-index: -1;
        }

        /* 3. CONTENU PRINCIPAL EN LISIBILITÉ MAXIMALE */
        main {
            /* Retrait du fond semi-transparent de la <main> pour ne pas créer un double effet de flou */
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 auto !important;
        }

        /* La DIV du contenu prendra le background si nécessaire, mais le <main> lui-même reste transparent. */
        .main-content-wrapper {
            background: rgba(247, 250, 252, 0.95); /* Arrière-plan des blocs de contenu */
            border-radius: 20px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 8px 32px rgba(30, 43, 77, 0.1);
            backdrop-filter: blur(5px);
        }

        /* 4. NAVBAR & Liens */
        .front-navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0;
            border-bottom: 2px solid var(--secondary);
        }

        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary) !important;
        }

        .brand-slogan {
            font-size: 0.7rem;
            color: var(--accent);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent) !important;
            background-color: rgba(165, 42, 42, 0.05);
            font-weight: 600;
        }

        /* 5. BOUTONS */
        .btn-accent {
            background: linear-gradient(135deg, var(--accent), #e53e3e);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.7rem 2rem;
            border-radius: 999px;
            transition: all 0.3s ease;
            overflow: hidden; /* Important pour l'effet de survol */
        }
        .btn-accent:hover {
            background: linear-gradient(135deg, #e53e3e, var(--accent));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(165, 42, 42, 0.3);
        }

        /* 6. HERO STANDARD */
        .page-header-hero {
            background: radial-gradient(circle at top left, #1E2B4D, #020617);
            color: #f9fafb;
            padding: 50px 0 40px;
            margin-bottom: 30px;
            position: relative;
            border-bottom-left-radius: 25px;
            border-bottom-right-radius: 25px;
            overflow: hidden;
        }

        /* 7. CARTES DE CONTENU (Unifié) */
        .contenu-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all .3s cubic-bezier(0.25, 0.8, 0.25, 1);
            height: 100%;
        }
        .contenu-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: 1px solid rgba(232, 198, 118, 0.5);
        }

        .contenu-cover {
            width: 100%;
            height: 170px; /* Taille réduite pour plus d'espace de texte */
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .contenu-card:hover .contenu-cover {
            transform: scale(1.03); /* Zoom plus subtil */
        }

        .badge-premium {
            background: var(--secondary);
            color: var(--primary);
            padding: 4px 8px;
            border-radius: 5px;
            font-size: .75rem;
        }

        /* 8. OVERLAY DE RECHERCHE (Ajusté) */
        .search-overlay {
            background: rgba(30, 43, 77, 0.98);
            backdrop-filter: blur(10px);
            padding-top: 25vh;
            display: none; /* Cache par défaut */
            z-index: 9999;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
        }

        .search-input {
            max-width: 800px;
            margin: 0 auto;
            border-radius: 50px;
            padding: 1.5rem 2.5rem;
            font-size: 1.4rem;
            border: 3px solid var(--secondary);
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        /* 9. FOOTER (Unifié) */
        .site-footer {
            background: linear-gradient(135deg, var(--dark-footer), var(--primary)); /* Utilise le dark-footer */
            color: white;
            padding: 4rem 0 2.5rem;
            margin-top: 5rem;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            position: relative;
        }

        .site-footer h3, .site-footer h6 {
            color: var(--secondary) !important;
            font-weight: 700;
        }

        .footer-links a {
            color: #e2e8f0;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--secondary);
            transform: translateX(3px);
        }

        /* 10. STYLES POUR LES MENUS DÉROULANTS AMÉLIORÉS */
        .dropdown-menu {
            border: none !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
            padding: 12px !important;
            animation: fadeInUp 0.3s ease !important;
            min-width: 260px;
        }

        .dropdown-item {
            border-radius: 8px !important;
            padding: 10px 15px !important;
            margin: 3px 0 !important;
            transition: all 0.3s ease !important;
        }

        .dropdown-item:hover {
            background-color: rgba(30, 43, 77, 0.08) !important;
            transform: translateX(3px) !important;
        }

        /* Style pour l'avatar utilisateur */
        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }

        /* Style pour le bouton de recherche */
        .nav-search-btn {
            background: none;
            border: none;
            color: var(--dark);
            font-size: 1.2rem;
            padding: 8px 12px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .nav-search-btn:hover {
            background-color: rgba(30, 43, 77, 0.05);
            color: var(--primary);
        }

        /* Style pour les badges de rôle */
        .role-badge {
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 50px;
            font-weight: 600;
        }

        .badge-contributeur {
            background: rgba(232, 198, 118, 0.2);
            color: var(--secondary);
            border: 1px solid rgba(232, 198, 118, 0.3);
        }

        .badge-moderateur {
            background: rgba(67, 97, 238, 0.15);
            color: #4361ee;
            border: 1px solid rgba(67, 97, 238, 0.3);
        }

        .badge-admin {
            background: rgba(247, 37, 133, 0.15);
            color: #d425f7;
            border: 1px solid rgba(247, 37, 133, 0.3);
        }

        /* Style pour les espaces spécifiques */
        .espace-contributeur {
            background: linear-gradient(135deg, var(--secondary), #E8A735) !important;
            color: white !important;
        }

        .espace-moderateur {
            background: linear-gradient(135deg, #4361ee, #3a0ca3) !important;
            color: white !important;
        }

        .espace-admin {
            background: linear-gradient(135deg, #f025f7, #b5179e) !important;
            color: white !important;
        }

        /* Animation pour le dropdown */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 11. RESPONSIVE */
        @media (max-width: 991px) {
            .search-input {
                padding: 1.2rem 1.5rem;
                font-size: 1.2rem;
            }
            .search-overlay .btn-accent {
                display: none; /* Cache le bouton de recherche sur mobile pour plus de clarté */
            }

            .main-content-wrapper {
        margin: 10px;
        padding: 15px;
    }
        }

        /* Styles pour les icônes sociales dans le footer */
.social-icons {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.social-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-icon:hover {
    background: var(--secondary);
    color: var(--primary);
    transform: translateY(-3px);
}
    </style>

    @stack('styles')
</head>

<body>

    {{-- DIA PORAMA D'IMAGES EN ARRIÈRE-PLAN --}}
    <div class="background-slideshow">
        <div class="slide-container">
            {{-- VÉRIFIEZ ET REMPLACEZ VOS CHEMINS D'IMAGES CI-DESSOUS --}}
            <div class="background-slide active"
                 style="background-image: url('{{ asset('images/slides/benin1.jpg') }}');"></div>
            <div class="background-slide"
                 style="background-image: url('{{ asset('images/slides/benin2.jpg') }}');"></div>
            <div class="background-slide"
                 style="background-image: url('{{ asset('images/slides/benin3.jpg') }}');"></div>
            <div class="background-slide"
                 style="background-image: url('{{ asset('images/slides/benin4.jpg') }}');"></div>
            <div class="background-slide"
                 style="background-image: url('{{ asset('images/slides/benin5.jpg') }}');"></div>
        </div>
    </div>

    {{-- Overlay pour assurer la lisibilité du contenu principal --}}
    <div class="overlay"></div>

    {{-- OVERLAY DE RECHERCHE --}}
    <div id="searchOverlay" class="search-overlay">
        <div class="container">
            <form action="{{ route('front.search') }}" method="GET" class="mb-4 position-relative d-flex justify-content-center">
                <input type="text" name="q" class="form-control search-input"
                       placeholder="🔍 Rechercher un contenu, un article, une tradition..." autocomplete="off">
                <button type="submit"
                        class="btn btn-accent d-none d-md-block position-absolute"
                        style="right: 5px; top: 50%; transform: translateY(-50%); padding: 0.5rem 1.5rem;">
                    <i class="bi bi-search me-1"></i> Rechercher
                </button>
            </form>

            <div class="text-center mt-5">
                <button onclick="closeSearch()"
                        class="btn btn-outline-light rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width: 55px; height: 55px; font-size: 1.2rem;">
                    <i class="bi bi-x-lg"></i>
                </button>
                <p class="text-light mt-3" style="opacity: 0.8;">Appuyez sur Échap pour fermer</p>
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
                    <small class="brand-slogan">
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
                        <button class="nav-search-btn" onclick="openSearch()" title="Recherche (Ctrl+K)">
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
                                <div class="d-flex flex-column">
                                    <span style="color: var(--dark); font-weight: 500; font-size: 0.95rem;">{{ Auth::user()->name }}</span>
                                    @if(auth()->user()->hasRole('contributeur'))
                                        <small class="role-badge badge-contributeur">Contributeur</small>
                                    @elseif(auth()->user()->hasRole('moderateur'))
                                        <small class="role-badge badge-moderateur">Modérateur</small>
                                    @elseif(auth()->user()->hasRole('admin'))
                                        <small class="role-badge badge-admin">Administrateur</small>
                                    @endif
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                {{-- Profil utilisateur --}}
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('front.profil.edit', auth()->user()) }}">
                                         <i class="bi bi-person me-2" style="color: var(--primary);"></i>
                                         <span>Mon profil</span>
                                    </a>
                                </li>

                                {{-- Achats --}}
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('front.achats.index') ?? '#' }}">
                                        <i class="bi bi-bag-check me-2" style="color: var(--accent);"></i>
                                        <span>Mes achats</span>
                                    </a>
                                </li>

                                {{-- ESPACE CONTRIBUTEUR --}}
                                @if(auth()->user()->hasRole('contributeur'))
                                   <li class="dropdown-divider my-2"></li>
                                   <li>
                                        <a class="dropdown-item d-flex align-items-center espace-contributeur"
                                           href="{{ route('contributeur.dashboard') }}"
                                           style="border-radius: 8px; margin: 4px;">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">Mon espace contributeur</span>
                                                <small class="opacity-90">Gérer mes contenus</small>
                                            </div>
                                            <span class="ms-auto badge bg-white text-dark">→</span>
                                        </a>
                                   </li>
                                @endif

                                {{-- ESPACE MODÉRATEUR --}}
                                @if(auth()->user()->hasRole('moderateur'))
                                   <li class="dropdown-divider my-2"></li>
                                   <li>
                                        <a class="dropdown-item d-flex align-items-center espace-moderateur"
                                           href="{{ route('moderateur.dashboard') }}"
                                           style="border-radius: 8px; margin: 4px;">
                                            <i class="bi bi-shield-check me-2"></i>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">Espace modérateur</span>
                                                <small class="opacity-90">Modérer les contenus</small>
                                            </div>
                                            <span class="ms-auto badge bg-white text-dark">→</span>
                                        </a>
                                   </li>
                                @endif

                                {{-- ESPACE ADMINISTRATEUR --}}
                                @if(auth()->user()->hasRole('admin'))
                                   <li class="dropdown-divider my-2"></li>
                                   <li>
                                        <a class="dropdown-item d-flex align-items-center espace-admin"
                                           href="{{ route('admin.dashboards.index') }}"
                                           style="border-radius: 8px; margin: 4px;">
                                            <i class="bi bi-gear-fill me-2"></i>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold">Administration</span>
                                                <small class="opacity-90">Gestion complète</small>
                                            </div>
                                            <span class="ms-auto badge bg-white text-dark">→</span>
                                        </a>
                                   </li>
                                @endif

                                {{-- DEVENIR CONTRIBUTEUR (pour les lecteurs) --}}
                                @if(auth()->user()->hasRole('lecteur'))
                                   <li class="dropdown-divider my-2"></li>
                                   <li>
                                        <a class="dropdown-item d-flex align-items-center"
                                           href="{{ route('front.contributeur.demande') }}">
                                            <i class="bi bi-upload me-2" style="color: var(--secondary);"></i>
                                            <div class="d-flex flex-column">
                                                <span>Devenir contributeur</span>
                                                <small class="text-muted">Partagez vos connaissances</small>
                                            </div>
                                        </a>
                                   </li>
                                @endif

                                {{-- Séparateur avant déconnexion --}}
                                <li><hr class="dropdown-divider my-2"></li>

                                {{-- Déconnexion --}}
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        <button class="dropdown-item d-flex align-items-center text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>
                                            <span>Déconnexion</span>
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
        {{-- Wrapper pour le contenu, utilise la classe .main-content-wrapper pour l'effet de transparence/flou --}}
        <div class="container py-4 main-content-wrapper fade-in">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                    <div class="flex-grow-1">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h3 class="mb-4" style="font-family:'Playfair Display',serif; font-size: 2rem;">
                        Culture Bénin
                    </h3>
                    <p class="text-light" style="opacity: 0.9; line-height: 1.8;">
                        Portail numérique dédié à la valorisation du riche patrimoine culturel, historique et artistique du Bénin. Un pont entre tradition et modernité.
                    </p>
                    <div class="social-icons">
                        <a href="#" class="social-icon" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon" title="YouTube"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="social-icon" title="Twitter"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="mb-4">Navigation</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('front.home') }}">Accueil</a></li>
                        <li><a href="{{ route('front.contenus.index') }}">Contenus</a></li>
                        <li><a href="{{ route('front.medias.index') }}">Médias</a></li>
                        <li><a href="{{ route('front.apropos') }}">À propos</a></li>
                        <li><a href="{{ route('front.contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="mb-4">Ressources</h6>
                    <ul class="footer-links">
                        <li><a href="#">Articles de recherche</a></li>
                        <li><a href="#">Documentaires</a></li>
                        <li><a href="#">Cartes interactives</a></li>
                        <li><a href="#">Calendrier culturel</a></li>
                        <li><a href="#">Publications</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="mb-4">Contact</h6>
                    <ul class="footer-links">
                        <li class="d-flex align-items-start mb-3">
                            <i class="bi bi-geo-alt me-3 mt-1" style="color: var(--secondary);"></i>
                            <span>Porto-Novo, Bénin<br><small style="opacity:0.8;">Siège principal</small></span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bi bi-envelope me-3" style="color: var(--secondary);"></i>
                            contact@culturebenin.bj
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-phone me-3" style="color: var(--secondary);"></i>
                            +229 XX XX XX XX
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-4 mt-5 border-top border-white border-opacity-10 text-center">
                <p class="mb-0" style="opacity: 0.8;">
                    &copy; {{ date('Y') }} Culture Bénin — Tous droits réservés |
                    <a href="#" class="text-white-50" style="text-decoration:underline;">Mentions légales</a> |
                    <a href="#" class="text-white-50" style="text-decoration:underline;">Politique de confidentialité</a>
                </p>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    // 1. Gestion du Diaporama d'Arrière-plan
    function initBackgroundSlideshow() {
        const slides = document.querySelectorAll('.background-slide');
        let currentSlide = 0;

        if (slides.length <= 1) return;

        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 6000); // Change d'image toutes les 6 secondes
    }

    // 2. Gestion de la Recherche (Overlay)
    const searchOverlay = document.getElementById('searchOverlay');

    function openSearch() {
        searchOverlay.style.display = 'block';
        document.body.style.overflow = 'hidden'; // Empêche le scroll derrière
        setTimeout(() => {
            searchOverlay.querySelector('.search-input').focus();
        }, 100);
    }

    function closeSearch() {
        searchOverlay.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Raccourci clavier (Ctrl + K pour rechercher)
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearch();
        }
        if (e.key === 'Escape') {
            closeSearch();
        }
    });

    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        initBackgroundSlideshow();

        // Animation ScrollReveal (optionnel car tu as le script en haut)
        if (typeof ScrollReveal !== 'undefined') {
            ScrollReveal().reveal('.fade-in', {
                delay: 200,
                distance: '20px',
                origin: 'bottom',
                duration: 800
            });
        }
    });
</script>

    @stack('scripts')
</body>
</html>
