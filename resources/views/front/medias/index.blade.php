@extends('front.layouts.app')

@section('title', 'Galerie des médias - Culture Bénin')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5 position-relative">
        <div class="hero-content" style="z-index: 2;">
            <h1 class="fw-bold text-white mb-3" style="font-size: 2.8rem; font-family: 'Playfair Display', serif;">
                Galerie des médias
            </h1>
            <p class="text-light fs-5 opacity-90" style="max-width: 700px; margin: 0 auto;">
                Explorez notre collection d'images, vidéos et audios authentiques
                qui capturent la richesse culturelle du Bénin
            </p>
        </div>
    </div>
</section>
@endsection

@section('content')
<style>
    :root {
        --primary: #1E2B4D;
        --secondary: #E8C676;
        --accent: #A52A2A;
        --light-bg: #f8fafc;
        --border: #e2e8f0;
        --card-shadow: 0 8px 30px rgba(0,0,0,0.08);
        --success: #10b981;
        --info: #3b82f6;
    }

    .gallery-header {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
    }

    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }

    .filter-tab {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        background: var(--light-bg);
        border: 2px solid transparent;
        color: var(--primary);
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-tab:hover,
    .filter-tab.active {
        background: var(--secondary);
        color: var(--primary);
        border-color: var(--secondary);
    }

    .stats-badge {
        background: rgba(232, 198, 118, 0.15);
        color: var(--primary);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .media-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        border: 1px solid var(--border);
        cursor: pointer;
    }

    .media-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        border-color: var(--secondary);
    }

    .media-thumb {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .media-card:hover .media-thumb {
        transform: scale(1.05);
    }

    .media-type {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
    }

    .type-badge {
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .badge-image {
        background: rgba(59, 130, 246, 0.15);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .badge-video {
        background: rgba(239, 68, 68, 0.15);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .badge-audio {
        background: rgba(16, 185, 129, 0.15);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .media-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent 50%);
        opacity: 0;
        transition: opacity 0.4s ease;
        display: flex;
        align-items: flex-end;
        padding: 1.5rem;
    }

    .media-card:hover .media-overlay {
        opacity: 1;
    }

    .media-content {
        padding: 1.5rem;
    }

    .media-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .media-meta {
        color: #64748b;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }

    .media-description {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .media-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .source-link {
        color: var(--accent);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        transition: color 0.3s ease;
    }

    .source-link:hover {
        color: #dc2626;
        text-decoration: underline;
    }

    .media-actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--light-bg);
        color: var(--primary);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: var(--secondary);
        border-color: var(--secondary);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: var(--card-shadow);
        grid-column: 1 / -1;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
    }

    /* Modal styles */
    .media-modal .modal-content {
        border-radius: 20px;
        overflow: hidden;
        border: none;
    }

    .modal-media {
        max-width: 100%;
        max-height: 70vh;
        object-fit: contain;
        margin: 0 auto;
        display: block;
    }

    .modal-header {
        border-bottom: 1px solid var(--border);
        background: var(--light-bg);
    }

    .modal-body {
        padding: 0;
        background: #000;
    }

    .modal-footer {
        border-top: 1px solid var(--border);
        background: var(--light-bg);
    }

    /* Audio player custom */
    .audio-player {
        width: 100%;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: var(--card-shadow);
    }

    .audio-title {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .audio-player audio {
        width: 100%;
        border-radius: 8px;
    }

    /* Video container */
    .video-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        background: #000;
        border-radius: 12px;
        overflow: hidden;
    }

    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .play-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 1;
        transition: opacity 0.3s ease;
    }

    .play-overlay:hover {
        opacity: 1;
    }

    .play-button {
        width: 70px;
        height: 70px;
        background: rgba(232, 198, 118, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .play-button:hover {
        transform: scale(1.1);
        background: var(--secondary);
    }

    @media (max-width: 768px) {
        .gallery-header {
            padding: 1.5rem;
        }

        .media-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        }

        .filter-tabs {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <!-- En-tête de la galerie -->
    <div class="gallery-header">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-2" style="color: var(--primary);">
                    <i class="bi bi-collection-play me-2"></i>
                    Galerie des médias
                </h2>
                <p class="text-muted mb-0">
                    Découvrez notre collection de médias culturels
                </p>
            </div>

            <div class="stats-badge">
                <i class="bi bi-file-earmark-medical"></i>
                {{ $medias->total() }} média{{ $medias->total() > 1 ? 's' : '' }}
            </div>
        </div>

        <!-- Filtres -->
        <div class="filter-tabs">
            <a href="{{ route('front.medias.index') }}"
               class="filter-tab {{ !request('type') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                Tous les médias
            </a>
            <a href="{{ route('front.medias.index', ['type' => 'image']) }}"
               class="filter-tab {{ request('type') == 'image' ? 'active' : '' }}">
                <i class="bi bi-image"></i>
                Images
            </a>
            <a href="{{ route('front.medias.index', ['type' => 'video']) }}"
               class="filter-tab {{ request('type') == 'video' ? 'active' : '' }}">
                <i class="bi bi-camera-video"></i>
                Vidéos
            </a>
            <a href="{{ route('front.medias.index', ['type' => 'audio']) }}"
               class="filter-tab {{ request('type') == 'audio' ? 'active' : '' }}">
                <i class="bi bi-music-note-beamed"></i>
                Audios
            </a>
        </div>
    </div>

    <!-- Grille des médias -->
    @if($medias->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-camera-video-off"></i>
            </div>
            <h3 class="fw-bold mb-3" style="color: var(--primary);">
                Aucun média disponible
            </h3>
            <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                @if(request('type'))
                    Aucun média de type "{{ request('type') }}" n'est disponible pour le moment.
                @else
                    Aucun média n'est disponible pour le moment.
                @endif
            </p>
            @if(request('type'))
            <a href="{{ route('front.medias.index') }}" class="btn"
               style="background: var(--secondary); color: var(--primary); font-weight: 600;">
                <i class="bi bi-arrow-left me-2"></i>
                Voir tous les médias
            </a>
            @endif
        </div>
    @else
        <div class="media-grid" id="mediaGrid">
            @foreach($medias as $media)
            <div class="media-card" data-type="{{ $media->typeMedia->nom }}">
                <!-- Image overlay -->
                <div class="media-overlay">
                    <div class="text-white">
                        <h6 class="fw-bold">{{ $media->titre }}</h6>
                        <small>
                            <i class="bi bi-calendar me-1"></i>
                            {{ $media->created_at->format('d/m/Y') }}
                        </small>
                        <div class="mt-2">
                            <button class="btn btn-sm btn-light"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalMedia{{ $media->id }}">
                                <i class="bi bi-zoom-in me-1"></i>
                                Agrandir
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Type badge -->
                <div class="media-type">
                    <span class="type-badge badge-{{ $media->typeMedia->nom }}">
                        @if($media->typeMedia->nom == 'image')
                            <i class="bi bi-image"></i> Image
                        @elseif($media->typeMedia->nom == 'video')
                            <i class="bi bi-play-circle"></i> Vidéo
                        @else
                            <i class="bi bi-music-note-beamed"></i> Audio
                        @endif
                    </span>
                </div>

                <!-- Media content -->
                @if($media->typeMedia->nom == 'image')
                    <img src="{{ asset('storage/'.$media->fichier) }}"
                         class="media-thumb"
                         alt="{{ $media->titre }}"
                         data-bs-toggle="modal"
                         data-bs-target="#modalMedia{{ $media->id }}">

                @elseif($media->typeMedia->nom == 'video')
                    <div class="video-container">
                        <video preload="metadata" class="media-thumb">
                            <source src="{{ asset('storage/'.$media->fichier) }}" type="video/mp4">
                        </video>
                        <div class="play-overlay"
                             onclick="playVideo(this)">
                            <div class="play-button">
                                <i class="bi bi-play-fill"></i>
                            </div>
                        </div>
                    </div>

                @elseif($media->typeMedia->nom == 'audio')
                    <div class="audio-player">
                        <div class="audio-title">
                            <i class="bi bi-music-note-beamed me-2"></i>
                            {{ Str::limit($media->titre, 40) }}
                        </div>
                        <audio controls>
                            <source src="{{ asset('storage/'.$media->fichier) }}" type="audio/mpeg">
                            Votre navigateur ne supporte pas l'élément audio.
                        </audio>
                    </div>
                @endif

                <div class="media-content">
                    <h3 class="media-title">{{ $media->titre }}</h3>

                    @if($media->description)
                    <p class="media-description">
                        {{ $media->description }}
                    </p>
                    @endif

                    <div class="media-meta">
                        <span class="d-block mb-1">
                            <i class="bi bi-person me-1"></i>
                            {{ $media->contenu->utilisateur->name ?? 'Auteur inconnu' }}
                        </span>
                        @if($media->contenu)
                        <span>
                            <i class="bi bi-book me-1"></i>
                            {{ $media->contenu->titre }}
                        </span>
                        @endif
                    </div>

                    <div class="media-footer">
                        @if($media->contenu)
                        <a href="{{ route('front.contenus.show', $media->contenu->slug) }}"
                           class="source-link">
                            <i class="bi bi-link-45deg"></i>
                            Voir le contenu
                        </a>
                        @endif

                        <div class="media-actions">
                            <button class="action-btn" title="Partager">
                                <i class="bi bi-share"></i>
                            </button>
                            @auth
                            <button class="action-btn" title="Ajouter aux favoris">
                                <i class="bi bi-heart"></i>
                            </button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour chaque média -->
            <div class="modal fade media-modal" id="modalMedia{{ $media->id }}" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">
                                {{ $media->titre }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            @if($media->typeMedia->nom == 'image')
                                <img src="{{ asset('storage/'.$media->fichier) }}"
                                     class="modal-media"
                                     alt="{{ $media->titre }}">
                            @elseif($media->typeMedia->nom == 'video')
                                <video controls class="modal-media">
                                    <source src="{{ asset('storage/'.$media->fichier) }}" type="video/mp4">
                                </video>
                            @else
                                <div class="p-5">
                                    <div class="audio-player">
                                        <div class="mb-3">
                                            <i class="bi bi-music-note-beamed" style="font-size: 3rem; color: var(--secondary);"></i>
                                        </div>
                                        <h5 class="mb-3">{{ $media->titre }}</h5>
                                        <audio controls class="w-100">
                                            <source src="{{ asset('storage/'.$media->fichier) }}" type="audio/mpeg">
                                        </audio>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <div class="row w-100">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        Ajouté le {{ $media->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                                <div class="col-md-6 text-end">
                                    @if($media->contenu)
                                    <a href="{{ route('front.contenus.show', $media->contenu->slug) }}"
                                       class="btn btn-sm"
                                       style="background: var(--secondary); color: var(--primary);">
                                        <i class="bi bi-book me-1"></i>
                                        Voir le contenu associé
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($medias->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $medias->withQueryString()->links() }}
        </div>
        @endif
    @endif
</div>

<script>
    // Animation des cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.media-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';

            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Gestion de la lecture vidéo
        const videos = document.querySelectorAll('video');
        videos.forEach(video => {
            video.addEventListener('play', function() {
                // Pause other videos when one plays
                videos.forEach(otherVideo => {
                    if (otherVideo !== video) {
                        otherVideo.pause();
                    }
                });
            });
        });
    });

    // Fonction pour jouer les vidéos
    function playVideo(element) {
        const videoContainer = element.closest('.video-container');
        const video = videoContainer.querySelector('video');
        const overlay = videoContainer.querySelector('.play-overlay');

        video.play();
        video.controls = true;
        overlay.style.display = 'none';
    }

    // Filter media by type on click
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            // Update active state
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Masonry-like layout
    function adjustGrid() {
        const grid = document.getElementById('mediaGrid');
        if (grid) {
            const items = grid.querySelectorAll('.media-card');
            let maxHeight = 0;

            items.forEach(item => {
                item.style.height = 'auto';
                const height = item.offsetHeight;
                if (height > maxHeight) maxHeight = height;
            });
        }
    }

    // Adjust grid on resize
    window.addEventListener('resize', adjustGrid);

    // Initial adjustment
    setTimeout(adjustGrid, 500);
</script>
@endsection
