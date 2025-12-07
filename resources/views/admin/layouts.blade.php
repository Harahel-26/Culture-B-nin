<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Gestion Culturelle | Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/index.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">

    <!-- AdminLTE + Styles -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/custom.css') }}">
</head>

<body class="layout-fixed sidebar-open">

<div class="app-wrapper">

    <!-- HEADER -->
    <nav class="app-header navbar navbar-expand navbar-light bg-white shadow-sm">
        <div class="container-fluid">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-lte-toggle="sidebar" href="#">
                        <i class="bi bi-list"></i>
                    </a>
                </li>

                <li class="nav-item d-none d-md-block">
                    <a href="{{ url('/') }}" class="nav-link">Accueil</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">

                @auth
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}"
                                 class="user-image rounded-circle shadow" alt="User">
                            <span class="d-none d-md-inline">
                                {{ Auth::user()->name }}.
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header bg-primary text-white">
                                <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}"
                                     class="rounded-circle shadow">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}</small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <a href="{{ route('front.profil.edit', auth()->user()) }}" class="btn btn-default">Profil</a>

                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-default float-end">
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside class="app-sidebar bg-white border-end">

        <div class="sidebar-brand text-center py-3">
            <a href="/" class="brand-link text-decoration-none">
                <img src="{{ asset('images/logo-culture.png') }}"
                     class="brand-image" alt="logo">
                <span class="brand-text fw-bold ms-1">Culture BJ</span>
            </a>
        </div>

        <div class="sidebar-wrapper">

            <nav class="mt-3">
                <ul class="nav nav-pills flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboards.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- CONTENUS -->
                    <li class="nav-header mt-3">GESTION DES CONTENUS</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.contenus.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-file-earmark-text"></i>
                            <p>Contenus</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.commentaires.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-chat-text"></i>
                            <p>Commentaires</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.typecontenus.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-folder2"></i>
                            <p>Types de contenu</p>
                        </a>
                    </li>

                    <!-- MULTIMEDIA -->
                    <li class="nav-header mt-3">MULTIMÉDIA</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.medias.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-image"></i>
                            <p>Médias</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.typemedias.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-collection-play"></i>
                            <p>Types médias</p>
                        </a>
                    </li>

                    <!-- UTILISATEURS -->
                    <li class="nav-header mt-3">UTILISATEURS & RÔLES</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Utilisateurs</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-shield-lock"></i>
                            <p>Rôles</p>
                        </a>
                    </li>

                    <!-- PARAMÈTRES -->
                    <li class="nav-header mt-3">PARAMÈTRES</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.langues.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-translate"></i>
                            <p>Langues</p>
                        </a>
                    </li>
                    

                </ul>
            </nav>

        </div>
    </aside>

    <!-- MAIN -->
    <main class="app-main">
        <div class="app-content p-3">
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="app-footer text-center py-3">
        <strong>&copy; {{ date('Y') }} Culture BJ.</strong> Tous droits réservés.
    </footer>

</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

@stack('scripts')

</body>
</html>
