@extends('front.layouts.app')

@section('title', 'Mon Profil - Culture Bénin')

@section('content')
<div class="container py-5">
    <!-- En-tête du profil -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <!-- Avatar et infos -->
                        <div class="col-md-3 text-center">
                            <div class="mb-3">
                                @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}"
                                     alt="{{ $user->name }}"
                                     class="rounded-circle shadow"
                                     width="120"
                                     height="120">
                                @else
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                                     style="width: 120px; height: 120px;">
                                    <i class="bi bi-person" style="font-size: 3rem;"></i>
                                </div>
                                @endif
                            </div>
                            <h4 class="mb-1">{{ $user->name }}</h4>
                            <p class="text-muted mb-2">{{ $user->email }}</p>

                            <!-- Rôle -->
                            @php
                                $roles = $user->getRoleNames();
                            @endphp
                            @foreach($roles as $role)
                            <span class="badge bg-primary">{{ ucfirst($role) }}</span>
                            @endforeach
                        </div>

                        <!-- Statistiques -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Contenus</h5>
                                            <h2 class="display-6">{{ $stats['contenus'] }}</h2>
                                            <a href="{{ route('front.profil.contenus') }}" class="text-white small">
                                                Voir mes contenus
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Commentaires</h5>
                                            <h2 class="display-6">{{ $stats['commentaires'] }}</h2>
                                            <a href="{{ route('front.profil.commentaires') }}" class="text-white small">
                                                Voir mes commentaires
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card bg-warning text-dark">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Achats</h5>
                                            <h2 class="display-6">{{ $stats['contenus_achetes'] }}</h2>
                                            <span class="small">Contenus achetés</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <a href="{{ route('front.profil.edit') }}" class="btn btn-primary">
                                    <i class="bi bi-pencil"></i> Modifier mon profil
                                </a>

                                @if(!$user->hasRole(['contributeur', 'admin', 'moderateur']))
                                <a href="{{ route('contributeur.form') }}" class="btn btn-success">
                                    <i class="bi bi-star"></i> Devenir contributeur
                                </a>
                                @endif

                                <a href="{{ route('front.contenus.create') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-plus-circle"></i> Créer un contenu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Derniers contenus créés -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-file-earmark-text"></i> Mes derniers contenus
                    </h5>
                    <a href="{{ route('front.profil.contenus') }}" class="btn btn-light btn-sm">
                        Voir tout
                    </a>
                </div>
                <div class="card-body">
                    @if($derniersContenus->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($derniersContenus as $contenu)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                                           class="text-decoration-none">
                                            {{ $contenu->titre }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        {{ $contenu->created_at->format('d/m/Y') }}
                                        •
                                        @if($contenu->is_premium)
                                        <span class="badge bg-warning">Premium</span>
                                        @else
                                        <span class="badge bg-success">Gratuit</span>
                                        @endif
                                    </small>
                                </div>
                                <span class="badge bg-{{ $contenu->status == 'validated' ? 'success' : ($contenu->status == 'pending' ? 'warning' : 'secondary') }}">
                                    {{ $contenu->status }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="bi bi-file-earmark-text display-6 text-muted"></i>
                        <p class="mt-3">Vous n'avez pas encore créé de contenu</p>
                        <a href="{{ route('front.contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Créer mon premier contenu
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Derniers commentaires -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-chat-text"></i> Mes derniers commentaires
                    </h5>
                    <a href="{{ route('front.profil.commentaires') }}" class="btn btn-light btn-sm">
                        Voir tout
                    </a>
                </div>
                <div class="card-body">
                    @if($derniersCommentaires->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($derniersCommentaires as $commentaire)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('front.contenus.show', $commentaire->contenu->slug) }}#comment-{{ $commentaire->id }}"
                                           class="text-decoration-none">
                                            {{ Str::limit($commentaire->commentaire, 60) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">
                                        Sur : {{ $commentaire->contenu->titre }}
                                        <br>
                                        {{ $commentaire->created_at->format('d/m/Y H:i') }}
                                        @if($commentaire->note)
                                        • Note :
                                        <span class="text-warning">
                                            {{ str_repeat('★', $commentaire->note) }}{{ str_repeat('☆', 5 - $commentaire->note) }}
                                        </span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="bi bi-chat-text display-6 text-muted"></i>
                        <p class="mt-3">Vous n'avez pas encore commenté de contenu</p>
                        <a href="{{ route('front.contenus.index') }}" class="btn btn-success">
                            <i class="bi bi-search"></i> Explorer les contenus
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Derniers achats -->
    @if($derniersAchats->count() > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-cart-check"></i> Mes derniers achats
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($derniersAchats as $contenu)
                        <div class="col-md-3 mb-3">
                            <div class="card h-100">
                                @if($contenu->image_couverture)
                                <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                                     class="card-img-top"
                                     alt="{{ $contenu->titre }}"
                                     style="height: 100px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($contenu->titre, 40) }}</h6>
                                    <a href="{{ route('front.contenus.show', $contenu->slug) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Consulter
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Informations du compte -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle"></i> Informations du compte
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Nom complet :</span>
                            <strong>{{ $user->name }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Email :</span>
                            <strong>{{ $user->email }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Téléphone :</span>
                            <strong>{{ $user->phone ?? 'Non renseigné' }}</strong>
                        </div>
                        <div class="list-group-item d-flex justify-content-between">
                            <span>Membre depuis :</span>
                            <strong>{{ $user->created_at->format('d/m/Y') }}</strong>
                        </div>
                        <div class="list-group-item">
                            <span>Bio :</span>
                            <p class="mt-2">{{ $user->bio ?? 'Aucune bio renseignée' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-shield-check"></i> Sécurité du compte
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="bi bi-check-circle"></i> Votre compte est actif
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Dernière connexion :</span>
                                <strong>
                                    @if($user->last_login_at)
                                    {{ $user->last_login_at->format('d/m/Y H:i') }}
                                    @else
                                    Jamais
                                    @endif
                                </strong>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Statut du compte :</span>
                                @if($user->is_active)
                                <span class="badge bg-success">Actif</span>
                                @else
                                <span class="badge bg-danger">Désactivé</span>
                                @endif
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Email vérifié :</span>
                                @if($user->email_verified_at)
                                <span class="badge bg-success">Oui</span>
                                @else
                                <span class="badge bg-warning">Non</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('password.request') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-key"></i> Changer mon mot de passe
                        </a>
                    </div>
                </div>
            </div>
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
    .list-group-item {
        border-left: none;
        border-right: none;
    }
    .list-group-item:first-child {
        border-top: none;
    }
    .list-group-item:last-child {
        border-bottom: none;
    }
</style>
@endpush
