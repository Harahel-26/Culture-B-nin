@extends('front.layouts.app')

@section('title', $contenu->titre . ' - Culture Bénin')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5 position-relative">
        <div class="hero-content" style="z-index: 2;">
            <div class="mb-3">
                <span class="badge
                    @if($contenu->status == 'validated') bg-success
                    @elseif($contenu->status == 'pending') bg-warning
                    @elseif($contenu->status == 'rejected') bg-danger
                    @else bg-secondary @endif
                    py-2 px-3 me-2">
                    @if($contenu->status == 'validated')
                        <i class="bi bi-check-circle me-1"></i> Publié
                    @elseif($contenu->status == 'pending')
                        <i class="bi bi-clock-history me-1"></i> En attente
                    @elseif($contenu->status == 'rejected')
                        <i class="bi bi-x-circle me-1"></i> Rejeté
                    @endif
                </span>

                @if($contenu->is_premium)
                <span class="badge bg-gradient-premium py-2 px-3">
                    <i class="bi bi-star-fill me-1"></i> Premium
                </span>
                @endif
            </div>

            <h1 class="fw-bold text-white mb-3" style="font-size: 2.8rem; font-family: 'Playfair Display', serif;">
                {{ $contenu->titre }}
            </h1>

            <p class="text-light fs-5 opacity-90" style="max-width: 700px; margin: 0 auto;">
                {{ $contenu->description }}
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
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --light-bg: #f8fafc;
        --border: #e2e8f0;
        --card-shadow: 0 8px 30px rgba(0,0,0,0.08);
        --text-primary: #1e293b;
    }

    .content-container {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        margin-top: -40px;
        position: relative;
        z-index: 10;
        border: 1px solid var(--border);
    }

    .content-header {
        padding: 2.5rem;
        background: linear-gradient(135deg, rgba(30, 43, 77, 0.03), transparent);
        border-bottom: 1px solid var(--border);
    }

    .meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin: 1.5rem 0;
        padding: 1rem 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        font-weight: 500;
    }

    .meta-item i {
        color: var(--secondary);
        font-size: 1.1rem;
    }

    .content-body {
        padding: 2.5rem;
        line-height: 1.8;
        color: var(--text-primary);
    }

    .content-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 12px;
        margin: 2rem 0;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .content-text {
        font-size: 1.125rem;
        line-height: 1.9;
        color: var(--text-primary);
    }

    .content-text h2,
    .content-text h3,
    .content-text h4 {
        color: var(--primary);
        margin-top: 2.5rem;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .content-text h2 {
        font-size: 1.8rem;
        border-bottom: 2px solid rgba(232, 198, 118, 0.3);
        padding-bottom: 0.5rem;
    }

    .content-text h3 {
        font-size: 1.5rem;
    }

    .content-text p {
        margin-bottom: 1.5rem;
        text-align: justify;
    }

    .content-text ul,
    .content-text ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .content-text li {
        margin-bottom: 0.5rem;
    }

    .content-text blockquote {
        border-left: 4px solid var(--secondary);
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        color: #475569;
        background: rgba(232, 198, 118, 0.05);
        padding: 1.5rem;
        border-radius: 0 8px 8px 0;
    }

    .content-text strong {
        color: var(--primary);
        font-weight: 700;
    }

    .content-text em {
        color: #64748b;
    }

    .content-footer {
        padding: 2rem 2.5rem;
        background: var(--light-bg);
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .author-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1.2rem;
    }

    .author-details h5 {
        margin: 0;
        color: var(--primary);
        font-weight: 600;
    }

    .author-details small {
        color: #64748b;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        text-decoration: none;
        border: 2px solid transparent;
    }

    .btn-back {
        background: var(--light-bg);
        color: var(--primary);
        border-color: var(--border);
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: var(--primary);
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--secondary), #f5c842);
        color: var(--primary);
        border: none;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(232, 198, 118, 0.3);
        color: var(--primary);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
        border-color: rgba(239, 68, 68, 0.2);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: white;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin: 2rem 0;
        padding: 1.5rem;
        background: var(--light-bg);
        border-radius: 12px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .tag-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin: 1.5rem 0;
    }

    .tag {
        background: rgba(30, 43, 77, 0.08);
        color: var(--primary);
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .tag:hover {
        background: var(--secondary);
        color: var(--primary);
    }

    .bg-gradient-premium {
        background: linear-gradient(135deg, var(--secondary), #f5c842);
        color: var(--primary);
    }

    @media (max-width: 768px) {
        .content-container {
            margin-top: -20px;
            border-radius: 16px;
        }

        .content-header,
        .content-body,
        .content-footer {
            padding: 1.5rem;
        }

        .meta-info {
            gap: 1rem;
            flex-direction: column;
        }

        .content-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .action-buttons {
            justify-content: center;
        }
    }
</style>

<div class="container">
    <div class="content-container">
        <!-- En-tête du contenu -->
        <div class="content-header">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-start gap-3 mb-3">
                <div>
                    <h1 class="fw-bold mb-3" style="color: var(--primary); font-size: 2.2rem;">
                        {{ $contenu->titre }}
                    </h1>

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge
                            @if($contenu->status == 'validated') bg-success
                            @elseif($contenu->status == 'pending') bg-warning
                            @elseif($contenu->status == 'rejected') bg-danger
                            @else bg-secondary @endif
                            py-2 px-3">
                            @if($contenu->status == 'validated')
                                <i class="bi bi-check-circle me-1"></i> Publié
                            @elseif($contenu->status == 'pending')
                                <i class="bi bi-clock-history me-1"></i> En attente
                            @elseif($contenu->status == 'rejected')
                                <i class="bi bi-x-circle me-1"></i> Rejeté
                            @endif
                        </span>

                        @if($contenu->is_premium)
                        <span class="badge bg-gradient-premium py-2 px-3">
                            <i class="bi bi-star-fill me-1"></i> Contenu Premium
                        </span>
                        @endif
                    </div>
                </div>

                <div class="text-md-end">
                    <div class="text-muted small">
                        Créé le {{ $contenu->created_at->format('d/m/Y') }}
                    </div>
                    <div class="text-muted small">
                        Dernière modification : {{ $contenu->updated_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
            </div>

            <!-- Métadonnées -->
            <div class="meta-info">
                <div class="meta-item">
                    <i class="bi bi-translate"></i>
                    <span>{{ $contenu->langue->nom }} ({{ $contenu->langue->code }})</span>
                </div>

                <div class="meta-item">
                    <i class="bi bi-tag"></i>
                    <span>{{ $contenu->typecontenu->nom }}</span>
                </div>

                @if($contenu->region)
                <div class="meta-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>{{ $contenu->region->nom }}</span>
                </div>
                @endif
            </div>

            <!-- Description -->
            @if($contenu->description)
            <div class="alert alert-light border mt-3" style="background: rgba(232, 198, 118, 0.05);">
                <div class="d-flex align-items-start gap-2">
                    <i class="bi bi-chat-square-text mt-1" style="color: var(--secondary);"></i>
                    <div>
                        <h5 class="fw-bold mb-2">À propos de ce contenu</h5>
                        <p class="mb-0">{{ $contenu->description }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Corps du contenu -->
        <div class="content-body">
            <!-- Image de couverture -->
            @if($contenu->image_couverture)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
                     class="content-image"
                     alt="{{ $contenu->titre }}">
                @if($contenu->image_legend)
                <div class="text-center text-muted small mt-2">
                    <i class="bi bi-info-circle me-1"></i>
                    {{ $contenu->image_legend }}
                </div>
                @endif
            </div>
            @endif

            <!-- Tags -->
            @if($contenu->tags)
            <div class="tag-container">
                @foreach(explode(',', $contenu->tags) as $tag)
                @if(trim($tag))
                <span class="tag">#{{ trim($tag) }}</span>
                @endif
                @endforeach
            </div>
            @endif

            <!-- Contenu texte -->
            <div class="content-text">
                {!! $contenu->contenu_texte !!}
            </div>

            <!-- Statistiques (si disponibles) -->
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-number">{{ $contenu->vues ?? 0 }}</div>
                    <div class="stat-label">Vues</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $contenu->favoris_count ?? 0 }}</div>
                    <div class="stat-label">Favoris</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $contenu->commentaires_count ?? 0 }}</div>
                    <div class="stat-label">Commentaires</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $contenu->medias_count ?? 0 }}</div>
                    <div class="stat-label">Médias</div>
                </div>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="content-footer">
            <div class="author-info">
                <div class="author-avatar">
                    {{ strtoupper(substr($contenu->utilisateur->name, 0, 1)) }}
                </div>
                <div class="author-details">
                    <h5>{{ $contenu->utilisateur->name }}</h5>
                    <small>Contributeur</small>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('contributeur.contenus.index') }}"
                   class="btn-action btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Retour à la liste
                </a>

                <a href="{{ route('contributeur.contenus.edit', $contenu) }}"
                   class="btn-action btn-edit">
                    <i class="bi bi-pencil"></i>
                    Modifier
                </a>

                <form action="{{ route('contributeur.contenus.destroy', $contenu) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-action btn-delete">
                        <i class="bi bi-trash"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

   
    <!-- Section de navigation améliorée -->
