@extends('admin.layouts')

@section('title', 'Détails Région')

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
    .badge-active {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    .badge-inactive {
        background: linear-gradient(135deg, #ef4444, #f87171);
        color: white;
    }
    .description-box {
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
        <i class="bi bi-geo-alt"></i>
        Détails de la Région
    </h1>
    
    <a href="{{ route('admin.regions.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
        Retour à la liste
    </a>
</div>

<div class="detail-card">
    <!-- Titre principal -->
    <h2 class="fw-bold mb-4" style="color: #1e1b4b; font-size: 2.2rem;">
        {{ $region->nom }}
    </h2>

    <!-- Informations -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-tag"></i>
                Type
            </div>
            <div class="info-value">{{ $region->type ?? 'Non spécifié' }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-translate"></i>
                Langue principale
            </div>
            <div class="info-value">{{ $region->languePrincipale->nom ?? 'Aucune langue spécifique' }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-toggle-on"></i>
                Statut
            </div>
            <div>
                @if($region->is_active)
                    <span class="badge-status badge-active">
                        <i class="bi bi-check-circle"></i>
                        Active
                    </span>
                @else
                    <span class="badge-status badge-inactive">
                        <i class="bi bi-x-circle"></i>
                        Inactive
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="mb-4">
        <div class="info-label mb-3">
            <i class="bi bi-card-text"></i>
            Description
        </div>
        <div class="description-box">
            @if($region->description)
                {{ $region->description }}
            @else
                <div class="text-muted fst-italic">
                    <i class="bi bi-info-circle"></i>
                    Aucune description disponible pour cette région
                </div>
            @endif
        </div>
    </div>

    <!-- Informations supplémentaires -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-calendar"></i>
                Créé le
            </div>
            <div class="info-value">{{ $region->created_at->format('d/m/Y') }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-arrow-clockwise"></i>
                Dernière modification
            </div>
            <div class="info-value">{{ $region->updated_at->format('d/m/Y') }}</div>
        </div>
    </div>
</div>

@endsection