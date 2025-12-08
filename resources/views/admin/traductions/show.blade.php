@extends('admin.layouts')

@section('title', 'Détails de la traduction')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-light: #f8f9fa;
        --admin-dark: #0f172a;
        --admin-gray: #64748b;
    }

    .translation-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(30, 27, 75, 0.1);
        border: 1px solid rgba(138, 43, 226, 0.1);
        position: relative;
        overflow: hidden;
    }

    .translation-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--admin-secondary), var(--admin-accent));
    }

    .card-header {
        background: none;
        border-bottom: 2px solid rgba(138, 43, 226, 0.1);
        padding-bottom: 20px;
        margin-bottom: 25px;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--admin-primary);
        font-size: 1.8rem;
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 0;
    }

    .translation-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        color: var(--admin-primary);
        font-size: 1.5rem;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(138, 43, 226, 0.1);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        background: rgba(138, 43, 226, 0.03);
        border-radius: 12px;
        padding: 20px;
        border: 1px solid rgba(138, 43, 226, 0.1);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border-color: rgba(138, 43, 226, 0.2);
    }

    .info-label {
        font-weight: 600;
        color: var(--admin-dark);
        margin-bottom: 8px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label i {
        color: var(--admin-secondary);
        width: 20px;
        text-align: center;
    }

    .info-value {
        color: var(--admin-dark);
        font-size: 1rem;
        line-height: 1.6;
    }

    .content-section {
        background: var(--admin-light);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        border: 1px solid #e2e8f0;
    }

    .section-title {
        font-weight: 600;
        color: var(--admin-primary);
        font-size: 1.2rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(138, 43, 226, 0.1);
    }

    .section-title i {
        color: var(--admin-secondary);
    }

    .content-text {
        color: var(--admin-dark);
        line-height: 1.8;
        font-size: 1.05rem;
        white-space: pre-line;
    }

    .content-text p {
        margin-bottom: 1rem;
    }

    .content-text p:last-child {
        margin-bottom: 0;
    }

    .badge-status {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background: linear-gradient(135deg, var(--admin-warning), #d97706);
        color: white;
    }

    .badge-validated {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .badge-rejected {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(138, 43, 226, 0.2);
        margin-right: 10px;
        vertical-align: middle;
    }

    .user-link {
        color: var(--admin-secondary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .user-link:hover {
        color: var(--admin-accent);
        text-decoration: underline;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid rgba(138, 43, 226, 0.1);
    }

    .btn-back {
        background: white;
        color: var(--admin-gray);
        border: 2px solid #e2e8f0;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: var(--admin-light);
        border-color: var(--admin-secondary);
        color: var(--admin-dark);
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--admin-warning), #d97706);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #d97706, #b45309);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    }

    .btn-validate {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-validate:hover {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-reject {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-reject:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
    }

    .btn-action-form {
        border: none;
        background: none;
        padding: 0;
    }

    .original-content {
        background: rgba(138, 43, 226, 0.05);
        border-left: 4px solid var(--admin-secondary);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
    }

    .original-content h5 {
        color: var(--admin-secondary);
        margin-bottom: 10px;
        font-weight: 600;
    }

    .original-content a {
        color: var(--admin-secondary);
        text-decoration: none;
        font-weight: 500;
    }

    .original-content a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .translation-card {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .translation-title {
            font-size: 1.3rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-back,
        .btn-edit,
        .btn-validate,
        .btn-reject {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="translation-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-translate"></i>
            Détails de la traduction
        </h3>
    </div>

    <div class="card-body">
        <!-- Titre de la traduction -->
        <h4 class="translation-title">
            {{ $traduction->titre ?? '— (titre traduit indisponible)' }}
        </h4>

        <!-- Contenu original -->
        <div class="original-content">
            <h5>
                <i class="bi bi-file-earmark-text me-2"></i>
                Contenu original
            </h5>
            <p class="mb-2">
                <strong>Titre :</strong>
                <a href="{{ route('admin.contenus.show', $traduction->contenu) }}">
                    {{ $traduction->contenu->titre }}
                </a>
            </p>
            <p class="mb-0">
                <strong>Auteur :</strong>
                @if($traduction->contenu->auteur)
                    <span>{{ $traduction->contenu->auteur }}</span>
                @else
                    <span class="text-muted">Non spécifié</span>
                @endif
            </p>
        </div>

        <!-- Informations générales -->
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-globe"></i>
                    Langue cible
                </div>
                <div class="info-value">
                    {{ $traduction->langue->nom }}
                    <span class="text-muted small d-block mt-1">
                        ({{ $traduction->langue->code }})
                    </span>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-person"></i>
                    Traducteur
                </div>
                <div class="info-value">
                    @if($traduction->traducteur->avatar_url)
                        <img src="{{ $traduction->traducteur->avatar_url }}"
                             class="user-avatar"
                             alt="{{ $traduction->traducteur->name }}">
                    @endif
                    <a href="{{ route('admin.users.show', $traduction->traducteur) }}"
                       class="user-link">
                        {{ $traduction->traducteur->name }}
                    </a>
                    <div class="text-muted small mt-1">
                        {{ $traduction->traducteur->email }}
                    </div>
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-shield-check"></i>
                    Status
                </div>
                <div class="info-value">
                    @if($traduction->status == 'pending')
                        <span class="badge-status badge-pending">
                            <i class="bi bi-clock me-1"></i>
                            En attente
                        </span>
                    @elseif($traduction->status == 'validated')
                        <span class="badge-status badge-validated">
                            <i class="bi bi-check-circle me-1"></i>
                            Validée
                        </span>
                    @else
                        <span class="badge-status badge-rejected">
                            <i class="bi bi-x-circle me-1"></i>
                            Rejetée
                        </span>
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-calendar"></i>
                    Date de création
                </div>
                <div class="info-value">
                    {{ $traduction->created_at->format('d/m/Y à H:i') }}
                    <div class="text-muted small mt-1">
                        {{ $traduction->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>

            @if($traduction->validateur)
            <div class="info-item">
                <div class="info-label">
                    <i class="bi bi-person-check"></i>
                    Validé par
                </div>
                <div class="info-value">
                    @if($traduction->validateur->avatar_url)
                        <img src="{{ $traduction->validateur->avatar_url }}"
                             class="user-avatar"
                             alt="{{ $traduction->validateur->name }}">
                    @endif
                    <a href="{{ route('admin.users.show', $traduction->validateur) }}"
                       class="user-link">
                        {{ $traduction->validateur->name }}
                    </a>
                    @if($traduction->updated_at)
                    <div class="text-muted small mt-1">
                        Le {{ $traduction->updated_at->format('d/m/Y') }}
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Description traduite -->
        @if($traduction->description)
        <div class="content-section">
            <h5 class="section-title">
                <i class="bi bi-card-text"></i>
                Description traduite
            </h5>
            <div class="content-text">
                {{ $traduction->description }}
            </div>
        </div>
        @endif

        <!-- Contenu texte traduit -->
        @if($traduction->contenu_texte)
        <div class="content-section">
            <h5 class="section-title">
                <i class="bi bi-text-paragraph"></i>
                Texte traduit
            </h5>
            <div class="content-text">
                {!! nl2br(e($traduction->contenu_texte)) !!}
            </div>
        </div>
        @endif

        <!-- Actions -->
        <div class="action-buttons">
            <!-- Bouton retour -->
            <a href="{{ route('admin.traductions.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Retour aux traductions
            </a>

            <!-- Bouton modifier (uniquement si c'est le traducteur) -->
            @if($traduction->traduit_par == auth()->id())
                <a href="{{ route('admin.traductions.edit', $traduction) }}"
                   class="btn-edit">
                    <i class="bi bi-pencil"></i>
                    Modifier
                </a>
            @endif

            <!-- Bouton valider (admin/modérateur seulement) -->
            @if(auth()->user()->hasRole(['admin','moderateur']) && $traduction->status != 'validated')
                <form action="{{ route('admin.traductions.valider', $traduction) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir valider cette traduction ?')">
                    @csrf @method('PUT')
                    <button type="submit" class="btn-validate">
                        <i class="bi bi-check-circle"></i>
                        Valider
                    </button>
                </form>
            @endif

            <!-- Bouton rejeter (admin/modérateur seulement) -->
            @if(auth()->user()->hasRole(['admin','moderateur']) && $traduction->status != 'rejected')
                <form action="{{ route('admin.traductions.rejeter', $traduction) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir rejeter cette traduction ? Cette action ne peut pas être annulée.')">
                    @csrf @method('PUT')
                    <button type="submit" class="btn-reject">
                        <i class="bi bi-x-circle"></i>
                        Rejeter
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>

<script>
    // Animation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.info-item, .content-section');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
            element.classList.add('animate__animated', 'animate__fadeInUp');
        });
    });
</script>

@endsection
