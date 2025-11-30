<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <!-- Bouton toggle sidebar -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block">
                <a href="{{ route('dashboard') }}" class="nav-link">Accueil</a>
            </li>
        </ul>

        <!-- Menu de droite -->
        <ul class="navbar-nav ms-auto">

            <!-- Recherche -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>


            <!-- Plein écran -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

            <!-- Menu utilisateur -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                             class="user-image rounded-circle shadow"
                             alt="{{ auth()->user()->name }}" />
                    @else
                        <img src="{{ asset('assets/img/default-avatar.png') }}"
                             class="user-image rounded-circle shadow"
                             alt="{{ auth()->user()->name }}" />
                    @endif
                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <!-- User Image -->
                    <li class="user-header text-bg-primary">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                 class="rounded-circle shadow"
                                 alt="{{ auth()->user()->name }}" />
                        @else
                            <img src="{{ asset('assets/img/default-avatar.png') }}"
                                 class="rounded-circle shadow"
                                 alt="{{ auth()->user()->name }}" />
                        @endif
                        <p>
                            {{ auth()->user()->name }}
                            <small>
                                @if(auth()->user()->hasRole('admin'))
                                    Administrateur
                                @elseif(auth()->user()->hasRole('moderateur'))
                                    Modérateur
                                @elseif(auth()->user()->hasRole('contributeur'))
                                    Contributeur
                                @else
                                    Lecteur
                                @endif
                            </small>
                            <small>Membre depuis {{ auth()->user()->created_at->format('M Y') }}</small>
                        </p>
                    </li>

                    <!-- Menu Footer -->
                    <li class="user-footer">
                        <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-default btn-flat float-end">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
