<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/img/logo.png') }}"
                 alt="Logo"
                 class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Patrimoine BJ</span>
        </a>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                data-accordion="false">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                @can('create', App\Models\Contenu::class)
                <!-- CONTENUS -->
                <li class="nav-item {{ request()->is('admin/contenus*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/contenus*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>
                            Contenus
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.contenus.index') }}"
                               class="nav-link {{ request()->routeIs('admin.contenus.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Tous les contenus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.contenus.create') }}"
                               class="nav-link {{ request()->routeIs('admin.contenus.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Nouveau contenu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.contenus.index') }}?status=pending"
                               class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    En attente
                                    <span class="badge text-bg-warning float-end">
                                        {{ \App\Models\Contenu::where('status', 'pending')->count() }}
                                    </span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

                <!-- TRADUCTIONS -->
                <li class="nav-item {{ request()->is('traductions*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('traductions*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-translate"></i>
                        <p>
                            Traductions
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('traductions.index') }}"
                               class="nav-link {{ request()->routeIs('traductions.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Mes traductions</p>
                            </a>
                        </li>
                        @role('admin|moderateur')
                        <li class="nav-item">
                            <a href="{{ route('traductions.index') }}?status=pending"
                               class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>
                                    À valider
                                    <span class="badge text-bg-warning float-end">
                                        {{ \App\Models\ContenuTraduction::where('status', 'pending')->count() }}
                                    </span>
                                </p>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </li>

                <!-- MÉDIAS -->
                @can('create', App\Models\Media::class)
                <li class="nav-item">
                    <a href="{{ route('admin.medias.index') }}"
                       class="nav-link {{ request()->routeIs('admin.medias.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-camera-video"></i>
                        <p>Médias</p>
                    </a>
                </li>
                @endcan

                <!-- DEMANDES CONTRIBUTEUR -->
                @role('lecteur')
                <li class="nav-item">
                    <a href="{{ route('demande.form') }}"
                       class="nav-link {{ request()->routeIs('demande.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-plus"></i>
                        <p>Devenir Contributeur</p>
                    </a>
                </li>
                @endrole

                @role('admin|moderateur')
                <li class="nav-item">
                    <a href="{{ route('admin.demandes.index') }}"
                       class="nav-link {{ request()->routeIs('admin.demandes.*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-check"></i>
                        <p>
                            Demandes Contributeur
                            <span class="badge text-bg-info float-end">
                                {{ \App\Models\DemandeContributeur::where('status', 'pending')->count() }}
                            </span>
                        </p>
                    </a>
                </li>
                @endrole

                <!-- ADMINISTRATION -->
                @role('admin')
                <li class="nav-header">ADMINISTRATION</li>

                <li class="nav-item {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('admin/users*') || request()->is('admin/langues*') || request()->is('admin/regions*') || request()->is('admin/type*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>
                            Paramètres
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}"
                               class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.langues.index') }}"
                               class="nav-link {{ request()->routeIs('admin.langues.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Langues</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.regions.index') }}"
                               class="nav-link {{ request()->routeIs('admin.regions.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Régions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.typecontenus.index') }}"
                               class="nav-link {{ request()->routeIs('admin.typecontenus.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Types de contenu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.typemedias.index') }}"
                               class="nav-link {{ request()->routeIs('admin.typemedias.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Types de média</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                <!-- STATISTIQUES -->
                @role('admin|moderateur')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart"></i>
                        <p>Statistiques</p>
                    </a>
                </li>
                @endrole

            </ul>
        </nav>
    </div>
</aside>
