@extends('admin.layouts')

@section('title', 'Détails du commentaire #' . $commentaire->id)

@section('content')
<div class="container-fluid">
    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-chat-text me-2"></i>
                        Détails du commentaire #{{ $commentaire->id }}
                    </h3>
                    <a href="{{ route('admin.commentaires.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne gauche : Détails du commentaire -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-chat-quote me-2"></i>Contenu du commentaire
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Commentaire -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Commentaire :</h6>
                        <div class="bg-light p-4 rounded border">
                            <p class="mb-0 lead">{{ $commentaire->commentaire }}</p>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Note attribuée :</h6>
                        <div class="d-flex align-items-center">
                            <div class="text-warning" style="font-size: 1.8rem;">
                                {{ str_repeat('★', $commentaire->note) }}{{ str_repeat('☆', 5 - $commentaire->note) }}
                            </div>
                            <span class="ms-3 fs-5">
                                <strong>{{ $commentaire->note }}</strong> / 5
                            </span>
                        </div>
                    </div>

                    <!-- Statut -->
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Statut :</h6>
                        @if($commentaire->statut == 'pending')
                            <span class="badge bg-warning fs-6 p-2">
                                <i class="bi bi-clock me-1"></i> En attente de modération
                            </span>
                        @elseif($commentaire->statut == 'validated')
                            <span class="badge bg-success fs-6 p-2">
                                <i class="bi bi-check-circle me-1"></i> Validé
                            </span>
                        @else
                            <span class="badge bg-danger fs-6 p-2">
                                <i class="bi bi-x-circle me-1"></i> Rejeté
                            </span>
                        @endif
                    </div>

                    <!-- Dates -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Date de création :</h6>
                            <p class="mb-0">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $commentaire->created_at->format('d/m/Y') }}
                                <span class="text-muted ms-2">
                                    {{ $commentaire->created_at->format('H:i:s') }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Dernière modification :</h6>
                            <p class="mb-0">
                                <i class="bi bi-clock-history me-1"></i>
                                {{ $commentaire->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne droite : Informations contextuelles -->
        <div class="col-lg-4">
            <!-- Carte Auteur -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-circle me-2"></i>Auteur
                    </h5>
                </div>
                <div class="card-body">
                    @if($commentaire->utilisateur)
                    <div class="text-center mb-3">
                        <img src="{{ asset('adminlte/img/user2-160x160.jpg') }}"
                             alt="{{ $commentaire->utilisateur->name }}"
                             class="rounded-circle shadow"
                             width="80"
                             height="80">
                        <h5 class="mt-3 mb-1">{{ $commentaire->utilisateur->name }}</h5>
                        <p class="text-muted mb-0">
                            {{ $commentaire->utilisateur->email }}
                        </p>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Rôle :</span>
                            <span class="badge bg-primary">
                                {{ $commentaire->utilisateur->roles->first()->name ?? 'Lecteur' }}
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Membre depuis :</span>
                            <span>{{ $commentaire->utilisateur->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Total commentaires :</span>
                            <span class="badge bg-info">
                                {{ $commentaire->utilisateur->commentaires->count() }}
                            </span>
                        </div>
                    </div>
                    @else
                    <div class="text-center text-muted">
                        <i class="bi bi-person-x display-6"></i>
                        <p class="mt-2">Auteur non disponible</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Carte Contenu -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-file-earmark-text me-2"></i>Contenu concerné
                    </h5>
                </div>
                <div class="card-body">
                    @if($commentaire->contenu)
                    <h6 class="mb-2">{{ $commentaire->contenu->titre }}</h6>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Type :</span>
                            <span class="badge bg-secondary">
                                {{ $commentaire->contenu->typecontenu->nom ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Langue :</span>
                            <span class="badge bg-info">
                                {{ $commentaire->contenu->langue->nom ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Région :</span>
                            <span class="badge bg-success">
                                {{ $commentaire->contenu->region->nom ?? 'N/A' }}
                            </span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Statut :</span>
                            <span class="badge {{ $commentaire->contenu->is_premium ? 'bg-warning' : 'bg-primary' }}">
                                {{ $commentaire->contenu->is_premium ? 'Premium' : 'Gratuit' }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('front.contenus.show', $commentaire->contenu->slug) }}"
                           target="_blank"
                           class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-box-arrow-up-right me-1"></i>
                            Voir le contenu
                        </a>
                    </div>
                    @else
                    <div class="text-center text-muted">
                        <i class="bi bi-file-x display-6"></i>
                        <p class="mt-2">Contenu non disponible</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions de modération -->
            @if($commentaire->statut == 'pending')
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-shield-check me-2"></i>Actions de modération
                    </h5>
                </div>
                <div class="card-body text-center">
                    <form action="{{ route('admin.commentaires.valider', $commentaire->id) }}"
                          method="POST"
                          class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-check-circle me-2"></i>
                            Valider ce commentaire
                        </button>
                    </form>

                    <form action="{{ route('admin.commentaires.rejeter', $commentaire->id) }}"
                          method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-lg w-100">
                            <i class="bi bi-x-circle me-2"></i>
                            Rejeter ce commentaire
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .lead {
        font-size: 1.1rem;
        line-height: 1.6;
    }
    .card-header {
        border-bottom: none;
    }
</style>
@endpush
