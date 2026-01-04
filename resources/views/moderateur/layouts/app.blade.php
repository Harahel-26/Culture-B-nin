<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Espace Modérateur')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .sidebar-link {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: #495057;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: #e9ecef;
            color: #0d6efd;
        }

        .badge-count {
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            margin-left: auto;
        }
    </style>
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">
            <i class="bi bi-shield-check me-2"></i> Espace Modérateur
        </span>

        <div class="d-flex align-items-center gap-3">
            <span class="text-light small">
                <i class="bi bi-person-circle me-1"></i>
                {{ Auth::user()->name }}
            </span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-outline-light">
                    <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <aside class="col-md-2 bg-white border-end min-vh-100 p-3 shadow-sm">
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('moderateur.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('moderateur.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('moderateur.commentaires.pending') }}"
                   class="sidebar-link {{ request()->routeIs('moderateur.commentaires.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-text"></i>
                    <span>Commentaires</span>
                    @isset($comment_pending)
                        @if($comment_pending > 0)
                            <span class="badge-count">{{ $comment_pending }}</span>
                        @endif
                    @endisset
                </a>

                <a href="{{ route('moderateur.contenus.pending') }}"
                   class="sidebar-link {{ request()->routeIs('moderateur.contenus.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i>
                    <span>Contenus</span>
                    @isset($contenus_pending)
                        @if($contenus_pending > 0)
                            <span class="badge-count">{{ $contenus_pending }}</span>
                        @endif
                    @endisset
                </a>

                <a href="{{ route('moderateur.medias.pending') }}"
                   class="sidebar-link {{ request()->routeIs('moderateur.medias.*') ? 'active' : '' }}">
                    <i class="bi bi-camera-video"></i>
                    <span>Médias</span>
                    @isset($medias_pending)
                        @if($medias_pending > 0)
                            <span class="badge-count">{{ $medias_pending }}</span>
                        @endif
                    @endisset
                </a>

                <a href="{{ route('moderateur.traductions.pending') }}"
                   class="sidebar-link {{ request()->routeIs('moderateur.traductions.*') ? 'active' : '' }}">
                    <i class="bi bi-translate"></i>
                    <span>Traductions</span>
                    @isset($traductions_pending)
                        @if($traductions_pending > 0)
                            <span class="badge-count">{{ $traductions_pending }}</span>
                        @endif
                    @endisset
                </a>
            </div>

            <div class="mt-4 pt-3 border-top">
                <small class="text-muted d-block mb-2">Statistiques rapides</small>
                <div class="small">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Utilisateurs actifs</span>
                        <span class="text-primary">--</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Contenus validés</span>
                        <span class="text-success">--</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- CONTENU -->
        <main class="col-md-10 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
