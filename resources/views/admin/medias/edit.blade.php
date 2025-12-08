@extends('admin.layouts')

@section('title', 'Modifier un Média')

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
    .preview-container {
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 30px;
        border: 2px solid white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .preview-large {
        width: 100%;
        height: 300px;
        object-fit: contain;
        background: rgba(30, 27, 75, 0.02);
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
    .form-select-enhanced, .form-control-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
    }
    .form-select-enhanced:focus, .form-control-enhanced:focus {
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
    .media-type-badge {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>

<div class="mb-4">
    <h1 class="page-title">
        <i class="bi bi-pencil-square"></i>
        Modifier le Média
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Édition du média
    </p>
</div>

<div class="form-card">
    <!-- Prévisualisation -->
    <div class="preview-container">
        @if($media->typeMedia->nom === 'image')
            <img src="{{ $media->url }}" class="preview-large" alt="{{ $media->titre }}">
        @elseif($media->typeMedia->nom === 'video')
            <video class="preview-large" controls>
                <source src="{{ $media->url }}">
            </video>
        @elseif($media->typeMedia->nom === 'audio')
            <div style="height: 150px; background: linear-gradient(135deg, #8a2be2, #1e1b4b); display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-music-note-beamed" style="font-size: 3rem; color: white;"></i>
            </div>
        @endif
    </div>

    <form action="{{ route('admin.medias.update', $media) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Contenu associé -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-journal-text"></i>
                    Contenu associé *
                </label>
                <select name="contenu_id" class="form-select-enhanced">
                    @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id }}" @selected($contenu->id == $media->contenu_id)>
                            {{ $contenu->titre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Type de média -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-file-earmark"></i>
                    Type de média *
                </label>
                <select name="type_media_id" class="form-select-enhanced">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @selected($type->id == $media->type_media_id)>
                            {{ $type->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Titre -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-type"></i>
                    Titre
                </label>
                <input type="text" 
                       name="titre" 
                       class="form-control-enhanced"
                       value="{{ old('titre', $media->titre) }}"
                       placeholder="Titre du média">
            </div>

            <!-- Langue -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-translate"></i>
                    Langue
                </label>
                <select name="langue_id" class="form-select-enhanced">
                    <option value="">Aucune langue spécifique</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}" @selected($langue->id == $media->langue_id)>
                            {{ $langue->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">
                    <i class="bi bi-card-text"></i>
                    Description
                </label>
                <textarea name="description" 
                          class="form-control-enhanced" 
                          rows="3"
                          placeholder="Description du média...">{{ old('description', $media->description) }}</textarea>
            </div>

            <!-- Actions -->
            <div class="col-12 mt-4 pt-3 border-top">
                <button type="submit" class="btn-save">
                    <i class="bi bi-save"></i>
                    Enregistrer les modifications
                </button>
                
                <a href="{{ route('admin.medias.index') }}" class="btn-cancel ms-3">
                    Annuler
                </a>
            </div>
        </div>
    </form>
</div>

@endsection