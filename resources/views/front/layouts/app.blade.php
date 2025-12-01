<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Culture du Bénin')</title>

    <title>Culture du Bénin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --beige-light: #f8f5f0;
            --beige-medium: #e8e1d5;
            --beige-dark: #d4c9b8;
            --accent-brown: #8b7355;
            --accent-dark: #5d4c35;
            --text-dark: #333333;
            --text-light: #6c757d;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--beige-light);
            margin: 0;
            padding: 0;
            color: var(--text-dark);
            padding-top: 80px;
        }

        /* NAVBAR */
        .navbar-custom {
            background: rgba(248, 245, 240, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            border-bottom: 1px solid rgba(139, 115, 85, 0.1);
        }
        /* Styles supplémentaires pour la section villes */
.card-custom .card-body small {
    color: var(--text-light);
    font-size: 0.85rem;
}

.bg-primary {
    background: linear-gradient(135deg, var(--accent-brown) 0%, var(--accent-dark) 100%) !important;
}

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: var(--accent-dark) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: var(--accent-brown) !important;
            transform: translateY(-2px);
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--accent-dark) !important;
        }
        /* Ajouter dans la section CSS */
.btn-search {
    border-radius: 30px;
    background: linear-gradient(135deg, var(--accent-brown) 0%, var(--accent-dark) 100%);
    color: white;
    font-weight: 600;
    padding: 0.8rem 2rem;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-search:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(139, 115, 85, 0.4);
    color: white;
}

        /* HERO SLIDER */
        .hero-slider {
            position: relative;
            height: 80vh;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
        }

        .slide.active {
            opacity: 1;
        }

        .slide::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(139, 115, 85, 0.4) 0%, rgba(93, 76, 53, 0.7) 100%);
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
            color: white;
            width: 80%;
            max-width: 900px;
        }

        .hero-content h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
        }

        .hero-content p {
            font-size: 1.4rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            line-height: 1.6;
        }

        /* CONTENT SECTIONS */
        .content-section {
            padding: 5rem 0;
        }

        .alternate-bg {
            background: linear-gradient(135deg, var(--beige-medium) 0%, var(--beige-light) 100%);
        }

        .section-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            height: 400px;
            object-fit: cover;
        }

        .section-content {
            padding: 2rem;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            color: var(--accent-dark);
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-brown) 0%, var(--beige-dark) 100%);
            border-radius: 2px;
        }

        .section-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        /* CARDS */
        .card-custom {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.4s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            height: 100%;
            border: 1px solid rgba(139, 115, 85, 0.1);
        }

        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-custom img {
            height: 250px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s ease;
        }

        .card-custom:hover img {
            transform: scale(1.08);
        }

        .card-custom .card-body {
            padding: 2rem;
        }

        .card-custom h5 {
            color: var(--accent-dark);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .card-custom p {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-light);
        }

        .badge-custom {
            background: linear-gradient(135deg, var(--accent-brown) 0%, var(--accent-dark) 100%);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            font-size: 0.9rem;
        }

        /* STATS SECTION */
        .stats-box {
            background: linear-gradient(135deg, rgba(139, 115, 85, 0.9) 0%, rgba(93, 76, 53, 0.9) 100%);
            color: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease;
        }

        .stats-box:hover {
            transform: translateY(-8px);
        }

        .stats-box h3 {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .stats-box p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* FOOTER */
        .footer {
            background: linear-gradient(135deg, var(--accent-dark) 0%, var(--text-dark) 100%);
            color: white;
            padding: 4rem 0 2rem;
            margin-top: 5rem;
        }

        .footer a {
            color: var(--beige-medium);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            color: white;
            text-decoration: underline;
        }

        .footer-links {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        /* SLIDER CONTROLS */
        .slider-controls {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            display: flex;
            gap: 12px;
        }

        .slider-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: white;
            transform: scale(1.3);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .content-section {
                padding: 3rem 0;
            }
        }
    </style>
        @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://png.pngtree.com/png-clipart/20230810/original/pngtree-vector-illustration-of-benin-flag-against-a-white-background-vector-picture-image_10225034.png" height="60" class="me-2">
                 Bénin Culture
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" style="border: 1px solid var(--accent-brown);">
                <i class="bi bi-list" style="color: var(--accent-brown);"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.accueil') }}"><i class="bi bi-book"></i> Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.contenus.index') }}"><i class="bi bi-brush me-1"></i>Contenus</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.medias.index') }}"><i class="bi bi-image-fill"></i> Médias</a>
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

    <!-- HERO SECTION DYNAMIQUE -->
    @hasSection('hero')
        <div class="hero-slider">
            @yield('hero')
        </div>
    @else
        <!-- Slide 1 - Fresques -->
        <div class="slide active" style="background-image: url('https://waafrica.travel/wp-content/uploads/2025/06/benin_fresque_mural-1-1024x628.jpg')"></div>

        <!-- Slide 2 - Art urbain -->
        <div class="slide" style="background-image: url('https://tse1.mm.bing.net/th/id/OIP.4bpO6XkwEy5UDdOdyKLCpQHaE8?pid=ImgDet&w=474&h=316&rs=1&o=7&rm=3')"></div>

        <!-- Slide 3 - Culture -->
        <div class="slide" style="background-image: url('https://th.bing.com/th/id/OIP.ZRrGwGrmo277pVC5WYhsowHaEK?w=321&h=180&c=7&r=0&o=7&pid=1.7&rm=3')"></div>

        <!-- Slide 4 - Patrimoine -->
        <div class="slide" style="background-image: url('https://th.bing.com/th/id/OIP.ff4QqskvP40Nqw4B_pAZbQHaFW?w=225&h=180&c=7&r=0&o=7&pid=1.7&rm=3')"></div>

        <div class="hero-content">
            <h1>Patrimoine Culturel du Bénin</h1>
            <p class="lead">Découvrez la renaissance artistique à travers les arts qui racontent l'histoire, les traditions et la diversité culturelle du Bénin</p>
            <a href="{{ route('front.medias.index') }}" class="btn btn-lg" style="background: var(--accent-brown); color: white; padding: 12px 35px; border-radius: 30px;">
                <i class="bi bi-compass me-2"></i>Explorer
            </a>
        </div>

        <div class="slider-controls">
            <div class="slider-dot active" data-slide="0"></div>
            <div class="slider-dot" data-slide="1"></div>
            <div class="slider-dot" data-slide="2"></div>
            <div class="slider-dot" data-slide="3"></div>
        </div>
    </div>
@endif

    <!-- CONTENU PRINCIPAL -->
    <main>
        @yield('content')
    </main>

    
    <!-- FOOTER -->
    <footer class="footer" id="contact">
        <div class="container text-center">
            <div class="mb-4">
                <h5 class="mb-3">
                    <i class="bi bi-palette2 me-2"></i>
                     Bénin Culture
                </h5>
                <p class="mb-0">Valoriser le patrimoine culturel à travers l'art urbain</p>
            </div>

            <div class="footer-links">
                <p class="mb-2">
                    <a href="#"><i class="bi bi-info-circle me-1"></i> À propos</a> ·
                    <a href="#"><i class="bi bi-file-text me-1"></i> Conditions</a> ·
                    <a href="#"><i class="bi bi-shield-check me-1"></i> Confidentialité</a>
                </p>
                <p class="mb-0 text-muted">
                    &copy; 2025  Bénin Culture. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Slider functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slider-dot');
            let currentSlide = 0;

            function showSlide(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));

                currentSlide = (n + slides.length) % slides.length;

                slides[currentSlide].classList.add('active');
                dots[currentSlide].classList.add('active');
            }

            // Auto slide
            setInterval(() => {
                showSlide(currentSlide + 1);
            }, 6000);

            // Dot controls
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
