@extends('admin.layouts')

@section('title', 'Nouvelle Région')

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
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-label i {
        color: #8a2be2;
    }
    .form-control-enhanced, .form-select-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }
    .form-control-enhanced:focus, .form-select-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }
    .switch-container {
        background: rgba(30, 27, 75, 0.03);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(30, 27, 75, 0.1);
    }
    .btn-save {
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
    .btn-save:hover {
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
        <i class="bi bi-plus-circle"></i>
        Ajouter une Région
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Créez une nouvelle région du Bénin avec ses caractéristiques
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.regions.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            <!-- Nom -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-fonts"></i>
                    Nom *
                </label>
                <input type="text"
                       name="nom"
                       class="form-control-enhanced"
                       value="{{ old('nom') }}"
                       placeholder="Ex: Atlantique, Borgou, Donga..."
                       required>
            </div>

            <!-- Type -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-tag"></i>
                    Type
                </label>
                <select name="type" class="form-select-enhanced">
                    <option value="">Sélectionner un type</option>
                    <option value="Département">Département</option>
                    <option value="Commune">Commune</option>
                    <option value="Village">Village</option>
                    <option value="Quartier">Quartier</option>
                </select>
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
                          placeholder="Description de la région, sa culture, ses spécificités...">{{ old('description') }}</textarea>
            </div>

            <!-- Langue principale -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-translate"></i>
                    Langue principale
                </label>
                <select name="langue_principale_id" class="form-select-enhanced">
                    <option value="">Aucune langue spécifique</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}">{{ $langue->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Statut -->
<div class="col-md-6">
    <div class="switch-container h-100">
        <label class="form-label mb-3">
            <i class="bi bi-toggle-on"></i>
            Statut
        </label>

        <!-- IMPORTANT : champ caché -->
        <input type="hidden" name="is_active" value="0">

        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   name="is_active"
                   id="activeSwitch"
                   value="1"
                   checked>
            <label class="form-check-label fw-medium" for="activeSwitch">
                Région active
            </label>
        </div>

        <p class="text-muted mt-3 mb-0 small">
            <i class="bi bi-info-circle"></i>
            Les régions inactives ne seront pas disponibles pour les contenus
        </p>
    </div>
</div>


            <!-- Actions -->
            <div class="col-12 mt-4 pt-3 border-top">
                <button type="submit" class="btn-save">
                    <i class="bi bi-save"></i>
                    Enregistrer la région
                </button>

                <a href="{{ route('admin.regions.index') }}" class="btn-cancel ms-3">
                    Annuler
                </a>
            </div>

        </div>
    </form>
</div>

@endsection
