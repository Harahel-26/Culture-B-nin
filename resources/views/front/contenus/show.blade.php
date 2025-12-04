<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contenu->titre }} - Culture Bénin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .contenu-media {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .premium-badge {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: #000;
            font-weight: bold;
        }
        .star-rating {
            color: #FFD700;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('front.accueil') }}">← Retour à l'accueil</a>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container py-5">
        <article>
            <!-- En-tête du contenu -->
            <header class="mb-4">
                @if($contenu->is_premium)
                <span class="badge premium-badge mb-2">Contenu Premium</span>
                @endif

                <h1 class="display-5">{{ $contenu->titre }}</h1>

                <div class="text-muted mb-3">
                    <p>
                        Par <strong>{{ $contenu->auteur->name ?? 'Auteur inconnu' }}</strong>
                        | Publié le {{ $contenu->created_at->format('d/m/Y') }}
                        | Langue : {{ $contenu->langue->nom ?? 'Non spécifié' }}
                        | Région : {{ $contenu->region->nom ?? 'Non spécifié' }}
                    </p>
                </div>

                <!-- Image de couverture -->
                @if($contenu->image_couverture)
                <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                     alt="{{ $contenu->titre }}"
                     class="img-fluid rounded mb-4"
                     style="max-height: 400px; object-fit: cover; width: 100%;">
                @endif
            </header>

            <!-- Description -->
            @if($contenu->description)
            <div class="alert alert-info mb-4">
                <h5>Description</h5>
                <p class="mb-0">{{ $contenu->description }}</p>
            </div>
            @endif

            <!-- Contenu texte -->
            <div class="mb-5">
                <h3>Contenu</h3>

                @if($contenu->is_premium && !$canView)
                    <!-- Aperçu gratuit pour contenu premium non acheté -->
                    <div class="card border-warning">
                        <div class="card-body">
                            <p>{{ Str::limit($contenu->contenu_texte, 500) }}</p>

                            <div class="alert alert-warning mt-3">
                                <h5>Contenu Premium</h5>
                                <p>Ce contenu est réservé aux utilisateurs premium.</p>

                                @auth
                                    <a href="{{ route('front.paiement.init', $contenu) }}"
                                       class="btn btn-primary">
                                        Acheter pour {{ number_format($contenu->prix, 0, ',', ' ') }} FCFA
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        Se connecter pour acheter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Contenu complet (gratuit ou premium acheté) -->
                    <div class="card">
                        <div class="card-body">
                            <div class="contenu-texte">
                                {!! nl2br(e($contenu->contenu_texte)) !!}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Galerie média -->
            @if($contenu->medias->count() > 0)
            <div class="mb-5">
                <h3>Galerie multimédia</h3>
                <div class="row">
                    @foreach($contenu->medias as $media)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                @if($media->type_media_id == 1) <!-- Image -->
                                    <img src="{{ asset('storage/' . $media->fichier) }}"
                                         alt="{{ $media->titre }}"
                                         class="contenu-media">
                                @elseif($media->type_media_id == 2) <!-- Vidéo -->
                                    <video controls class="contenu-media">
                                        <source src="{{ asset('storage/' . $media->fichier) }}">
                                        Votre navigateur ne supporte pas la vidéo.
                                    </video>
                                @elseif($media->type_media_id == 3) <!-- Audio -->
                                    <audio controls class="w-100">
                                        <source src="{{ asset('storage/' . $media->fichier) }}">
                                        Votre navigateur ne supporte pas l'audio.
                                    </audio>
                                @endif

                                @if($media->titre)
                                <p class="mt-2 mb-0 text-muted">{{ $media->titre }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Commentaires -->
            <div class="mb-5">
                <h3>Commentaires ({{ $contenu->commentaires->count() }})</h3>

                <!-- Formulaire de commentaire -->
                @auth
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('front.commentaires.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

                            <div class="mb-3">
                                <label class="form-label">Votre commentaire</label>
                                <textarea name="commentaire" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Note (optionnelle)</label>
                                <select name="note" class="form-control">
                                    <option value="">Sans note</option>
                                    <option value="5">★★★★★ Excellent</option>
                                    <option value="4">★★★★☆ Très bien</option>
                                    <option value="3">★★★☆☆ Bien</option>
                                    <option value="2">★★☆☆☆ Moyen</option>
                                    <option value="1">★☆☆☆☆ Pas bien</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Publier le commentaire</button>
                        </form>
                    </div>
                </div>
                @else
                <div class="alert alert-info">
                    <a href="{{ route('login') }}">Connectez-vous</a> pour laisser un commentaire.
                </div>
                @endauth

                <!-- Liste des commentaires -->
<div class="mt-4">
    @forelse($contenu->commentaires as $commentaire)
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <strong>{{ $commentaire->utilisateur->name ?? 'Utilisateur' }}</strong>
                    <small class="text-muted ms-2">
                        {{ $commentaire->created_at->diffForHumans() }}
                    </small>
                </div>

                @if($commentaire->note)
                <div class="star-rating" title="{{ $commentaire->note }}/5">
                    {{ $commentaire->etoiles() }}
                </div>
                @endif
            </div>

            <p class="mt-2 mb-0">{{ $commentaire->commentaire }}</p>

            <!-- Bouton supprimer (seulement pour l'auteur ou admin) -->
            @auth
                @if(auth()->id() == $commentaire->user_id || auth()->user()->hasRole(['admin', 'moderateur']))
                <form action="{{ route('front.commentaires.destroy', $commentaire->id) }}"
                      method="POST"
                      class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        Supprimer
                    </button>
                </form>
                @endif
            @endauth
        </div>
    </div>
    @empty
    <div class="alert alert-light">
        Aucun commentaire pour le moment. Soyez le premier à commenter !
    </div>
    @endforelse
</div>

            <!-- Contenus similaires -->
            @if($contenusSimilaires->count() > 0)
            <div class="mt-5">
                <h3>Contenus similaires</h3>
                <div class="row">
                    @foreach($contenusSimilaires as $similaire)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            @if($similaire->image_couverture)
                            <img src="{{ asset('storage/' . $similaire->image_couverture) }}"
                                 class="card-img-top"
                                 alt="{{ $similaire->titre }}"
                                 style="height: 150px; object-fit: cover;">
                            @endif

                            <div class="card-body">
                                <h6 class="card-title">{{ Str::limit($similaire->titre, 50) }}</h6>
                                <a href="{{ route('front.contenus.show', $similaire->slug) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Voir
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </article>
    </div>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white mt-5">
        <div class="container text-center">
            <p>&copy; 2024 Culture Bénin. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
