<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - Découvrez la richesse culturelle</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }

        .search-box {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .category-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .stat-card {
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .badge-custom {
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .explore-card {
            height: 100%;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .explore-card:hover {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-color: #667eea;
        }

        footer {
            background: #2c3e50;
            color: white;
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <!-- Navigation (à adapter selon ton layout) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('front.accueil') }}">
                <i class="bi bi-globe-americas me-2"></i>Culture Bénin
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('front.accueil') }}">
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
                            @foreach($langues->take(8) as $langue)
                            <li>
                                <a class="dropdown-item" href="{{ route('front.contenus.langue', $langue->code) }}">
                                    {{ $langue->nom }}
                                </a>
                            </li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('front.contenus.index') }}">
                                    Voir toutes les langues
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <!-- Barre de recherche dans la navbar -->
                <form action="{{ route('front.search') }}" method="GET" class="d-flex mx-3">
                    <div class="input-group">
                        <input type="text"
                               name="q"
                               class="form-control"
                               placeholder="Rechercher..."
                               aria-label="Recherche"
                               style="width: 250px;">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <!-- User menu -->
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
                                <a class="dropdown-item" href="{{ route('admin.dashboards.index') }}">
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

    <!-- Hero Section avec recherche -->
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">
                        Découvrez la richesse culturelle du Bénin
                    </h1>
                    <p class="lead mb-4">
                        Explorez les contes, musiques, traditions et patrimoines des différentes régions et langues du Bénin.
                    </p>

                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @foreach($suggestions as $suggestion)
                        <a href="{{ route('front.search') }}?q={{ urlencode($suggestion) }}"
                           class="btn btn-light rounded-pill">
                            #{{ $suggestion }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6">
                    <!-- Grande barre de recherche -->
                    <div class="search-box">
                        <div class="card shadow-lg">
                            <div class="card-body p-4">
                                <h3 class="text-center mb-4">
                                    <i class="bi bi-search-heart"></i> Que souhaitez-vous découvrir ?
                                </h3>

                                <form action="{{ route('front.search') }}" method="GET" class="row g-3">
                                    <div class="col-md-8">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text bg-primary text-white">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input type="text"
                                                   name="q"
                                                   class="form-control"
                                                   placeholder="Ex: contes fon, musique yoruba, traditions..."
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="bi bi-search"></i> Explorer
                                        </button>
                                    </div>

                                    <!-- Filtres rapides -->
                                    <div class="col-12">
                                        <div class="d-flex flex-wrap gap-2 mt-3">
                                            <small class="text-muted me-2">Filtrer par :</small>
                                            @foreach($langues->take(4) as $langue)
                                            <a href="{{ route('front.contenus.langue', $langue->code) }}"
                                               class="badge bg-info text-decoration-none">
                                                <i class="bi bi-translate"></i> {{ $langue->nom }}
                                            </a>
                                            @endforeach

                                            @foreach($regions->take(4) as $region)
                                            <a href="{{ route('front.contenus.region', $region->slug) }}"
                                               class="badge bg-secondary text-decoration-none">
                                                <i class="bi bi-geo-alt"></i> {{ $region->nom }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card bg-primary text-white">
                        <i class="bi bi-book display-4 mb-3"></i>
                        <h3>{{ $stats['total_contenus'] }}</h3>
                        <p class="mb-0">Contenus culturels</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-success text-white">
                        <i class="bi bi-translate display-4 mb-3"></i>
                        <h3>{{ $stats['total_langues'] }}</h3>
                        <p class="mb-0">Langues disponibles</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-warning text-dark">
                        <i class="bi bi-geo-alt display-4 mb-3"></i>
                        <h3>{{ $stats['total_regions'] }}</h3>
                        <p class="mb-0">Régions couvertes</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Derniers contenus -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h2 class="fw-bold">
                    <i class="bi bi-clock-history text-primary me-2"></i>Derniers contenus
                </h2>
                <a href="{{ route('front.contenus.index') }}" class="btn btn-outline-primary">
                    Voir tous <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            @if($derniersContenus->count() > 0)
            <div class="row g-4">
                @foreach($derniersContenus as $contenu)
                <div class="col-md-3">
                    <div class="card h-100">
                        @if($contenu->image_couverture)
                        <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                             class="card-img-top"
                             alt="{{ $contenu->titre }}">
                        @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 150px;">
                            <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                        </div>
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($contenu->titre, 50) }}</h5>
                            <p class="card-text text-muted small">
                                <i class="bi bi-person"></i> {{ $contenu->utilisateur->name ?? 'Auteur' }}
                            </p>
                            <p class="card-text">
                                {{ Str::limit($contenu->description, 80) }}
                            </p>

                            <div class="d-flex flex-wrap gap-1 mb-3">
                                @if($contenu->langue)
                                <span class="badge bg-info badge-custom">
                                    {{ $contenu->langue->nom }}
                                </span>
                                @endif
                                @if($contenu->region)
                                <span class="badge bg-secondary badge-custom">
                                    {{ $contenu->region->nom }}
                                </span>
                                @endif
                                @if($contenu->is_premium)
                                <span class="badge bg-warning badge-custom">
                                    <i class="bi bi-star-fill"></i> Premium
                                </span>
                                @endif
                            </div>

                            <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                               class="btn btn-primary btn-sm w-100">
                                <i class="bi bi-eye"></i> Consulter
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted"></i>
                <h4 class="mt-3">Aucun contenu disponible</h4>
                <p class="text-muted">Les premiers contenus seront bientôt publiés.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Explorez par catégorie -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">
                <i class="bi bi-compass text-primary me-2"></i>Explorez par catégorie
            </h2>

            <div class="row g-4">
                @php
                    $categories = [
    ['icon' => 'bi-book', 'title' => 'Contes', 'desc' => 'Histoires et légendes', 'color' => 'primary', 'route' => 'front.search', 'query' => 'contes'],
    ['icon' => 'bi-music-note-beamed', 'title' => 'Musique', 'desc' => 'Rythmes et mélodies', 'color' => 'success', 'route' => 'front.search', 'query' => 'musique'],
    ['icon' => 'bi-camera-reels', 'title' => 'Vidéos', 'desc' => 'Documentaires et films', 'color' => 'danger', 'route' => 'front.search', 'query' => 'video'],
    ['icon' => 'bi-mic', 'title' => 'Audio', 'desc' => 'Podcasts et enregistrements', 'color' => 'warning', 'route' => 'front.search', 'query' => 'audio'],
    ['icon' => 'bi-images', 'title' => 'Photos', 'desc' => 'Galeries d\'images', 'color' => 'info', 'route' => 'front.search', 'query' => 'image'],
    ['icon' => 'bi-people', 'title' => 'Communauté', 'desc' => 'Contributeurs', 'color' => 'dark', 'route' => 'front.contenus.index', 'query' => ''],
];
                @endphp

                @foreach($categories as $categorie)
                <div class="col-md-4 col-lg-2">
                    @if($categorie['route'] == 'front.search')
                    <a href="{{ route($categorie['route']) }}?q={{ $categorie['query'] }}"
                       class="explore-card text-decoration-none">
                    @else
                    <a href="{{ route($categorie['route']) }}"
                       class="explore-card text-decoration-none">
                    @endif
                        <div class="mb-3">
                            <i class="bi {{ $categorie['icon'] }} display-4 text-{{ $categorie['color'] }}"></i>
                        </div>
                        <h5 class="fw-bold">{{ $categorie['title'] }}</h5>
                        <p class="text-muted small mb-0">{{ $categorie['desc'] }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contenus populaires -->
    @if($contenusPopulaires->count() > 0)
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-5">
                <i class="bi bi-fire text-danger me-2"></i>Contenus populaires
            </h2>

            <div class="row g-4">
                @foreach($contenusPopulaires as $contenu)
                <div class="col-md-6">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if($contenu->image_couverture)
                                <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                                     class="img-fluid rounded-start h-100"
                                     alt="{{ $contenu->titre }}"
                                     style="object-fit: cover;">
                                @else
                                <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-white" style="font-size: 2rem;"></i>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $contenu->titre }}</h5>
                                    <p class="card-text text-muted small">
                                        <i class="bi bi-eye"></i> {{ $contenu->vues_total ?? 0 }} vues
                                    </p>
                                    <p class="card-text">
                                        {{ Str::limit($contenu->description, 100) }}
                                    </p>
                                    <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                                       class="btn btn-outline-primary btn-sm">
                                        Lire la suite
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Footer -->
    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="text-white mb-4">
                        <i class="bi bi-globe-americas me-2"></i>Culture Bénin
                    </h5>
                    <p class="text-light">
                        Plateforme de promotion et de préservation de la culture béninoise à travers ses langues, ses régions et ses traditions.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="text-white mb-4">Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="{{ route('front.accueil') }}" class="text-light text-decoration-none">
                                <i class="bi bi-house me-1"></i> Accueil
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('front.contenus.index') }}" class="text-light text-decoration-none">
                                <i class="bi bi-book me-1"></i> Contenus
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('front.search') }}" class="text-light text-decoration-none">
                                <i class="bi bi-search me-1"></i> Recherche
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white mb-4">Langues populaires</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($langues->take(6) as $langue)
                        <a href="{{ route('front.contenus.langue', $langue->code) }}"
                           class="badge bg-light text-dark text-decoration-none">
                            {{ $langue->nom }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="text-white mb-4">Contact</h5>
                    <p class="text-light mb-2">
                        <i class="bi bi-envelope me-2"></i> contact@culturebenin.bj
                    </p>
                    <div class="mt-4">
                        <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center pt-3">
                <p class="text-light mb-0">
                    &copy; {{ date('Y') }} Culture Bénin. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fix pour la navbar fixed
        document.addEventListener('DOMContentLoaded', function() {
            const navbarHeight = document.querySelector('.navbar').offsetHeight;
            document.body.style.paddingTop = navbarHeight + 'px';
        });

        // Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observer les cartes
        document.querySelectorAll('.card, .explore-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>
