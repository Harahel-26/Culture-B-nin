@extends('admin.layouts')

@section('title', 'Créer un contenu')

@section('content')

<style>
    /* Styles généraux */
    .form-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 18px;
        padding: 35px;
        box-shadow: 0 12px 40px rgba(30, 27, 75, 0.08);
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
        height: 5px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b, #d4a017);
    }

    /* En-tête */
    .header-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.2rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.4rem;
    }

    .header-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-bottom: 30px;
        padding-left: 45px;
    }

    /* Labels */
    .form-label-premium {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label-premium i {
        color: #8a2be2;
        font-size: 1.1rem;
    }

    .required::after {
        content: ' *';
        color: #ef4444;
        font-weight: bold;
    }

    /* Champs de formulaire */
    .form-control-enhanced, .form-select-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.02);
    }

    .form-control-enhanced:focus, .form-select-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }

    /* Preview image */
    .cover-upload-container {
        border: 2px dashed rgba(30, 27, 75, 0.2);
        border-radius: 14px;
        padding: 25px;
        text-align: center;
        background: rgba(30, 27, 75, 0.01);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .cover-upload-container:hover {
        border-color: #8a2be2;
        background: rgba(138, 43, 226, 0.03);
    }

    .cover-upload-container:hover .upload-icon {
        transform: scale(1.1);
        color: #8a2be2;
    }

    .cover-preview {
        width: 100%;
        max-width: 200px;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        margin: 0 auto 15px;
        border: 3px solid white;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .cover-preview:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .upload-icon {
        font-size: 3rem;
        color: #9ca3af;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .upload-text {
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .upload-subtext {
        color: #9ca3af;
        font-size: 0.9rem;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    /* Section premium */
    .premium-toggle {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.03), rgba(138, 43, 226, 0.03));
        border-radius: 14px;
        border: 2px solid rgba(30, 27, 75, 0.1);
        transition: all 0.3s ease;
    }

    .premium-toggle:hover {
        border-color: #8a2be2;
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(212, 160, 23, 0.05));
    }

    .toggle-label {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        font-weight: 600;
        color: #1e1b4b;
        flex: 1;
    }

    .toggle-icon {
        font-size: 1.4rem;
        color: #8a2be2;
    }

    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
        background: #e0e0e0;
        border-radius: 50px;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .toggle-switch::after {
        content: '';
        position: absolute;
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    input:checked + .toggle-switch {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
    }

    input:checked + .toggle-switch::after {
        transform: translateX(30px);
    }

    .toggle-input {
        display: none;
    }

    /* Bloc prix */
    .price-container {
        padding: 20px;
        background: linear-gradient(135deg, rgba(212, 160, 23, 0.05), rgba(255, 215, 0, 0.05));
        border-radius: 14px;
        border: 2px solid rgba(212, 160, 23, 0.2);
        animation: slideDown 0.3s ease;
        box-shadow: 0 4px 15px rgba(212, 160, 23, 0.1);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .price-input-container {
        position: relative;
        max-width: 200px;
    }

    .price-currency {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 600;
        color: #d4a017;
    }

    .price-input {
        padding-left: 50px;
        font-weight: 600;
        color: #1e1b4b;
        border: 2px solid rgba(212, 160, 23, 0.3);
        background: rgba(255, 255, 255, 0.9);
    }

    .price-input:focus {
        border-color: #d4a017;
        box-shadow: 0 0 0 4px rgba(212, 160, 23, 0.15);
    }

    /* Boutons */
    .btn-submit {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.2);
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(138, 43, 226, 0.3);
        color: white;
    }

    .btn-cancel {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 14px 32px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-cancel:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
        transform: translateY(-2px);
    }

    /* Éditeur CKEditor */
    .editor-container {
        border-radius: 14px;
        overflow: hidden;
        border: 2px solid #e0e0e0;
        transition: all 0.3s ease;
    }

    .editor-container:hover {
        border-color: #8a2be2;
    }

    /* Sections du formulaire */
    .form-section {
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid rgba(30, 27, 75, 0.1);
    }

    .form-section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e1b4b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-section-title i {
        color: #8a2be2;
    }

    /* Indicateur de champ obligatoire */
    .field-info {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-top: 5px;
        margin-left: 5px;
    }

    /* Message d'erreur */
    .error-message {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
</style>

<div class="mb-5">
    <h1 class="header-title">
        <i class="bi bi-plus-square-fill"></i>
        Créer un Nouveau Contenu
    </h1>
    <p class="header-subtitle">
        <i class="bi bi-info-circle"></i>
        Remplissez les informations pour créer un nouveau contenu culturel béninois
    </p>
</div>

<div class="form-card">
    <form action="{{ route('admin.contenus.store') }}" method="POST" enctype="multipart/form-data" id="contentForm">
        @csrf

        <!-- Section Informations de base -->
        <div class="form-section">
            <h4 class="form-section-title">
                <i class="bi bi-card-text"></i>
                Informations principales
            </h4>

            <div class="row g-4">
                <!-- Titre -->
                <div class="col-md-6">
                    <label class="form-label-premium required">
                        <i class="bi bi-type"></i>
                        Titre du contenu
                    </label>
                    <input type="text" name="titre" class="form-control-enhanced"
                           placeholder="Ex: Les Rois du Dahomey" required>
                    <div class="field-info">Titre attractif et descriptif</div>
                </div>

                <!-- Langue -->
                <div class="col-md-6">
                    <label class="form-label-premium required">
                        <i class="bi bi-translate"></i>
                        Langue
                    </label>
                    <select name="langue_id" class="form-select-enhanced" required>
                        <option value="">-- Sélectionnez une langue --</option>
                        @foreach($langues as $l)
                            <option value="{{ $l->id }}">{{ $l->nom }}</option>
                        @endforeach
                    </select>
                    <div class="field-info">Langue principale du contenu</div>
                </div>

                <!-- Région -->
                <div class="col-md-6">
                    <label class="form-label-premium">
                        <i class="bi bi-geo-alt"></i>
                        Région associée
                    </label>
                    <select name="region_id" class="form-select-enhanced">
                        <option value="">-- Aucune région spécifique --</option>
                        @foreach($regions as $r)
                            <option value="{{ $r->id }}">{{ $r->nom }}</option>
                        @endforeach
                    </select>
                    <div class="field-info">Optionnel - pour contenu régional</div>
                </div>

                <!-- Type de contenu -->
                <div class="col-md-6">
                    <label class="form-label-premium required">
                        <i class="bi bi-tags"></i>
                        Type de contenu
                    </label>
                    <select name="typecontenu_id" class="form-select-enhanced" required>
                        @foreach($typecontenus as $t)
                            <option value="{{ $t->id }}">{{ $t->nom }}</option>
                        @endforeach
                    </select>
                    <div class="field-info">Catégorie principale</div>
                </div>
            </div>
        </div>

        <!-- Section Visuel -->
        <div class="form-section">
            <h4 class="form-section-title">
                <i class="bi bi-image"></i>
                Visuel & Couverture
            </h4>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label-premium">
                        <i class="bi bi-camera"></i>
                        Image de couverture
                    </label>

                    <div class="cover-upload-container" onclick="document.getElementById('coverInput').click()">
                        <img id="coverPreview" class="cover-preview"
                             src="{{ asset('images/default-cover.jpg') }}"
                             alt="Aperçu de l'image de couverture">

                        <div class="upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>

                        <div class="upload-text">Cliquez pour télécharger une image</div>
                        <div class="upload-subtext">PNG, JPG ou WEBP • Max 2MB</div>

                        <input type="file" name="image_couverture"
                               id="coverInput" class="file-input"
                               accept="image/*"
                               onchange="previewCover(event)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Premium & Prix -->
        <div class="form-section">
            <h4 class="form-section-title">
                <i class="bi bi-gem"></i>
                Options Premium
            </h4>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="premium-toggle">
                        <label class="toggle-label">
                            <i class="bi bi-gem toggle-icon"></i>
                            Contenu Premium
                            <span class="badge bg-warning ms-2">Exclusif</span>
                        </label>

                        <input type="checkbox" name="is_premium" value="1"
                               class="toggle-input" id="premiumToggle">
                        <label for="premiumToggle" class="toggle-switch"></label>
                    </div>
                    <div class="field-info">Activez pour rendre ce contenu premium</div>
                </div>

                <div class="col-md-6" id="priceSection" style="display: none;">
                    <div class="price-container">
                        <label class="form-label-premium">
                            <i class="bi bi-currency-exchange"></i>
                            Prix d'accès
                        </label>
                        <div class="price-input-container">
                            <span class="price-currency">FCFA</span>
                            <input type="number" name="prix"
                                   class="form-control-enhanced price-input"
                                   min="100" step="100"
                                   placeholder="1000">
                        </div>
                        <div class="field-info">Prix minimum : 100 FCFA</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Contenu détaillé -->
        <div class="form-section" style="border-bottom: none;">
            <h4 class="form-section-title">
                <i class="bi bi-file-text"></i>
                Contenu détaillé
            </h4>

            <div class="mb-3">
                <label class="form-label-premium required">
                    <i class="bi bi-pencil-square"></i>
                    Rédigez votre contenu
                </label>
                <div class="editor-container">
                    <textarea name="contenu_texte" id="editor" rows="10"></textarea>
                </div>
                <div class="field-info">Utilisez l'éditeur pour formater votre texte</div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
            <div>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save"></i>
                    Enregistrer le contenu
                </button>

                <a href="{{ route('admin.contenus.index') }}" class="btn btn-cancel ms-3">
                    <i class="bi bi-x-circle"></i>
                    Annuler
                </a>
            </div>

            <div class="text-muted">
                <i class="bi bi-info-circle"></i>
                Tous les champs marqués * sont obligatoires
            </div>
        </div>

    </form>
</div>

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
// Initialiser l'éditeur CKEditor
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: {
            items: [
                'heading', '|', 'bold', 'italic', 'link', 'bulletedList',
                'numberedList', '|', 'outdent', 'indent', '|', 'imageUpload',
                'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
            ]
        },
        language: 'fr',
        licenseKey: '',
    })
    .then(editor => {
        window.editor = editor;
    })
    .catch(error => {
        console.error(error);
    });

// Gérer l'affichage du prix
const premiumToggle = document.getElementById('premiumToggle');
const priceSection = document.getElementById('priceSection');

premiumToggle.addEventListener('change', function() {
    if (this.checked) {
        priceSection.style.display = 'block';
    } else {
        priceSection.style.display = 'none';
    }
});

// Prévisualisation de l'image
function previewCover(event) {
    const input = event.target;
    const preview = document.getElementById('coverPreview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.parentElement.querySelector('.upload-text').textContent = 'Image sélectionnée';
            preview.parentElement.querySelector('.upload-icon').innerHTML = '<i class="bi bi-check-circle-fill" style="color: #10b981;"></i>';
        }

        reader.readAsDataURL(input.files[0]);

        // Vérifier la taille du fichier
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Le fichier est trop volumineux. Taille maximale : 2MB');
            input.value = '';
            preview.src = "{{ asset('images/default-cover.jpg') }}";
            preview.parentElement.querySelector('.upload-text').textContent = 'Cliquez pour télécharger une image';
            preview.parentElement.querySelector('.upload-icon').innerHTML = '<i class="bi bi-cloud-arrow-up"></i>';
        }
    }
}

// Validation du formulaire
document.getElementById('contentForm').addEventListener('submit', function(e) {
    const title = this.querySelector('input[name="titre"]').value.trim();

    if (!title) {
        e.preventDefault();
        alert('Veuillez saisir un titre pour le contenu.');
        this.querySelector('input[name="titre"]').focus();
    }
});
</script>

@endsection
