@extends('admin.layouts')

@section('title', 'Détail du commentaire')

@section('content')

<style>
    .comment-box {
        padding: 35px;
        border-radius: 16px;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }

    .comment-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: linear-gradient(to bottom, #8a2be2, #1e1b4b);
        border-radius: 16px 0 0 16px;
    }

    .label-premium {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .label-premium i {
        color: #8a2be2;
        font-size: 1.2rem;
    }

    .info-content {
        padding: 12px 18px;
        background: rgba(30, 27, 75, 0.03);
        border-radius: 10px;
        border-left: 3px solid #8a2be2;
        margin-top: 5px;
        font-size: 1rem;
        color: #333;
        line-height: 1.6;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-block;
        min-width: 100px;
        text-align: center;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    .statut.approuve {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        color: #155724;
        border: 1px solid #b1dfbb;
    }

    .statut.en_attente {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .statut.rejete {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .stars-container {
        font-size: 1.4rem;
        letter-spacing: 4px;
    }

    .bi-star-fill {
        color: #FFC107;
        text-shadow: 0 2px 4px rgba(255, 193, 7, 0.3);
    }

    .bi-star {
        color: #e0e0e0;
    }

    .section-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(138, 43, 226, 0.2), transparent);
        margin: 30px 0;
    }

    .btn-retour {
        padding: 12px 28px;
        border-radius: 10px;
        background: linear-gradient(135deg, #1e1b4b, #3730a3);
        color: white;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-retour:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(30, 27, 75, 0.2);
        background: linear-gradient(135deg, #3730a3, #4f46e5);
        color: white;
    }

    .header-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-title i {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.2rem;
    }

    .subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 30px;
    }
</style>

<div class="mb-5">
    <h1 class="header-title">
        <i class="bi bi-chat-quote-fill"></i>
        Détail du Commentaire
    </h1>
    <p class="subtitle">Gestion et modération des avis utilisateurs</p>
</div>

<div class="comment-box">
    <div class="row">
        <div class="col-md-6">
            <h5 class="label-premium">
                <i class="bi bi-person-circle"></i>
                Auteur
            </h5>
            <div class="info-content">
                <strong>{{ $commentaire->utilisateur->name }}</strong><br>
                <small class="text-muted">{{ $commentaire->utilisateur->email }}</small>
            </div>
        </div>

        <div class="col-md-6">
            <h5 class="label-premium">
                <i class="bi bi-file-text"></i>
                Contenu concerné
            </h5>
            <div class="info-content">
                {{ $commentaire->contenu->titre }}
            </div>
        </div>
    </div>

    <div class="section-divider"></div>

    <div class="row">
        <div class="col-md-6">
            <h5 class="label-premium">
                <i class="bi bi-star"></i>
                Note attribuée
            </h5>
            <div class="info-content">
                <div class="stars-container">
                    @for($i=1; $i<=5; $i++)
                        <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill' : '' }}"></i>
                    @endfor
                    <span class="ms-3 fw-bold" style="color: #1e1b4b;">{{ $commentaire->note }}/5</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h5 class="label-premium">
                <i class="bi bi-flag"></i>
                Statut
            </h5>
            <div class="info-content">
                <span class="status-badge statut {{ $commentaire->statut }}">
                    {{ ucfirst(str_replace('_', ' ', $commentaire->statut)) }}
                </span>
            </div>
        </div>
    </div>

    <div class="section-divider"></div>

    <div class="mb-4">
        <h5 class="label-premium">
            <i class="bi bi-chat-left-text"></i>
            Commentaire
        </h5>
        <div class="info-content" style="font-style: italic; background: rgba(138, 43, 226, 0.02);">
            "{{ $commentaire->commentaire }}"
        </div>
    </div>

    <div class="section-divider"></div>

    <div class="row">
        <div class="col-md-6">
            <h5 class="label-premium">
                <i class="bi bi-calendar-event"></i>
                Date de création
            </h5>
            <div class="info-content">
                {{ $commentaire->created_at->format('d/m/Y à H:i') }}
            </div>
        </div>

        @if($commentaire->updated_at != $commentaire->created_at)
        <div class="col-md-6">
            <h5 class="label-premium">
                <i class="bi bi-clock-history"></i>
                Dernière modification
            </h5>
            <div class="info-content">
                {{ $commentaire->updated_at->format('d/m/Y à H:i') }}
            </div>
        </div>
        @endif
    </div>

    <div class="section-divider"></div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <a href="{{ route('admin.commentaires.index') }}" class="btn btn-retour">
            <i class="bi bi-arrow-left"></i>
            Retour à la liste
        </a>

        <div class="d-flex gap-3">
            @if($commentaire->statut == 'en_attente')
                <a href="{{ route('admin.commentaires.approve', $commentaire->id) }}"
                   class="btn btn-success"
                   style="padding: 10px 25px; border-radius: 8px; font-weight: 600;">
                    <i class="bi bi-check-circle"></i> Approuver
                </a>
                <a href="{{ route('admin.commentaires.reject', $commentaire->id) }}"
                   class="btn btn-danger"
                   style="padding: 10px 25px; border-radius: 8px; font-weight: 600;">
                    <i class="bi bi-x-circle"></i> Rejeter
                </a>
            @endif
        </div>
    </div>
</div>

@endsection
