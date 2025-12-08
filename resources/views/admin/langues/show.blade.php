@extends('admin.layouts')

@section('title', 'Détails Langue')

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
    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2rem;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 5px;
    }
    .page-subtitle {
        color: #6b7280;
        font-size: 1rem;
        margin-bottom: 25px;
        padding-left: 38px;
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
    .icon-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        border: 2px solid rgba(30, 27, 75, 0.1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .icon-preview {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 10px;
        border: 3px solid white;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        margin-bottom: 15px;
    }
    .description-box {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid rgba(30, 27, 75, 0.1);
        line-height: 1.7;
        color: #4b5563;
    }
    .btn-back {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 12px 24px;
        border-radius: 10px;
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
    .btn-edit {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }
    .btn-edit:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        color: white;
    }
</style>

<div class="mb-4">
    <h1 class="page-title">
        <i class="bi bi-translate"></i>
        Détails de la Langue
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Informations complètes sur : <strong>{{ $langue->nom }}</strong>
    </p>
</div>

<div class="detail-card">
    <!-- Informations principales -->
    <div class="info-grid">
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-fonts"></i>
                Nom
            </div>
            <div class="info-value">{{ $langue->nom }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-code-slash"></i>
                Code ISO
            </div>
            <div class="info-value">{{ $langue->code }}</div>
        </div>
        
        <div class="info-card">
            <div class="info-label">
                <i class="bi bi-toggle-on"></i>
                Statut
            </div>
            <div>
                @if($langue->is_active)
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

    <!-- Icône -->
    <div class="icon-container mb-4">
        <img src="{{ $langue->icone_url }}" 
             class="icon-preview"
             alt="Icône de {{ $langue->nom }}">
        <div class="text-muted">Drapeau / Icône</div>
    </div>

    <!-- Description -->
    <div class="mb-4">
        <div class="info-label mb-3">
            <i class="bi bi-card-text"></i>
            Description
        </div>
        <div class="description-box">
            @if($langue->description)
                {{ $langue->description }}
            @else
                <div class="text-muted fst-italic">
                    <i class="bi bi-info-circle"></i>
                    Aucune description n'a été ajoutée pour cette langue
                </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="d-flex justify-content-between align-items-center pt-4 mt-4 border-top">
        <a href="{{ route('admin.langues.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i>
            Retour à la liste
        </a>
        
        <a href="{{ route('admin.langues.edit', $langue) }}" class="btn-edit">
            <i class="bi bi-pencil"></i>
            Modifier
        </a>
    </div>
</div>

@endsection