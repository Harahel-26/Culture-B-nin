@extends('front.layouts.app')

@section('title', 'Recherche : ' . ($query ?: 'Culture Bénin'))

@section('content')
<div class="container py-5">
    <!-- Barre de recherche -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('front.search') }}" method="GET" class="row g-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="text"
                                       name="q"
                                       class="form-control form-control-lg"
                                       placeholder="Rechercher un contenu, un média..."
                                       value="{{ $query }}">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-search"></i> Rechercher
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <a href="{{ route('front.search') }}?q={{ $query }}&advanced=1"
                               class="btn btn-outline-secondary btn-lg w-100">
                                <i class="bi bi-funnel"></i> Recherche avancée
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Résultats -->
    @if($query)
    <div class="row">
        <div class="col-12 mb-4">
            <h2>
                <i class="bi bi-search"></i> Résultats de recherche
                <small class="text-muted ms-2">
                    {{ $totalResults }} résultat(s) pour "{{ $query }}"
                </small>
            </h2>
        </div>
    </div>

    <!-- Filtres rapides -->
    @if($contenus->total() > 0 || $medias->total() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('front.search') }}" method="GET" class="row g-3">
                        <input type="hidden" name="q" value="{{ $query }}">

                        <div class="col-md-3">
                            <label class="form-label">Catégorie</label>
                            <select name="categorie" class="form-select" onchange="this.form.submit()">
                                <option value="">Toutes les catégories</option>
                                @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ request('categorie') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
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

                        <div class="col-md-3">
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

                        <div class="col-md-3 d-flex align-items-end">
                            <a href="{{ route('front.search') }}?q={{ $query }}" class="btn btn-outline-secondary w-100">
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Contenus trouvés -->
    @if($contenus->total() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="bi bi-file-earmark-text"></i> Contenus
                <span class="badge bg-primary">{{ $contenus->total() }}</span>
            </h3>

            <div class="row">
                @foreach($contenus as $contenu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($contenu->image_couverture)
                        <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                             class="card-img-top"
                             alt="{{ $contenu->titre }}"
                             style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $contenu->titre }}</h5>
                            <p class="card-text text-muted small">
                                <i class="bi bi-person"></i> {{ $contenu->utilisateur->name ?? 'Auteur' }}
                                | <i class="bi bi-calendar"></i> {{ $contenu->created_at->format('d/m/Y') }}
                            </p>

                            <p class="card-text">
                                {{ Str::limit($contenu->description, 100) }}
                            </p>

                            <div class="mb-3">
                                @if($contenu->langue)
                                <span class="badge bg-info">{{ $contenu->langue->nom }}</span>
                                @endif
                                @if($contenu->region)
                                <span class="badge bg-secondary">{{ $contenu->region->nom }}</span>
                                @endif
                                @if($contenu->is_premium)
                                <span class="badge bg-warning">Premium</span>
                                @endif
                            </div>

                            <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                               class="btn btn-primary btn-sm">
                                Voir le contenu
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination contenus -->
            @if($contenus->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $contenus->appends(request()->except('page'))->links() }}
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Médias trouvés -->
    @if($medias->total() > 0)
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="bi bi-image"></i> Médias
                <span class="badge bg-success">{{ $medias->total() }}</span>
            </h3>

            <div class="row">
                @foreach($medias as $media)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            @if($media->type_media_id == 1) <!-- Image -->
                            <div class="bg-light rounded p-3 mb-3" style="height: 150px;">
                                <i class="bi bi-image display-4 text-muted"></i>
                            </div>
                            @elseif($media->type_media_id == 2) <!-- Vidéo -->
                            <div class="bg-light rounded p-3 mb-3" style="height: 150px;">
                                <i class="bi bi-play-circle display-4 text-muted"></i>
                            </div>
                            @elseif($media->type_media_id == 3) <!-- Audio -->
                            <div class="bg-light rounded p-3 mb-3" style="height: 150px;">
                                <i class="bi bi-music-note-beamed display-4 text-muted"></i>
                            </div>
                            @endif

                            <h6 class="card-title">{{ $media->titre }}</h6>

                            @if($media->contenu)
                            <p class="text-muted small">
                                Dans : {{ Str::limit($media->contenu->titre, 30) }}
                            </p>
                            <a href="{{ route('front.contenus.show', $media->contenu->slug) }}"
                               class="btn btn-outline-primary btn-sm">
                                Voir le contenu
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination médias -->
            @if($medias->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $medias->appends(request()->except('page'))->links() }}
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Aucun résultat -->
    @if($contenus->total() == 0 && $medias->total() == 0)
    <div class="text-center py-5">
        <i class="bi bi-search display-1 text-muted"></i>
        <h3 class="mt-3">Aucun résultat trouvé</h3>
        <p class="text-muted">Essayez d'autres mots-clés ou élargissez vos critères de recherche</p>

        <div class="mt-4">
            <a href="{{ route('front.contenus.index') }}" class="btn btn-primary">
                <i class="bi bi-eye"></i> Voir tous les contenus
            </a>
            <a href="{{ route('front.accueil') }}" class="btn btn-outline-secondary">
                <i class="bi bi-house"></i> Retour à l'accueil
            </a>
        </div>
    </div>
    @endif

    @else
    <!-- Page de recherche vide -->
    <div class="text-center py-5">
        <i class="bi bi-search display-1 text-primary"></i>
        <h2 class="mt-3">Que souhaitez-vous découvrir aujourd'hui ?</h2>
        <p class="text-muted mb-4">
            Recherchez des contes, musiques, traditions, ou explorez par langue, région...
        </p>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suggestions de recherche</h5>
                        <div class="d-flex flex-wrap gap-2 mt-3">
                            @foreach(['Contes', 'Musique', 'Danse', 'Cuisine', 'Artisanat', 'Histoire'] as $suggestion)
                            <a href="{{ route('front.search') }}?q={{ $suggestion }}"
                               class="btn btn-outline-primary">
                                {{ $suggestion }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-size: 0.75rem;
    }
</style>
@endpush
