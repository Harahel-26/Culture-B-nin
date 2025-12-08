@extends('admin.layouts')

@section('title', 'Modifier une Langue')

@section('content')

<style>
    .form-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 8px 30px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }
    .form-card::before {
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
    .form-label {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-label i {
        color: #8a2be2;
        font-size: 1.1rem;
    }
    .form-control-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }
    .form-control-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }
    .form-control-enhanced.is-invalid {
        border-color: #ef4444;
    }
    .error-message {
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .icon-container {
        border: 2px dashed rgba(30, 27, 75, 0.2);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: rgba(30, 27, 75, 0.01);
        margin-top: 10px;
    }
    .icon-current {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 10px;
        border: 2px solid white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        margin-bottom: 15px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .switch-container {
        background: rgba(30, 27, 75, 0.03);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(30, 27, 75, 0.1);
    }
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        background-color: #e0e0e0;
        border-color: #e0e0e0;
    }
    .form-switch .form-check-input:checked {
        background-color: #8a2be2;
        border-color: #8a2be2;
    }
    .btn-update {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .btn-update:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-2px);
        color: white;
    }
    .btn-cancel {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-cancel:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
    }
</style>

<div class="mb-4">
    <h1 class="page-title">
        <i class="bi bi-translate"></i>
        Modifier la Langue
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-pencil-square"></i>
        Édition de : <strong>{{ $langue->nom }}</strong>
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.langues.update', $langue) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">

            <!-- Nom -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-fonts"></i>
                    Nom *
                </label>
                <input type="text" 
                       name="nom"
                       class="form-control-enhanced @error('nom') is-invalid @enderror"
                       value="{{ old('nom', $langue->nom) }}"
                       placeholder="Nom de la langue">
                @error('nom')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Code -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-code-slash"></i>
                    Code *
                </label>
                <input type="text" 
                       name="code"
                       class="form-control-enhanced @error('code') is-invalid @enderror"
                       value="{{ old('code', $langue->code) }}"
                       placeholder="Code ISO">
                @error('code')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">
                    <i class="bi bi-card-text"></i>
                    Description
                </label>
                <textarea name="description" 
                          rows="3"
                          class="form-control-enhanced"
                          placeholder="Description de la langue...">{{ old('description', $langue->description) }}</textarea>
            </div>

            <!-- Icône -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-flag"></i>
                    Drapeau / Icône
                </label>
                <div class="icon-container">
                    <img src="{{ $langue->icone_url }}" 
                         class="icon-current"
                         alt="Icône actuelle">
                    <div class="text-muted mb-3">Icône actuelle</div>
                    <input type="file" 
                           name="icone" 
                           class="form-control-enhanced"
                           accept="image/*">
                </div>
            </div>

            <!-- Statut -->
            <div class="col-md-6">
                <div class="switch-container h-100">
                    <label class="form-label mb-3">
                        <i class="bi bi-toggle-on"></i>
                        Statut
                    </label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" 
                               type="checkbox"
                               name="is_active"
                               id="activeSwitch"
                               {{ old('is_active', $langue->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label fw-medium" for="activeSwitch">
                            Langue active
                        </label>
                    </div>
                    <p class="text-muted mt-3 mb-0 small">
                        <i class="bi bi-info-circle"></i>
                        Les langues inactives ne seront pas disponibles pour les contenus
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="col-12 mt-4 pt-3 border-top">
                <button type="submit" class="btn-update">
                    <i class="bi bi-save"></i>
                    Mettre à jour
                </button>

                <a href="{{ route('admin.langues.index') }}" class="btn-cancel ms-3">
                    Annuler
                </a>
            </div>

        </div>
    </form>
</div>

@endsection