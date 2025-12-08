@extends('admin.layouts')

@section('title', 'Créer un Type de Contenu')

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
    .form-control-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        background: white;
    }
    .form-control-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
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
        Nouveau Type de Contenu
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Créez une nouvelle catégorie pour vos contenus culturels
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.typecontenus.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="form-label">
                <i class="bi bi-tag"></i>
                Nom du type de contenu *
            </label>
            <input type="text" 
                   name="nom" 
                   class="form-control-enhanced"
                   value="{{ old('nom') }}"
                   placeholder="Ex: Article, Vidéo, Podcast, Galerie..."
                   required>
        </div>

        <div class="pt-3 border-top">
            <button type="submit" class="btn-save">
                <i class="bi bi-save"></i>
                Créer le type de contenu
            </button>
            
            <a href="{{ route('admin.typecontenus.index') }}" class="btn-cancel ms-3">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection