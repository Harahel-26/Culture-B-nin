@extends('admin.layouts')

@section('title', 'Ajouter un Média')

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
    .upload-zone {
        border: 2px dashed rgba(30, 27, 75, 0.2);
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        background: rgba(30, 27, 75, 0.01);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .upload-zone:hover {
        border-color: #8a2be2;
        background: rgba(138, 43, 226, 0.03);
    }
    .upload-icon {
        font-size: 3rem;
        color: #9ca3af;
        margin-bottom: 15px;
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
    .file-info {
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 10px;
    }
</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-4">
    <h1 class="page-title">
        <i class="bi bi-cloud-upload"></i>
        Ajouter un Média
    </h1>
    <p class="page-subtitle">
        <i class="bi bi-info-circle"></i>
        Téléchargez des images, vidéos ou audios pour enrichir vos contenus
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.medias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            <!-- Contenu associé -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-journal-text"></i>
                    Contenu associé *
                </label>
                <select name="contenu_id" class="form-select-enhanced">
                    @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id }}">{{ $contenu->titre }}</option>
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
                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Fichier média -->
            <div class="col-12">
                <label class="form-label">
                    <i class="bi bi-file-arrow-up"></i>
                    Fichier média *
                </label>
                <div class="upload-zone" onclick="document.getElementById('fileInput').click()">
                    <div class="upload-icon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <div class="fw-medium text-muted mb-2">Cliquez pour sélectionner un fichier</div>
                    <div class="file-info">Images, vidéos ou fichiers audio • Max 20MB</div>
                    <input type="file" name="fichier" id="fileInput" class="d-none" required>
                </div>
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
                        <option value="{{ $langue->id }}">{{ $langue->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Titre -->
            <div class="col-md-6">
                <label class="form-label">
                    <i class="bi bi-type"></i>
                    Titre
                </label>
                <input type="text" name="titre" class="form-control-enhanced" placeholder="Titre du média">
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label">
                    <i class="bi bi-card-text"></i>
                    Description
                </label>
                <textarea name="description" class="form-control-enhanced" rows="3" placeholder="Description du média..."></textarea>
            </div>

            <!-- Actions -->
            <div class="col-12 mt-4 pt-3 border-top">
                <button type="submit" class="btn-save">
                    <i class="bi bi-save"></i>
                    Enregistrer le média
                </button>

                <a href="{{ route('admin.medias.index') }}" class="btn-cancel ms-3">
                    Annuler
                </a>
            </div>

        </div>
    </form>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const uploadZone = document.querySelector('.upload-zone');

    if (file) {
        const fileType = file.type.split('/')[0];
        const iconMap = {
            image: 'bi-image',
            video: 'bi-camera-video',
            audio: 'bi-music-note-beamed'
        };

        const icon = iconMap[fileType] || 'bi-file-earmark';

        uploadZone.querySelector('.upload-icon').innerHTML =
            `<i class="bi ${icon}"></i>`;

        uploadZone.querySelector('.fw-medium').textContent = file.name;

        uploadZone.querySelector('.file-info').textContent =
            `${(file.size / (1024 * 1024)).toFixed(2)} MB • ${fileType}`;
    }
});

</script>

@endsection
