@extends('front.layouts.app')

@section('title', $region->nom . ' - Culture Bénin')

@section('content')
<div class="container py-5">
    <!-- En-tête de la région -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="display-1 text-success">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front.accueil') }}">Accueil</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('front.contenus.index') }}">Contenus</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        {{ $region->nom }}
                                    </li>
                                </ol>
                            </nav>
                            
                            <h1 class="display-5 mb-3">
                                <i class="bi bi-geo-alt text-success"></i> {{ $region->nom }}
                                @if($region->type)
                                <small class="text-muted">({{ $region->type }})</small>
                                @endif
                            </h1>
                            
                            @if($region->description)
                            <p class="lead mb-0">{{ $region->description }}</p>
                            @endif
                            
                            <div class="mt-3">
                                <span class="badge bg-success me-2">
                                    {{ $contenus->total() }} contenu(s)
                                </span>
                                @if($region->langue_principale)
                                <span class="badge bg-info me-2">
                                    <i class="bi bi-translate"></i> {{ $region->langue_principale }}
                                </span>
                                @endif
                                @if($region->image)
                                <span class="badge bg-secondary">
                                    <i class="bi bi-image"></i> Galerie disponible
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Filtres latéraux -->
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-filter"></i> Filtrer dans cette région</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('front.contenus.region', $region->slug) }}" method="GET">
                        <!-- Langue -->
                        <div class="mb-3">
                            <label class="form-label">Langue</label>
                            <select name="langue" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les langues</option>
                                @foreach($langues as $langue)
                                <option value="{{ $langue->id }}" {{ request('langue') == $langue->id ? 'selected' : '' }}>
                                    {{ $langue->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Catégorie -->
                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <select name="categorie" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
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

                        <button type="submit" class="btn btn-success w-100 mb-2">
                            <i class="bi bi-filter"></i> Appliquer
                        </button>
                        <a href="{{ route('front.contenus.region', $region->slug) }}" 
                           class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle"></i> Réinitialiser
                        </a>
                    </form>
                </div>
            </div>

            <!-- Autres régions -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0"><i class="bi bi-map"></i> Autres régions</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($autresRegions as $autreRegion)
                        <a href="{{ route('front.contenus.region', $autreRegion->slug) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>
                                <i class="bi bi-geo-alt me-2"></i>
                                {{ $autreRegion->nom }}
                            </span>
                            <span class="badge bg-success rounded-pill">
                                {{ $autreRegion->contenus_count ?? 0 }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des contenus -->
        <div class="col-md-9">
            <!-- Barre de recherche -->
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('front.contenus.region', $region->slug) }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Rechercher dans {{ $region->nom }}..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('front.contenus.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-grid"></i> Toutes les régions
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Message si filtres actifs -->
            @if(request()->anyFilled(['langue', 'categorie', 'is_premium', 'search']))
            <div class="alert alert-success mb-4">
                <i class="bi bi-funnel"></i> Filtres actifs dans "{{ $region->nom }}" : 
                @if(request('langue'))
                <span class="badge bg-info">{{ $langues->where('id', request('langue'))->first()->nom ?? '' }}</span>
                @endif
                @if(request('categorie'))
                <span class="badge bg-primary">{{ $categories->where('id', request('categorie'))->first()->nom ?? '' }}</span>
                @endif
                @if(request('is_premium') === '0')
                <span class="badge bg-success">Gratuits seulement</span>
                @elseif(request('is_premium') === '1')
                <span class="badge bg-warning">Premium seulement</span>
                @endif
                @if(request('search'))
                <span class="badge bg-dark">Recherche : "{{ request('search') }}"</span>
                @endif
                
                <a href="{{ route('front.contenus.region', $region->slug) }}" class="float-end text-white">
                    <i class="bi bi-x-circle"></i> Supprimer les filtres
                </a>
            </div>
            @endif

            <!-- Grille de contenus -->
            @if($contenus->count() > 0)
            <div class="row">
                @foreach($contenus as $contenu)
                <div class="col-md-4 mb-4">
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

                        <!-- Corps -->
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($contenu->titre, 60) }}</h5>
                            <p class="card-text text-muted small">
                                <i class="bi bi-person"></i> {{ $contenu->utilisateur->name ?? 'Anonyme' }}
                            </p>
                            <p class="card-text">
                                {{ Str::limit($contenu->description, 100) }}
                            </p>

                            <!-- Métadonnées -->
                            <div class="d-flex flex-wrap gap-1 mb-3">
                                @if($contenu->langue)
                                <span class="badge bg-info">
                                    {{ $contenu->langue->nom }}
                                </span>
                                @endif
                                <span class="badge bg-success">
                                    <i class="bi bi-geo-alt"></i> {{ $contenu->region->nom }}
                                </span>
                                @if($contenu->is_premium)
                                <span class="badge bg-warning">
                                    <i class="bi bi-star-fill"></i> Premium
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
                                   class="btn btn-success btn-sm">
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
                <i class="bi bi-geo-alt display-1 text-muted"></i>
                <h3 class="mt-3">Aucun contenu dans cette région</h3>
                <p class="text-muted mb-4">
                    @if(request()->anyFilled(['langue', 'categorie', 'is_premium', 'search']))
                    Aucun contenu ne correspond à vos critères de recherche.
                    @else
                    Aucun contenu n'est disponible dans "{{ $region->nom }}" pour le moment.
                    @endif
                </p>
                
                <div class="mt-4">
                    <a href="{{ route('front.contenus.region', $region->slug) }}" 
                       class="btn btn-success">
                        <i class="bi bi-arrow-clockwise"></i> Réinitialiser la recherche
                    </a>
                    <a href="{{ route('front.contenus.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-map"></i> Voir toutes les régions
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection