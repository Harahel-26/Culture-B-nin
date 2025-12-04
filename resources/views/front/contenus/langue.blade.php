@extends('front.layouts.app')

@section('title', $langue->nom . ' - Culture Bénin')

@section('content')
<div class="container py-5">
    <!-- En-tête de la langue -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <div class="display-1 text-info">
                                <i class="bi bi-translate"></i>
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
                                        {{ $langue->nom }}
                                    </li>
                                </ol>
                            </nav>
                            
                            <h1 class="display-5 mb-3">
                                <i class="bi bi-translate text-info"></i> {{ $langue->nom }}
                                <small class="text-muted">({{ $langue->code }})</small>
                            </h1>
                            
                            @if($langue->description)
                            <p class="lead mb-0">{{ $langue->description }}</p>
                            @endif
                            
                            <div class="mt-3">
                                <span class="badge bg-info me-2">
                                    {{ $contenus->total() }} contenu(s)
                                </span>
                                @if($langue->icone)
                                <span class="badge bg-secondary me-2">
                                    <i class="bi bi-{{ $langue->icone }}"></i> Icône disponible
                                </span>
                                @endif
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle"></i> Langue active
                                </span>
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
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-filter"></i> Filtrer dans cette langue</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('front.contenus.langue', $langue->code) }}" method="GET">
                        <!-- Région -->
                        <div class="mb-3">
                            <label class="form-label">Région</label>
                            <select name="region" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les régions</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ request('region') == $region->id ? 'selected' : '' }}>
                                    {{ $region->nom }}
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

                        <button type="submit" class="btn btn-info w-100 mb-2">
                            <i class="bi bi-filter"></i> Appliquer
                        </button>
                        <a href="{{ route('front.contenus.langue', $langue->code) }}" 
                           class="btn btn-outline-secondary w-100">
                            <i class="bi bi-x-circle"></i> Réinitialiser
                        </a>
                    </form>
                </div>
            </div>

            <!-- Autres langues -->
            <div class="card mt-4">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0"><i class="bi bi-translate"></i> Autres langues</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($autresLangues as $autreLangue)
                        <a href="{{ route('front.contenus.langue', $autreLangue->code) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>
                                <i class="bi bi-translate me-2"></i>
                                {{ $autreLangue->nom }}
                            </span>
                            <span class="badge bg-info rounded-pill">
                                {{ $autreLangue->contenus_count ?? 0 }}
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
                    <form action="{{ route('front.contenus.langue', $langue->code) }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="Rechercher en {{ $langue->nom }}..."
                                       value="{{ request('search') }}">
                                <button type="submit" class="btn btn-info">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('front.contenus.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-translate"></i> Toutes les langues
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Message si filtres actifs -->
            @if(request()->anyFilled(['region', 'categorie', 'is_premium', 'search']))
            <div class="alert alert-info mb-4">
                <i class="bi bi-funnel"></i> Filtres actifs en "{{ $langue->nom }}" : 
                @if(request('region'))
                <span class="badge bg-success">{{ $regions->where('id', request('region'))->first()->nom ?? '' }}</span>
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
                
                <a href="{{ route('front.contenus.langue', $langue->code) }}" class="float-end text-white">
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
                                <span class="badge bg-info">
                                    <i class="bi bi-translate"></i> {{ $contenu->langue->nom }}
                                </span>
                                @if($contenu->region)
                                <span class="badge bg-success">
                                    {{ $contenu->region->nom }}
                                </span>
                                @endif
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
                                   class="btn btn-info btn-sm">
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
                <i class="bi bi-translate display-1 text-muted"></i>
                <h3 class="mt-3">Aucun contenu dans cette langue</h3>
                <p class="text-muted mb-4">
                    @if(request()->anyFilled(['region', 'categorie', 'is_premium', 'search']))
                    Aucun contenu ne correspond à vos critères de recherche.
                    @else
                    Aucun contenu n'est disponible en "{{ $langue->nom }}" pour le moment.
                    @endif
                </p>
                
                <div class="mt-4">
                    <a href="{{ route('front.contenus.langue', $langue->code) }}" 
                       class="btn btn-info">
                        <i class="bi bi-arrow-clockwise"></i> Réinitialiser la recherche
                    </a>
                    <a href="{{ route('front.contenus.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-translate"></i> Voir toutes les langues
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection