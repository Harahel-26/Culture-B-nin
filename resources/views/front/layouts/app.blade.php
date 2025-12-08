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
    --primary-dark: #0f2743;
    --secondary: #d4af37;
    --secondary-light: #fceec5;
    --accent: #c53030;
    --light: #f7fafc;
    --dark: #1a202c;
}


        body {
            font-family: "Poppins", sans-serif;
            background-color: var(--light);
            color: var(--dark);
            min-height: 100vh;
        }

        .front-navbar {
    background: rgba(255,255,255,0.8) !important;
    backdrop-filter: blur(10px);
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
            background-color: rgba(197, 48, 48, 0.1);
        }

        .nav-link.active::after {
    content: '';
    display: block;
    height: 3px;
    width: 70%;
    margin: 5px auto 0;
    background: linear-gradient(90deg, var(--secondary), var(--accent));
    border-radius: 4px;
    animation: fadeLine .3s ease forwards;
}

@keyframes fadeLine {
    from { opacity: 0; width: 20%; }
    to { opacity: 1; width: 70%; }
}


        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), #2d5282);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #2d5282, var(--primary));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(26, 54, 93, 0.3);
        }

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

        .main-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 30%, rgba(255,255,255,0.08), transparent 70%);
    animation: pulse 6s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 0.2; }
    50% { opacity: 0.4; }
}


        .main-hero {
            background: linear-gradient(rgba(26, 54, 93, 0.9), rgba(45, 55, 72, 0.9)), url('https://images.unsplash.com/photo-1518621736915-f3b1c41bfd00?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 6rem 0;
            border-radius: 20px;
            margin: 2rem auto;
            position: relative;
            overflow: hidden;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto 2rem;
        }

        .discover-slider {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 3rem auto;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin: 3rem 0 2rem;
            color: var(--primary);
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            border-radius: 2px;
        }

        .culture-slide {
            border-radius: 15px;
            overflow: hidden;
            height: 400px;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .culture-slide:hover {
            transform: scale(1.02);
        }

        .culture-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center;
    transition: transform 1s ease;
        }

        .culture-slide:hover img {
            transform: scale(1.08) translateY(-8px);
        }

        .slide-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(26, 54, 93, 0.9));
            padding: 2rem;
            color: white;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .culture-slide:hover .slide-overlay {
            transform: translateY(0);
        }

        .slide-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .slide-title::after {
    content:'';
    width: 40px;
    height: 2px;
    background: var(--secondary);
    position: absolute;
    bottom:-6px;
    left:0;
}

        .slide-description {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: var(--secondary) !important;
            background: rgba(255, 255, 255, 0.9);
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 1.2rem !important;
            font-weight: bold;
        }

        .swiper-pagination-bullet {
            background: var(--secondary) !important;
            width: 12px !important;
            height: 12px !important;
            opacity: 0.6;
        }

        .swiper-pagination-bullet-active {
            background: var(--accent) !important;
            opacity: 1;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: var(--secondary);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary), #ecc94b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .site-footer {
            background: var(--primary);
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #cbd5e0;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--secondary);
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 3rem;
            text-align: center;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background: var(--secondary);
            transform: translateY(-3px);
        }

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
            transition: opacity .3s ease;
    opacity: 0;
    visibility: hidden;
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
        .search-overlay.active {
    opacity: 1;
    visibility: visible;
}

        .search-input:focus {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 1.2rem 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #38a169, #2f855a);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #e53e3e, #c53030);
            color: white;
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
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 0.7rem 1.5rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--accent);
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

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .culture-slide {
                height: 300px;
            }
            
            .main-hero {
                padding: 4rem 1rem;
            }
        }

        .hero-cta {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-top: 4px solid var(--secondary);
        }

        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--indigo);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .quick-links {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .quick-link-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark);
        }

        .quick-link-item:hover {
            background: rgba(212, 175, 55, 0.1);
            transform: translateX(5px);
        }

        .quick-link-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), #2d5282);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- OVERLAY DE RECHERCHE --}}
    <div id="searchOverlay" class="search-overlay">
        <div class="container">
            <form action="{{ route('front.search') }}" method="GET" class="mb-4 position-relative">
                <input type="text" name="q" class="form-control search-input" placeholder="Rechercher un contenu, un article, une tradition...">
                <button type="submit" class="btn btn-accent position-absolute" style="right: 20px; top: 50%; transform: translateY(-50%);">
                    <i class="bi bi-search"></i> Rechercher
                </button>
            </form>
            
            <div class="text-center">
                <button onclick="closeSearch()" class="btn btn-outline-light rounded-circle" style="width: 50px; height: 50px;">
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
                <img src="{{ asset('images/slides/logo-b.jpg') }}" alt="Logo Culture Bénin" style="height:45px; width:auto; border-radius:8px;">
                <div>
                    <div style="line-height:1.1">Culture Bénin</div>
                    <small style="font-size:0.7rem; color: var(--accent); font-family: Poppins, sans-serif;">Patrimoine • Tradition • Modernité</small>
                </div>
            </a>

            <button class="navbar-toggler border-1" type="button" data-bs-toggle="collapse" data-bs-target="#frontNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="frontNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}" href="{{ route('front.home') }}">
                            <i class="bi bi-house-door me-1"></i> Accueil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.contenus.*') ? 'active' : '' }}" href="{{ route('front.contenus.index') }}">
                            <i class="bi bi-book me-1"></i> Contenus
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.medias.*') ? 'active' : '' }}" href="{{ route('front.medias.index') ?? '#' }}">
                            <i class="bi bi-camera-reels me-1"></i> Médias
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.apropos') ? 'active' : '' }}" href="{{ route('front.apropos') }}">
                            <i class="bi bi-info-circle me-1"></i> À propos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}" href="{{ route('front.contact') }}">
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
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span style="color: var(--dark);">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('front.profil.edit', auth()->user()) }}"><i class="bi bi-person me-2"></i> Mon profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('front.mes.achats') ?? '#' }}"><i class="bi bi-bag-check me-2"></i> Mes achats</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                        @csrf
                                        <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Déconnexion</button>
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

    {{-- HERO SECTION AVEC DIAPORAMA --}}
    @hasSection('hero')
        @yield('hero')
    @else
    <div class="container mt-4">
        <div class="main-hero text-center">
            <h1 class="hero-title">Découvrez la richesse culturelle du Bénin</h1>
            <p class="hero-subtitle">Plongez dans l'univers fascinant des traditions, de l'art et du patrimoine béninois. Une immersion au cœur de l'Afrique authentique.</p>
            <div class="hero-cta">
                <a href="{{ route('front.contenus.index') }}" class="btn btn-primary-custom">
                    <i class="bi bi-compass me-2"></i> Explorer la culture
                </a>
                <a href="#" class="btn btn-accent">
                    <i class="bi bi-play-circle me-2"></i> Découvrir en vidéo
                </a>
            </div>
        </div>

        {{-- DIAPORAMA "DÉCOUVRIR LA RICHESSE CULTURELLE" --}}
        <div class="discover-slider">
            <h2 class="section-title">Découvrir la richesse culturelle</h2>
            
            <div class="swiper discoverSwiper">
                <div class="swiper-wrapper">
                    @php
                        $slides = [
                            [
                                'title' => 'Palais Royaux d\'Abomey',
                                'desc' => 'Patrimoine UNESCO, histoire des royaumes du Dahomey',
                                'image' => 'https://wakabileguide.com/wp-content/uploads/2025/04/4d8ed793138b6c6d31ab46cd45c81e4a-1.webp'
                            ],
                            [
                                'title' => 'Port de Ouidah',
                                'desc' => 'Route des esclaves et syncrétisme culturel',
                                'image' => 'https://th.bing.com/th/id/R.ac15abd3e221bdc9f5dedb871ae6669d?rik=RB%2fX%2fdZbhW3SNQ&riu=http%3a%2f%2f68.media.tumblr.com%2ftumblr_lpm5jw45dp1qclof3o1_1280.jpg&ehk=gAdzMV7WV7lxGXY95KrXdEr3lv4l%2b6KQf%2bhUNOEhsMs%3d&risl=&pid=ImgRaw&r=0'
                            ],
                            [
                                'title' => 'Art Vodun',
                                'desc' => 'Traditions spirituelles et sculptures sacrées',
                                'image' => 'https://cdn.sortiraparis.com/images/80/108276/1115247-exposition-revelation-art-contemporain-du-benin-a-la-conciergerie-a7c3266.jpg'
                            ],
                            [
                                'title' => 'Marchés Traditionnels',
                                'desc' => 'Couleurs, saveurs et artisanat local',
                                'image' => 'https://i.pinimg.com/736x/46/bb/5f/46bb5fb19f60fd6e244d25ad4ea9068c.jpg'
                            ],
                            [
                                'title' => 'Danses Traditionnelles',
                                'desc' => 'Rythmes et mouvements du patrimoine vivant',
                                'image' => 'https://i.f1g.fr/media/cms/704x/2023/01/20/15cf6a161ea9a85fb9446ece4efd054e1d3d091d5e1b4ffb2bf946561604c2d1.jpg'
                            ],
                            [
                                'title' => 'Architecture en Terre',
                                'desc' => 'Tata Somba et habitats traditionnels',
                                'image' => 'https://maison-monde.com/wp-content/uploads/2017/02/histoire-tata-somba-5-1024x683.jpg'
                            ]
                        ];
                    @endphp
                    
                    @foreach($slides as $slide)
                    <div class="swiper-slide">
                        <div class="culture-slide">
                            <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}">
                            <div class="slide-overlay">
                                <h3 class="slide-title">{{ $slide['title'] }}</h3>
                                <p class="slide-description">{{ $slide['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
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

            {{-- SECTION STATISTIQUES --}}
            <div class="row mt-5 g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Contenus Culturels</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">120+</div>
                        <div class="stat-label">Artistes & Artisans</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Traditions Documentées</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Accès en ligne</div>
                    </div>
                </div>
            </div>

            {{-- LIENS RAPIDES --}}
            <div class="quick-links">
                <h3 class="text-center mb-4" style="color: var(--primary);">Accès rapide</h3>
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('front.contenus.index') }}" class="quick-link-item">
                            <div class="quick-link-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0; color: var(--primary);">Encyclopédie Culturelle</h5>
                                <small>Tout savoir sur le Bénin</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('front.medias.index') }}" class="quick-link-item">
                            <div class="quick-link-icon">
                                <i class="bi bi-camera-video"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0; color: var(--primary);">Galerie Médias</h5>
                                <small>Photos et vidéos exclusives</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('front.apropos') }}" class="quick-link-item">
                            <div class="quick-link-icon">
                                <i class="bi bi-info-circle"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0; color: var(--primary);">À Propos</h5>
                                <small>Notre mission et vision</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h3 class="footer-title">Culture Bénin</h3>
                    <p class="text-light" style="opacity: 0.8;">Plateforme numérique dédiée à la préservation et à la promotion du riche patrimoine culturel béninois.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="mb-3" style="color: var(--secondary);">Navigation</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('front.home') }}">Accueil</a></li>
                        <li><a href="{{ route('front.contenus.index') }}">Contenus</a></li>
                        <li><a href="{{ route('front.medias.index') }}">Médias</a></li>
                        <li><a href="{{ route('front.apropos') }}">À propos</a></li>
                        <li><a href="{{ route('front.contact') }}">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3" style="color: var(--secondary);">Ressources</h5>
                    <ul class="footer-links">
                        <li><a href="#">Articles de recherche</a></li>
                        <li><a href="#">Documentaires</a></li>
                        <li><a href="#">Cartes interactives</a></li>
                        <li><a href="#">Calendrier culturel</a></li>
                        <li><a href="#">Publications</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="mb-3" style="color: var(--secondary);">Contact</h5>
                    <ul class="footer-links">
                        <li><i class="bi bi-geo-alt me-2"></i> Porto-Novo, Bénin</li>
                        <li><i class="bi bi-envelope me-2"></i> contact@culturebenin.bj</li>
                        <li><i class="bi bi-phone me-2"></i> +229 XX XX XX XX</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start mb-3 mb-md-0">
                        &copy; {{ date('Y') }} Culture Bénin — Tous droits réservés
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3">Mentions légales</a>
                        <a href="#" class="me-3">Confidentialité</a>
                        <a href="#">Conditions d'utilisation</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        function openSearch() {
    document.getElementById('searchOverlay').classList.add('active');
}
function closeSearch() {
    document.getElementById('searchOverlay').classList.remove('active');
}


        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") closeSearch();
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                openSearch();
            }
        });

        var discoverSwiper = new Swiper(".discoverSwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });

        ScrollReveal().reveal('.culture-slide', {
            delay: 200,
            distance: '30px',
            origin: 'bottom',
            opacity: 0,
            interval: 100,
            duration: 900
        });

        ScrollReveal().reveal('.section-title', {
            delay: 100,
            distance: '20px',
            origin: 'bottom',
            opacity: 0,
            duration: 800
        });

        ScrollReveal().reveal('.stat-card', {
            delay: 300,
            distance: '20px',
            origin: 'bottom',
            opacity: 0,
            interval: 150,
            duration: 800
        });

        ScrollReveal().reveal('.feature-card', {
            delay: 400,
            distance: '30px',
            origin: 'bottom',
            opacity: 0,
            interval: 100,
            duration: 1000
        });
    </script>

    @stack('scripts')
</body>
</html>