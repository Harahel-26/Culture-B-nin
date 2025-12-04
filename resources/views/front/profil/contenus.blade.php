@extends('front.layouts.app')

@section('title', 'Mes contenus - Culture Bénin')

@section('content')
<div class="container py-5">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="h3 mb-0">
                                <i class="bi bi-file-earmark-text text-primary"></i> Mes contenus
                            </h1>
                            <p class="text-muted mb-0">
                                Gérez tous les contenus que vous avez créés
                            </p>
                        </div>
                        <a href="{{ route('front.contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Nouveau contenu
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Total</h5>
                    <h2 class="display-6">{{ $contenus->total() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Validés</h5>
                    <h2 class="display-6">{{ $user->contenus()->where('status', 'validated')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h5 class="card-title">En attente</h5>
                    <h2 class="display-6">{{ $user->contenus()->where('status', 'pending')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Premium</h5>
                    <h2 class="display-6">{{ $user->contenus()->where('is_premium', true)->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('front.profil.contenus') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">Tous les statuts</option>
                        <option value="validated" {{ request('status') == 'validated' ? 'selected' : '' }}>
                            Validés
                        </option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                            En attente
                        </option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>
                            Brouillons
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                            Rejetés
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select" onchange="this.form.submit()">
                        <option value="">Tous les types</option>
                        <option value="premium" {{ request('type') == 'premium' ? 'selected' : '' }}>
                            Premium seulement
                        </option>
                        <option value="free" {{ request('type') == 'free' ? 'selected' : '' }}>
                            Gratuits seulement
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Recherche</label>
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Rechercher dans mes contenus..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a href="{{ route('front.profil.contenus') }}" class="btn btn-outline-secondary w-100">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des contenus -->
    <div class="card">
        <div class="card-body">
            @if($contenus->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Type</th>
                            <th>Langue</th>
                            <th>Statut</th>
                            <th>Accès</th>
                            <th>Créé le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contenus as $contenu)
                        <tr>
                            <td>
                                <strong>{{ $contenu->titre }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ Str::limit($contenu->description, 50) }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    {{ $contenu->typecontenu->nom ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $contenu->langue->nom ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                @if($contenu->status == 'validated')
                                <span class="badge bg-success">Validé</span>
                                @elseif($contenu->status == 'pending')
                                <span class="badge bg-warning">En attente</span>
                                @elseif($contenu->status == 'draft')
                                <span class="badge bg-secondary">Brouillon</span>
                                @else
                                <span class="badge bg-danger">Rejeté</span>
                                @endif
                            </td>
                            <td>
                                @if($contenu->is_premium)
                                <span class="badge bg-warning">
                                    <i class="bi bi-star-fill"></i> Premium
                                </span>
                                @else
                                <span class="badge bg-success">Gratuit</span>
                                @endif
                            </td>
                            <td>
                                <small>
                                    {{ $contenu->created_at->format('d/m/Y') }}<br>
                                    <span class="text-muted">{{ $contenu->created_at->format('H:i') }}</span>
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                                       class="btn btn-info"
                                       target="_blank"
                                       title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @if(in_array($contenu->status, ['draft', 'rejected']))
                                    <a href="{{ route('front.contenus.edit', $contenu) }}"
                                       class="btn btn-warning"
                                       title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @endif

                                    @if($contenu->status == 'draft')
                                    <form action="{{ route('front.contenus.submit', $contenu) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-success"
                                                title="Soumettre pour validation">
                                            <i class="bi bi-send"></i>
                                        </button>
                                    </form>
                                    @endif

                                    @if(in_array($contenu->status, ['draft', 'rejected']))
                                    <form action="{{ route('front.contenus.destroy', $contenu) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger"
                                                title="Supprimer"
                                                onclick="return confirm('Supprimer ce contenu ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $contenus->appends(request()->except('page'))->links() }}
            </div>
            @else
            <!-- Aucun contenu -->
            <div class="text-center py-5">
                <i class="bi bi-file-earmark-text display-1 text-muted"></i>
                <h3 class="mt-3">Aucun contenu trouvé</h3>
                <p class="text-muted mb-4">
                    @if(request()->anyFilled(['status', 'type', 'search']))
                    Aucun contenu ne correspond à vos critères de recherche.
                    @else
                    Vous n'avez pas encore créé de contenu.
                    @endif
                </p>
                <a href="{{ route('front.contenus.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Créer votre premier contenu
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Retour -->
    <div class="mt-4">
        <a href="{{ route('front.profil.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour au profil
        </a>
    </div>
</div>
@endsection
