@extends('front.layouts.app')

@section('title', 'Mes commentaires - Culture Bénin')

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
                                <i class="bi bi-chat-text text-success"></i> Mes commentaires
                            </h1>
                            <p class="text-muted mb-0">
                                Tous les commentaires que vous avez publiés
                            </p>
                        </div>
                        <a href="{{ route('front.contenus.index') }}" class="btn btn-success">
                            <i class="bi bi-search"></i> Explorer les contenus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Total</h5>
                    <h2 class="display-6">{{ $commentaires->total() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5 class="card-title">Validés</h5>
                    <h2 class="display-6">{{ $user->commentaires()->where('statut', 'validated')->count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h5 class="card-title">En attente</h5>
                    <h2 class="display-6">{{ $user->commentaires()->where('statut', 'pending')->count() }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des commentaires -->
    <div class="card">
        <div class="card-body">
            @if($commentaires->count() > 0)
            <div class="list-group list-group-flush">
                @foreach($commentaires as $commentaire)
                <div class="list-group-item">
                    <div class="row">
                        <!-- Contenu concerné -->
                        <div class="col-md-3">
                            <div class="mb-2">
                                <strong>Contenu :</strong>
                            </div>
                            <a href="{{ route('front.contenus.show', $commentaire->contenu->slug) }}"
                               class="text-decoration-none">
                                <h6 class="mb-1">{{ $commentaire->contenu->titre }}</h6>
                            </a>
                            <small class="text-muted">
                                {{ $commentaire->contenu->typecontenu->nom ?? 'N/A' }}
                            </small>
                        </div>

                        <!-- Commentaire -->
                        <div class="col-md-5">
                            <div class="mb-2">
                                <strong>Commentaire :</strong>
                            </div>
                            <p class="mb-1">{{ $commentaire->commentaire }}</p>
                            <small class="text-muted">
                                {{ $commentaire->created_at->format('d/m/Y à H:i') }}
                            </small>
                        </div>

                        <!-- Statut et note -->
                        <div class="col-md-2">
                            <div class="mb-2">
                                <strong>Statut :</strong>
                            </div>
                            @if($commentaire->statut == 'validated')
                            <span class="badge bg-success">Validé</span>
                            @elseif($commentaire->statut == 'pending')
                            <span class="badge bg-warning">En attente</span>
                            @else
                            <span class="badge bg-danger">Rejeté</span>
                            @endif

                            @if($commentaire->note)
                            <div class="mt-2">
                                <strong>Note :</strong><br>
                                <span class="text-warning">
                                    {{ str_repeat('★', $commentaire->note) }}{{ str_repeat('☆', 5 - $commentaire->note) }}
                                </span>
                            </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="col-md-2">
                            <div class="mb-2">
                                <strong>Actions :</strong>
                            </div>
                            <div class="btn-group-vertical" role="group">
                                <a href="{{ route('front.contenus.show', $commentaire->contenu->slug) }}#comment-{{ $commentaire->id }}"
                                   class="btn btn-sm btn-info mb-1"
                                   target="_blank">
                                    <i class="bi bi-eye"></i> Voir
                                </a>

                                @if($commentaire->statut == 'pending')
                                <form action="{{ route('front.commentaires.destroy', $commentaire) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger w-100"
                                            onclick="return confirm('Supprimer ce commentaire ?')">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $commentaires->appends(request()->except('page'))->links() }}
            </div>
            @else
            <!-- Aucun commentaire -->
            <div class="text-center py-5">
                <i class="bi bi-chat-text display-1 text-muted"></i>
                <h3 class="mt-3">Aucun commentaire</h3>
                <p class="text-muted mb-4">
                    Vous n'avez pas encore commenté de contenu.
                </p>
                <a href="{{ route('front.contenus.index') }}" class="btn btn-success">
                    <i class="bi bi-search"></i> Explorer les contenus
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
