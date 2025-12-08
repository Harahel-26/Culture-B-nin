<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Gestion Culturelle | Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/inter@5/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <style>
        :root {
            --admin-primary: #1e1b4b;
            --admin-secondary: #8a2be2;
            --admin-accent: #6366f1;
            --admin-success: #10b981;
            --admin-danger: #ef4444;
            --admin-warning: #f59e0b;
            --admin-light: #f8f9fa;
            --admin-dark: #0f172a;
            --admin-gray: #64748b;
            --sidebar-bg: rgba(255, 255, 255, 0.95);
            --sidebar-text: #4a5568;
            --sidebar-active: rgba(138, 43, 226, 0.1);
            --sidebar-width: 280px;
            --header-height: 60px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            background: #f8fafc;
            color: var(--admin-dark);
            min-height: 100vh;
        }

        .app-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: var(--sidebar-width);

        }

        /* HEADER */
        .app-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            height: var(--header-height);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 1000;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.9);
        }

        .header-container {
            padding: 0 1.5rem;
        }

        .header-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(45deg, var(--admin-secondary), var(--admin-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
        }

        .header-brand:hover {
            opacity: 0.9;
        }

        /* SIDEBAR */
        .app-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1030;
            overflow-y: auto;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(138, 43, 226, 0.1);
            box-shadow: 2px 0 15px rgba(0, 0, 0, 0.03);
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(138, 43, 226, 0.1);
            text-align: center;
            background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(99, 102, 241, 0.05));
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--admin-primary);
        }

        .logo-image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 10px;
            border: 2px solid rgba(138, 43, 226, 0.2);
            padding: 2px;
            background: white;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--admin-primary);
            letter-spacing: 0.5px;
        }

        .logo-subtitle {
            font-size: 0.8rem;
            color: var(--admin-secondary);
            margin-top: 2px;
            font-weight: 500;
        }

        .sidebar-nav {
            padding: 1.5rem 1rem;
        }

        .nav-section-title {
            color: var(--admin-secondary);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin: 1.5rem 0 0.8rem 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(138, 43, 226, 0.1);
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.8rem 1rem;
            color: var(--sidebar-text);
            text-decoration: none;
            border-radius: 10px;
            margin-bottom: 0.3rem;
            transition: all 0.3s ease;
            position: relative;
            background: transparent;
        }

        .nav-link:hover {
            background: rgba(138, 43, 226, 0.08);
            color: var(--admin-secondary);
            transform: translateX(5px);
        }

        .nav-link.active {
            background: var(--sidebar-active);
            color: var(--admin-secondary);
            border-left: 3px solid var(--admin-secondary);
            font-weight: 600;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: var(--admin-secondary);
            border-radius: 0 4px 4px 0;
        }

        .nav-icon {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            margin-right: 12px;
            color: var(--admin-secondary);
            opacity: 0.8;
        }

        .nav-link.active .nav-icon {
            opacity: 1;
            color: var(--admin-secondary);
        }

        .nav-text {
            font-size: 0.95rem;
            font-weight: 500;
            flex: 1;
        }

        .nav-badge {
            background: var(--admin-secondary);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 600;
            margin-left: 8px;
        }

        /* MAIN CONTENT */
        .app-main {
            flex: 1;
            margin-top: var(--header-height);
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* USER MENU */
        .user-menu {
            position: relative;
        }

        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.5rem 1rem;
            border: none;
            background: none;
            color: var(--admin-dark);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        .user-dropdown-toggle:hover {
            background: rgba(138, 43, 226, 0.1);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(138, 43, 226, 0.3);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--admin-dark);
        }

        .user-role {
            font-size: 0.8rem;
            color: var(--admin-gray);
        }

        .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 0.5rem;
            margin-top: 10px;
            border: 1px solid rgba(138, 43, 226, 0.1);
        }

        .dropdown-item {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            font-size: 0.95rem;
            color: var(--admin-dark);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item:hover {
            background: rgba(138, 43, 226, 0.1);
            color: var(--admin-secondary);
        }

        .dropdown-item.logout {
            color: var(--admin-danger);
        }

        .dropdown-item.logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* FOOTER */
        .app-footer {
            background: white;
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem;
            text-align: center;
            color: var(--admin-gray);
            font-size: 0.9rem;
            margin-left: var(--sidebar-width);
        }

        /* BREADCRUMB */
        .breadcrumb-container {
            background: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(138, 43, 226, 0.1);
        }

        .breadcrumb {
            margin: 0;
            background: none;
            padding: 0;
        }

        .breadcrumb-item a {
            color: var(--admin-secondary);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: var(--admin-gray);
        }

        /* PAGE TITLE */
        .page-header {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            border-left: 4px solid var(--admin-secondary);
            background: linear-gradient(to right, rgba(138, 43, 226, 0.02), white);
        }

        .page-title {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--admin-primary);
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-subtitle {
            color: var(--admin-gray);
            font-size: 1rem;
            margin-top: 0.5rem;
            margin-bottom: 0;
        }

        /* ALERTS */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            color: #065f46;
            border-left: 4px solid var(--admin-success);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
            color: #991b1b;
            border-left: 4px solid var(--admin-danger);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05));
            color: #92400e;
            border-left: 4px solid var(--admin-warning);
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 992px) {
            .app-sidebar {
                transform: translateX(-100%);
                background: white;
            }

            .app-sidebar.show {
                transform: translateX(0);
            }

            .app-wrapper,
            .app-footer {
                margin-left: 0;
            }

            .app-header {
                left: 0;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.3);
                z-index: 1020;
                display: none;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .app-main {
                padding: 1rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .header-brand {
                font-size: 1.2rem;
            }
        }

        /* UTILITY CLASSES */
        .btn-admin-primary {
            background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-admin-primary:hover {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(138, 43, 226, 0.2);
        }

        .btn-admin-secondary {
            background: white;
            border: 2px solid #e2e8f0;
            color: var(--admin-dark);
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-admin-secondary:hover {
            border-color: var(--admin-secondary);
            background: rgba(138, 43, 226, 0.05);
        }

        .card-admin {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(138, 43, 226, 0.1);
            transition: all 0.3s ease;
        }

        .card-admin:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        /* SCROLLBAR STYLING */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(138, 43, 226, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(138, 43, 226, 0.5);
        }

        .app-sidebar::-webkit-scrollbar-track {
            background: rgba(138, 43, 226, 0.05);
        }

        .app-sidebar::-webkit-scrollbar-thumb {
            background: rgba(138, 43, 226, 0.2);
        }

        .app-sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(138, 43, 226, 0.3);
        }

        /* ANIMATIONS */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- SIDEBAR OVERLAY FOR MOBILE -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <aside class="app-sidebar" id="appSidebar">
        <div class="sidebar-header">
            <a href="/" class="sidebar-logo">
                <img src="{{ asset('images/logo-culture.png') }}"
                     class="logo-image"
                     alt="Culture Bénin Logo"
                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22%3E%3Ccircle cx=%2230%22 cy=%2230%22 r=%2230%22 fill=%22%23f8f9fa%22 stroke=%22%238a2be2%22 stroke-width=%222%22/%3E%3Ctext x=%2250%25%22 y=%2255%25%22 font-family=%22Playfair Display%22 font-size=%2218%22 fill=%22%238a2be2%22 text-anchor=%22middle%22 font-weight=%22bold%22%3ECB%3C/text%3E%3C/svg%3E'">
                <span class="logo-text">Culture Bénin</span>
                <span class="logo-subtitle">Administration</span>
            </a>
        </div>

        <div class="sidebar-nav">
            <!-- DASHBOARD -->
            <div class="nav-section-title">Tableau de bord</div>
            <a href="{{ route('admin.dashboards.index') }}"
               class="nav-link {{ request()->routeIs('admin.dashboards.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-speedometer2"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <!-- CONTENUS -->
            <div class="nav-section-title">Gestion des contenus</div>
            <a href="{{ route('admin.contenus.index') }}"
               class="nav-link {{ request()->routeIs('admin.contenus.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-file-earmark-text"></i>
                <span class="nav-text">Contenus</span>
            </a>

            <a href="{{ route('admin.traductions.index') }}"
               class="nav-link {{ request()->routeIs('admin.traductions.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-translate"></i>
                <span class="nav-text">Traductions</span>
            </a>

            <a href="{{ route('admin.commentaires.index') }}"
               class="nav-link {{ request()->routeIs('admin.commentaires.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-chat-text"></i>
                <span class="nav-text">Commentaires</span>
                @if($pendingComments ?? 0 > 0)
                    <span class="nav-badge">{{ $pendingComments }}</span>
                @endif
            </a>

            <a href="{{ route('admin.typecontenus.index') }}"
               class="nav-link {{ request()->routeIs('admin.typecontenus.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-folder2"></i>
                <span class="nav-text">Types de contenu</span>
            </a>

            <!-- MULTIMÉDIA -->
            <div class="nav-section-title">Multimédia</div>
            <a href="{{ route('admin.medias.index') }}"
               class="nav-link {{ request()->routeIs('admin.medias.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-image"></i>
                <span class="nav-text">Médias</span>
            </a>

            <a href="{{ route('admin.typemedias.index') }}"
               class="nav-link {{ request()->routeIs('admin.typemedias.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-collection-play"></i>
                <span class="nav-text">Types médias</span>
            </a>

            <!-- UTILISATEURS -->
            <div class="nav-section-title">Utilisateurs & Rôles</div>
            <a href="{{ route('admin.users.index') }}"
               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-people"></i>
                <span class="nav-text">Utilisateurs</span>
            </a>

            <a href="{{ route('admin.demandes.index') }}"
               class="nav-link {{ request()->routeIs('admin.demandes.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-person-plus"></i>
                <span class="nav-text">Demandes contributeurs</span>
                @if($pendingDemands ?? 0 > 0)
                    <span class="nav-badge">{{ $pendingDemands }}</span>
                @endif
            </a>

            <a href="#" class="nav-link">
                <i class="nav-icon bi bi-shield-lock"></i>
                <span class="nav-text">Rôles & Permissions</span>
            </a>

            <a href="{{ route('admin.paiements.index') }}"
               class="nav-link {{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-credit-card"></i>
                <span class="nav-text">Paiements</span>
            </a>

            <!-- PARAMÈTRES -->
            <div class="nav-section-title">Paramètres</div>
            <a href="{{ route('admin.langues.index') }}"
               class="nav-link {{ request()->routeIs('admin.langues.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-translate"></i>
                <span class="nav-text">Langues</span>
            </a>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="app-wrapper">
        <!-- HEADER -->
        <nav class="app-header">
            <div class="container-fluid header-container d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>

                    <a href="/" class="header-brand">
                        Culture Bénin
                    </a>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url('/') }}"
                       class="btn-admin-secondary btn-sm d-none d-md-inline-flex align-items-center gap-2"
                       target="_blank">
                        <i class="bi bi-house-door"></i>
                        Voir le site
                    </a>

                    @auth
                    <div class="user-menu">
                        <button class="user-dropdown-toggle" data-bs-toggle="dropdown">
                            @if(Auth::user()->avatar_url)
                                <img src="{{ Auth::user()->avatar_url }}"
                                     class="user-avatar"
                                     alt="{{ Auth::user()->name }}">
                            @else
                                <div class="user-avatar"
                                     style="background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
                                            display: flex; align-items: center; justify-content: center; color: white;
                                            font-weight: 600; font-size: 0.9rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif

                            <div class="user-info d-none d-md-block">
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <span class="user-role">{{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}</span>
                            </div>
                            <i class="bi bi-chevron-down"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('front.profil.edit', auth()->user()) }}">
                                    <i class="bi bi-person"></i>
                                    Mon profil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('front.home') }}">
                                    <i class="bi bi-eye"></i>
                                    Voir mon profil public
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout w-100 text-start">
                                        <i class="bi bi-box-arrow-right"></i>
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- MAIN CONTENT -->
        <main class="app-main">
            <div class="content-container">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show fade-in">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show fade-in">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @hasSection('breadcrumb')
                <div class="breadcrumb-container fade-in">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
                @endif

                @hasSection('page-header')
                    @yield('page-header')
                @endif

                @yield('content')
            </div>
        </main>

        <!-- FOOTER -->
        <footer class="app-footer">
            <div class="container">
                <strong>&copy; {{ date('Y') }} Culture Bénin.</strong>
                <span class="text-muted ms-2">Plateforme de gestion culturelle</span>
            </div>
        </footer>
    </div>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appSidebar = document.getElementById('appSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                appSidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
                document.body.style.overflow = appSidebar.classList.contains('show') ? 'hidden' : '';
            });

            sidebarOverlay.addEventListener('click', () => {
                appSidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
                document.body.style.overflow = '';
            });
        }

        // Close sidebar when clicking a link on mobile
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    appSidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-menu') && !e.target.closest('[data-bs-toggle="dropdown"]')) {
                const openDropdowns = document.querySelectorAll('.dropdown-menu.show');
                openDropdowns.forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });

        // Active link highlighting
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // Add fade-in animation to content
        document.addEventListener('DOMContentLoaded', () => {
            const mainContent = document.querySelector('.app-main');
            if (mainContent) {
                mainContent.classList.add('fade-in');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
