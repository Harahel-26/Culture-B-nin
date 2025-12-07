<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Culture Bénin | Plateforme culturelle')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/scrollreveal"></script>

    {{-- Style front personnalisé (à créer ensuite si tu veux) --}}
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">

    <style>
        body {
            font-family: "Inter", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f5f5f8;
        }

        .front-navbar {
            background: #0b1020;
        }

        .front-navbar .navbar-brand,
        .front-navbar .nav-link,
        .front-navbar .dropdown-item {
            color: #f8fafc !important;
        }

        .front-navbar .nav-link.active,
        .front-navbar .nav-link:hover {
            color: #facc15 !important;
        }

        .btn-gold {
            background: #d4a017;
            border-color: #d4a017;
            color: #0b1020;
            font-weight: 600;
        }

        .btn-gold:hover {
            background: #e0b329;
            border-color: #e0b329;
            color: #020617;
        }

        .site-footer {
            background: #020617;
            color: #e5e7eb;
        }

        .site-footer a {
            color: #e5e7eb;
            text-decoration: none;
        }

        .site-footer a:hover {
            color: #facc15;
        }

        .page-header-hero {
            background: radial-gradient(circle at top left, #1d2960, #020617);
            color: #f9fafb;
            padding: 40px 0 30px;
            margin-bottom: 20px;
        }
        .hero-animate {
    animation: zoomHero 18s infinite alternate ease-in-out;
}

@keyframes zoomHero {
    0% { transform: scale(1); }
    100% { transform: scale(1.12); }
}

    </style>

    @stack('styles')
</head>

<body>
            {{-- OVERLAY DE RECHERCHE PREMIUM --}}
<div id="searchOverlay"
     style="
        display:none;
        position:fixed;
        top:0; left:0; width:100%; height:100%;
        background:rgba(0,0,0,0.86);
        backdrop-filter: blur(4px);
        z-index:9999;
        padding-top:120px;
        text-align:center;
     ">

    <div class="container">

        {{-- Champ de recherche --}}
        <form action="{{ route('front.search') }}" method="GET" class="mb-4">
            <input type="text" name="q" class="form-control form-control-lg"
                   placeholder="Rechercher un contenu..."
                   style="
                        max-width:650px;
                        margin:auto;
                        border-radius:12px;
                        padding:20px;
                        font-size:1.3rem;
                   ">
        </form>

        {{-- Bouton fermer --}}
        <button onclick="closeSearch()"
                class="btn btn-light"
                style="border-radius:50%; width:50px; height:50px;">
            <i class="bi bi-x-lg"></i>
        </button>

    </div>

</div>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg front-navbar shadow-sm">
        <div class="container">

            {{-- Logo / titre du site --}}
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="{{ asset('images/slides/logo-b.jpg') }}" alt="Logo" style="height:32px; width:auto;">
                <span class="fw-bold">Culture Bénin</span>
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#frontNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="frontNavbar">

                {{-- Liens de gauche --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.home') ? 'active' : '' }}"
                           href="{{ route('front.home') }}">
                            Accueil
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.contenus.*') ? 'active' : '' }}"
                           href="{{ route('front.contenus.index') }}">
                            Contenus
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.medias.*') ? 'active' : '' }}"
                           href="{{ route('front.medias.index') ?? '#' }}">
                            Médias
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.apropos') ? 'active' : '' }}"
                           href="{{ route('front.apropos') }}">
                            À propos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}"
                           href="{{ route('front.contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>

                {{-- Espace utilisateur --}}
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                       <a href="#" class="nav-link text-white fs-5" onclick="openSearch()">
                           <i class="bi bi-search"></i>
                        </a>
                    </li>


                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                               href="#" role="button" data-bs-toggle="dropdown">

                                <i class="bi bi-person-circle fs-5"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('front.profil.edit', auth()->user()) }}">
                                        <i class="bi bi-person"></i> Mon profil
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('front.mes.achats') ?? '#' }}">
                                        <i class="bi bi-bag-check"></i> Mes achats
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="bi bi-box-arrow-in-right"></i> Connexion
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-gold btn-sm">
                                <i class="bi bi-person-plus"></i> Inscription
                            </a>
                        </li>
                    @endauth

                </ul>


            </div>
        </div>
    </nav>

    {{-- BANNIÈRE / TITRE DE PAGE OPTIONNEL --}}
    @hasSection('hero')
        @yield('hero')
    @endif

    {{-- CONTENU PRINCIPAL --}}
    <main class="min-vh-100">
        <div class="container py-4">

            {{-- messages flash --}}
            @if(session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="site-footer mt-auto py-4">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-6 mb-3 mb-md-0">
                <div class="d-flex flex-column">
                    <span class="fw-semibold">Culture Bénin</span>
                    <small class="text-muted">
                        &copy; {{ date('Y') }} – Plateforme culturelle numérique. Tous droits réservés.
                    </small>
                </div>
            </div>

            <div class="col-md-6 text-md-end">
                <small>
                    <a href="{{ route('front.apropos') }}">À propos</a> ·
                    <a href="{{ route('front.contact') }}">Contact</a> ·
                    <a href="#">Mentions légales</a> ·
                    <a href="#">Confidentialité</a>
                </small>
            </div>

        </div>
    </div>
</footer>


    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
    <script>
function openSearch() {
    document.getElementById('searchOverlay').style.display = 'block';
}

function closeSearch() {
    document.getElementById('searchOverlay').style.display = 'none';
}
document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") closeSearch();
});

</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1.2,
    spaceBetween: 10,
    centeredSlides: false,
    grabCursor: true,
    breakpoints: {
        540: { slidesPerView: 2.2 },
        768: { slidesPerView: 3 },
        1200: { slidesPerView: 4 },
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});
</script>
<script>
ScrollReveal().reveal('.home-section-title', {
    delay: 100,
    distance: '20px',
    origin: 'bottom',
    opacity: 0,
    duration: 800
});

ScrollReveal().reveal('.contenu-card', {
    delay: 200,
    distance: '30px',
    origin: 'bottom',
    opacity: 0,
    interval: 100,
    duration: 900
});
</script>

</body>
</html>