<div class="row mt-4 g-4">
    @php
        // Récupérer les contenus précédent et suivant de l'utilisateur
        $previous = App\Models\Contenu::where('user_id', auth()->id())
            ->where('created_at', '<', $contenu->created_at)
            ->orderBy('created_at', 'desc')
            ->first();

        $next = App\Models\Contenu::where('user_id', auth()->id())
            ->where('created_at', '>', $contenu->created_at)
            ->orderBy('created_at', 'asc')
            ->first();
    @endphp

    @if($previous)
    <div class="col-md-6">
        <a href="{{ route('contributeur.contenus.show', $previous) }}"
           class="card h-100 text-decoration-none border shadow-sm hover-lift">
            <div class="card-body d-flex align-items-center">
                <i class="bi bi-arrow-left-circle me-3" style="font-size: 1.5rem; color: var(--secondary);"></i>
                <div>
                    <div class="text-muted small">Contenu précédent</div>
                    <div class="fw-bold text-dark text-truncate">{{ $previous->titre }}</div>
                    <small class="text-muted">
                        {{ $previous->created_at->format('d/m/Y') }}
                    </small>
                </div>
            </div>
        </a>
    </div>
    @else
    <div class="col-md-6">
        <div class="card h-100 border" style="background: var(--light-bg);">
            <div class="card-body d-flex align-items-center text-muted">
                <i class="bi bi-arrow-left-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <div class="small">Contenu précédent</div>
                    <div class="fw-bold">Aucun contenu précédent</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($next)
    <div class="col-md-6">
        <a href="{{ route('contributeur.contenus.show', $next) }}"
           class="card h-100 text-decoration-none border shadow-sm hover-lift">
            <div class="card-body d-flex align-items-center">
                <div class="text-end flex-grow-1">
                    <div class="text-muted small">Contenu suivant</div>
                    <div class="fw-bold text-dark text-truncate">{{ $next->titre }}</div>
                    <small class="text-muted">
                        {{ $next->created_at->format('d/m/Y') }}
                    </small>
                </div>
                <i class="bi bi-arrow-right-circle ms-3" style="font-size: 1.5rem; color: var(--secondary);"></i>
            </div>
        </a>
    </div>
    @else
    <div class="col-md-6">
        <div class="card h-100 border" style="background: var(--light-bg);">
            <div class="card-body d-flex align-items-center justify-content-end text-muted">
                <div class="text-end">
                    <div class="small">Contenu suivant</div>
                    <div class="fw-bold">Aucun contenu suivant</div>
                </div>
                <i class="bi bi-arrow-right-circle ms-3" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>
    @endif
</div>
</div>

<script>
    // Animation pour les images
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('.content-image');
        images.forEach(img => {
            img.style.opacity = '0';
            img.style.transform = 'scale(0.95)';

            setTimeout(() => {
                img.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                img.style.opacity = '1';
                img.style.transform = 'scale(1)';
            }, 300);
        });

        // Amélioration de la lisibilité des liens dans le contenu
        const contentText = document.querySelector('.content-text');
        if (contentText) {
            const links = contentText.querySelectorAll('a');
            links.forEach(link => {
                link.classList.add('text-decoration-underline');
                link.style.color = 'var(--accent)';
                link.style.fontWeight = '500';
            });
        }

        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId !== '#') {
                    e.preventDefault();
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });

    // Confirmation avant suppression
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (this.querySelector('button[type="submit"]').classList.contains('btn-delete')) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endsection
