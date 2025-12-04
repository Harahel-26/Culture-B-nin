@extends('front.layouts.app')

@section('title', 'Tous les contenus - Culture Bénin')

@section('content')
<div class="container py-5">
    <!-- En-tête avec recherche -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="display-6 mb-4">
                        <i class="bi bi-book text-primary"></i> Tous les contenus culturels
                    </h1>

                    <!-- Barre de recherche rapide -->
                    <form action="{{ route('front.contenus.index') }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group input-group-lg">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="Rechercher un contenu..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('front.search') }}?advanced=1"
                               class="btn btn-outline-secondary btn-lg w-100">
                                <i class="bi bi-funnel"></i> Recherche avancée
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Filtres -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-filter"></i> Filtres</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('front.contenus.index') }}" method="GET">
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <!-- Langue -->
                        <div class="mb-3">
                            <label class="form-label">Langue</label>
                            <select name="langue_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les langues</option>
                                @foreach($langues as $langue)
                                <option value="{{ $langue->id }}"
                                        {{ request('langue_id') == $langue->id ? 'selected' : '' }}>
                                    {{ $langue->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Région -->
                        <div class="mb-3">
                            <label class="form-label">Région</label>
                            <select name="region_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les régions</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}"
                                        {{ request('region_id') == $region->id ? 'selected' : '' }}>
                                    {{ $region->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type de contenu -->
                        <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="typecontenu_id" class="form-select" onchange="this.form.submit()">
                                <option value="">Tous les types</option>
                                @foreach($typecontenus as $type)
                                <option value="{{ $type->id }}"
                                        {{ request('typecontenu_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Premium/Gratuit -->
                        <div class="mb-3">
                            <label class="form-label">Accès</label>
                            <select name="is_premium" class="form-select" onchange="this.form.submit()">
                                <option value="">Tous</option>
                                <option value="0" {{ request('is_premium') === '0' ? 'selected' : '' }}>
                                    Gratuits seulement
                                </option>
                                <option value="1" {{ request('is_premium') === '1' ? 'selected' : '' }}>
                                    Premium seulement
                                </option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-filter"></i> Appliquer
                        </button>
                        <a href="{{ route('front.contenus.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle"></i> Réinitialiser
                        </a>
                    </form>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-graph-up"></i> Statistiques</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Total :</span>
                            <span class="badge bg-primary">{{ $contenus->total() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Gratuits :</span>
                            <span class="badge bg-success">{{ $contenus->where('is_premium', false)->count() }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Premium :</span>
                            <span class="badge bg-warning">{{ $contenus->where('is_premium', true)->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des contenus -->
        <div class="col-md-9">
            <!-- En-tête avec compteur et tri -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    Contenus disponibles
                    @if(request()->anyFilled(['search', 'langue_id', 'region_id', 'typecontenu_id', 'is_premium']))
                    <small class="text-muted">(filtrés)</small>
                    @endif
                </h2>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-sort-down"></i> Trier par
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}">
                                <i class="bi bi-arrow-down"></i> Plus récents
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">
                                <i class="bi bi-fire"></i> Plus populaires
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sort' => 'rated']) }}">
                                <i class="bi bi-star"></i> Mieux notés
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Message si filtres actifs -->
            @if(request()->anyFilled(['langue_id', 'region_id', 'typecontenu_id', 'is_premium']))
            <div class="alert alert-info mb-4">
                <i class="bi bi-info-circle"></i> Filtres actifs :
                @if(request('langue_id'))
                <span class="badge bg-info">{{ $langues->where('id', request('langue_id'))->first()->nom ?? '' }}</span>
                @endif
                @if(request('region_id'))
                <span class="badge bg-secondary">{{ $regions->where('id', request('region_id'))->first()->nom ?? '' }}</span>
                @endif
                @if(request('typecontenu_id'))
                <span class="badge bg-primary">{{ $typecontenus->where('id', request('typecontenu_id'))->first()->nom ?? '' }}</span>
                @endif
                @if(request('is_premium') === '0')
                <span class="badge bg-success">Gratuits seulement</span>
                @elseif(request('is_premium') === '1')
                <span class="badge bg-warning">Premium seulement</span>
                @endif

                <a href="{{ route('front.contenus.index') }}" class="float-end">
                    <i class="bi bi-x-circle"></i> Supprimer les filtres
                </a>
            </div>
            @endif

            <!-- Grille de contenus -->
            @if($contenus->count() > 0)
            <div class="row">
                @foreach($contenus as $contenu)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Image -->
                        @if($contenu->image_couverture)
                        <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                             class="card-img-top"
                             alt="{{ $contenu->titre }}"
                             style="height: 180px; object-fit: cover;">
                        @else
                        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                             style="height: 180px;">
                            <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                        </div>
                        @endif

                        <!-- Badges -->
                        <div class="card-img-overlay d-flex justify-content-between">
                            @if($contenu->is_premium)
                            <span class="badge bg-warning">
                                <i class="bi bi-star-fill"></i> Premium
                            </span>
                            @else
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle"></i> Gratuit
                            </span>
                            @endif

                            <!-- Note moyenne -->
                            @php
                                $moyenne = $contenu->commentaires->avg('note') ?? 0;
                            @endphp
                            @if($moyenne > 0)
                            <span class="badge bg-info">
                                <i class="bi bi-star-fill"></i> {{ number_format($moyenne, 1) }}
                            </span>
                            @endif
                        </div>

                        <!-- Corps -->
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($contenu->titre, 60) }}</h5>

                            <p class="card-text text-muted small">
                                <i class="bi bi-person"></i> {{ $contenu->utilisateur->name ?? 'Anonyme' }}
                                <br>
                                <i class="bi bi-calendar"></i> {{ $contenu->created_at->format('d/m/Y') }}
                            </p>

                            <p class="card-text">
                                {{ Str::limit($contenu->description, 100) }}
                            </p>

                            <!-- Métadonnées -->
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                @if($contenu->langue)
                                <span class="badge bg-info">
                                    <i class="bi bi-translate"></i> {{ $contenu->langue->nom }}
                                </span>
                                @endif
                                @if($contenu->region)
                                <span class="badge bg-secondary">
                                    <i class="bi bi-geo-alt"></i> {{ $contenu->region->nom }}
                                </span>
                                @endif
                                @if($contenu->typecontenu)
                                <span class="badge bg-primary">
                                    {{ $contenu->typecontenu->nom }}
                                </span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    @if($contenu->is_premium)
                                    <span class="text-warning fw-bold">
                                        {{ number_format($contenu->prix, 0, ',', ' ') }} FCFA
                                    </span>
                                    @else
                                    <span class="text-success fw-bold">
                                        <i class="bi bi-check-circle"></i> Gratuit
                                    </span>
                                    @endif
                                </div>

                                <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Voir
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $contenus->appends(request()->except('page'))->links() }}
            </div>
            @else
            <!-- Aucun résultat -->
            <div class="text-center py-5">
                <i class="bi bi-search display-1 text-muted"></i>
                <h3 class="mt-3">Aucun contenu trouvé</h3>
                <p class="text-muted mb-4">
                    @if(request()->anyFilled(['search', 'langue_id', 'region_id', 'typecontenu_id', 'is_premium']))
                    Aucun contenu ne correspond à vos critères de recherche.
                    @else
                    Aucun contenu n'est disponible pour le moment.
                    @endif
                </p>

                <div class="mt-4">
                    <a href="{{ route('front.contenus.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-clockwise"></i> Réinitialiser la recherche
                    </a>
                    @auth
                        @if(auth()->user()->hasRole(['contributeur', 'admin']))
                        <a href="{{ route('front.contenus.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Créer un contenu
                        </a>
                        @endif
                    @endauth
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-size: 0.7rem;
        padding: 0.25em 0.6em;
    }
    .card-img-overlay .badge {
        opacity: 0.9;
    }
</style>
@endpush
