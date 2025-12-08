@extends('admin.layouts')

@section('title', 'Détails du média')

@section('content')

<style>
    .detail-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }
    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b);
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }
    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .page-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .btn-back {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-back:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
    }
    .preview-container {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
        border: 3px solid white;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    .preview-large {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        display: block;
        background: rgba(30, 27, 75, 0.02);
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    .info-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border-left: 4px solid #8a2be2;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .info-label {
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-label i {
        color: #8a2be2;
    }
    .info-value {
        font-size: 1.1rem;
        color: #4b5563;
        font-weight: 600;
    }
    .badge-status {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-pending {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: #1e1b4b;
    }
    .status-validated {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    .status-rejected {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }
    .media-description {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid rgba(30, 27, 75, 0.1);
        line-height: 1.7;
        color: #4b5563;
        margin-bottom: 25px;
    }
</style>

<div class="page-header">
    <h1 class="page-title">
        <i class="bi bi-eye"></i>
        Détails du média
    </h1>
    
    <a href="{{ route('admin.medias.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
        Retour à la liste
    </a>
</div>

<div class="detail-card">
    <!-- Prévisualisation -->
    <div class="preview-container">
        @if($media->typeMedia->nom === 'image')
            <img src="{{ asset('storage/'.$media->fichier) }}" 
                 class="preview-large"
                 alt="{{ $media->titre }}">
        @elseif($media->typeMedia->nom === 'video')
            <video class="preview-large" controls>
                <source src="{{ asset('storage/'.$media->fichier) }}">
            </video>
        @else
            <div style="height: 200px; background: linear-gradient(135deg, #8a2be2, #1e1b4b); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-music-note-beamed" style="font-size: 4rem; color: white;"></i>
            </div>
        @endif
    </div>

    <!-- Titre principal -->
    <h2 class="fw-bold mb-3" style="color: #1e1b4b;">
        {{ $media->titre ?? 'Média sans titre' }}
    </h2>

    <!-- Description -->
    @if($media->description)
        <div class="media-description">
            {{ $media->description }}
        </div>
    @endif

    <!-- Informations -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-file-earmark"></i>
                Type
            </div>
            <div class="info-value">{{ ucfirst($media->typeMedia->nom) }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-journal-text"></i>
                Contenu associé
            </div>
            <div class="info-value">{{ $media->contenu->titre }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-toggle-on"></i>
                Statut
            </div>
            <div>
                @if($media->status == 'validated')
                    <span class="badge-status status-validated">
                        <i class="bi bi-check-circle"></i>
                        Validé
                    </span>
                @elseif($media->status == 'pending')
                    <span class="badge-status status-pending">
                        <i class="bi bi-clock"></i>
                        En attente
                    </span>
                @else
                    <span class="badge-status status-rejected">
                        <i class="bi bi-x-circle"></i>
                        Rejeté
                    </span>
                @endif
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-translate"></i>
                Langue
            </div>
            <div class="info-value">{{ $media->langue->nom ?? 'Aucune langue spécifique' }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-person"></i>
                Uploader
            </div>
            <div class="info-value">{{ $media->uploader->name }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-hdd"></i>
                Taille du fichier
            </div>
            <div class="info-value">
                @if($media->taille > 1024)
                    {{ number_format($media->taille / 1024, 1) }} MB
                @else
                    {{ $media->taille }} KB
                @endif
            </div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-filetype-{{ $media->extension }}"></i>
                Extension
            </div>
            <div class="info-value">{{ strtoupper($media->extension) }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-calendar"></i>
                Créé le
            </div>
            <div class="info-value">{{ $media->created_at->format('d/m/Y à H:i') }}</div>
        </div>
    </div>
</div>

@endsection