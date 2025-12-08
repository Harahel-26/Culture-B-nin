@extends('admin.layouts')

@section('title', 'Modifier le contenu')

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
        display: flex;
        align-items: center;
        gap: 10px;
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

    .cover-preview {
        width: 100%;
        max-width: 220px;
        height: 160px;
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

    .upload-status {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-top: 15px;
    }

    .current-image-badge {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .change-image-text {
        color: #8a2be2;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .file-input {
        display: none;
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

    /* Indicateurs */
    .field-info {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-top: 5px;
        margin-left: 5px;
    }

    /* Info contenu */
    .content-info {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(14, 165, 233, 0.05));
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid rgba(59, 130, 246, 0.1);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
        color: #4b5563;
    }

    .info-item i {
        color: #3b82f6;
        width: 20px;
    }

    /* Badges */
    .badge-premium {
        background: linear-gradient(135deg, #d4a017, #f59e0b);
        color: white;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .badge-free {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
    }
</style>

<div class="mb-5">
    <h1 class="header-title">
        <i class="bi bi-pencil-square-fill"></i>
        Modifier le Contenu
    </h1>
    <p class="header-subtitle">
        <i class="bi bi-arrow-clockwise"></i>
        Modification du contenu : <strong>"{{ $contenu->titre }}"</strong>
    </p>
</div>

<div class="form-card">
    <!-- Info du contenu -->
    <div class="content-info">
        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <i class="bi bi-calendar"></i>
                    <span>Créé le : {{ $contenu->created_at->format('d/m/Y à H:i') }}</span>
                </div>
                <div class="info-item">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Dernière modification : {{ $contenu->updated_at->format('d/m/Y à H:i') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-item">
                    <i class="bi bi-eye"></i>
                    <span>Statut :
                        @if($contenu->is_premium)
                            <span class="badge-premium ms-2">Premium</span>
                        @else
                            <span class="badge-free ms-2">Gratuit</span>
                        @endif
                    </span>
                </div>
                <div class="info-item">
                    <i class="bi bi-translate"></i>
                    <span>Langue : {{ $contenu->langue->nom }}</span>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.contenus.update', $contenu) }}" method="POST" enctype="multipart/form-data" id="editForm">
        @csrf
        @method('PUT')

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
                           value="{{ old('titre', $contenu->titre) }}"
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
                        @foreach($langues as $l)
                            <option value="{{ $l->id }}"
                                {{ old('langue_id', $contenu->langue_id) == $l->id ? 'selected' : '' }}>
                                {{ $l->nom }}
                            </option>
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
                            <option value="{{ $r->id }}"
                                {{ old('region_id', $contenu->region_id) == $r->id ? 'selected' : '' }}>
                                {{ $r->nom }}
                            </option>
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
                            <option value="{{ $t->id }}"
                                {{ old('typecontenu_id', $contenu->typecontenu_id) == $t->id ? 'selected' : '' }}>
                                {{ $t->nom }}
                            </option>
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
                             src="{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}"
                             alt="Image de couverture actuelle">

                        <div class="upload-status">
                            <span class="current-image-badge">
                                <i class="bi bi-check-circle"></i>
                                Image actuelle
                            </span>
                            <span class="change-image-text" onclick="event.stopPropagation(); document.getElementById('coverInput').click()">
                                <i class="bi bi-arrow-repeat"></i>
                                Changer
                            </span>
                        </div>

                        <input type="file" name="image_couverture"
                               id="coverInput" class="file-input"
                               accept="image/*"
                               onchange="previewCover(event)">
                    </div>
                    <div class="field-info">Cliquez sur l'image pour la modifier</div>
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
                            <span class="badge-premium ms-2">Exclusif</span>
                        </label>

                        <input type="checkbox" name="is_premium" value="1"
                               class="toggle-input" id="premiumToggle"
                               {{ old('is_premium', $contenu->is_premium) ? 'checked' : '' }}>
                        <label for="premiumToggle" class="toggle-switch"></label>
                    </div>
                    <div class="field-info">Activez pour rendre ce contenu premium</div>
                </div>

                <div class="col-md-6" id="priceSection" style="{{ old('is_premium', $contenu->is_premium) ? '' : 'display: none;' }}">
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
                                   value="{{ old('prix', $contenu->prix) }}"
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
                    <textarea name="contenu_texte" id="editor" rows="10">{!! old('contenu_texte', $contenu->contenu_texte) !!}</textarea>
                </div>
                <div class="field-info">Utilisez l'éditeur pour formater votre texte</div>
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
            <div>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save"></i>
                    Enregistrer les modifications
                </button>

                <a href="{{ route('admin.contenus.index') }}" class="btn btn-cancel ms-3">
                    <i class="bi bi-x-circle"></i>
                    Annuler
                </a>

                <a href="{{ route('admin.contenus.show', $contenu) }}"
                   class="btn btn-outline-primary ms-3"
                   style="padding: 14px 24px; border-radius: 12px;">
                    <i class="bi bi-eye"></i>
                    Voir
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
let editor;

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
    .then(editorInstance => {
        editor = editorInstance;
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
        // Animation
        priceSection.style.animation = 'none';
        setTimeout(() => {
            priceSection.style.animation = 'slideDown 0.3s ease';
        }, 10);
    } else {
        priceSection.style.display = 'none';
    }
});

// Prévisualisation de l'image
function previewCover(event) {
    const input = event.target;
    const preview = document.getElementById('coverPreview');
    const statusBadge = document.querySelector('.current-image-badge');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            statusBadge.innerHTML = '<i class="bi bi-clock"></i> Nouvelle image';
            statusBadge.style.background = 'linear-gradient(135deg, #f59e0b, #fbbf24)';
        }

        reader.readAsDataURL(input.files[0]);

        // Vérifier la taille du fichier
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Le fichier est trop volumineux. Taille maximale : 2MB');
            input.value = '';
            preview.src = "{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}";
            statusBadge.innerHTML = '<i class="bi bi-check-circle"></i> Image actuelle';
            statusBadge.style.background = 'linear-gradient(135deg, #10b981, #34d399)';
        }
    }
}

// Validation du formulaire
document.getElementById('editForm').addEventListener('submit', function(e) {
    const title = this.querySelector('input[name="titre"]').value.trim();

    if (!title) {
        e.preventDefault();
        alert('Veuillez saisir un titre pour le contenu.');
        this.querySelector('input[name="titre"]').focus();
        return;
    }

    // Si premium est activé, vérifier le prix
    if (premiumToggle.checked) {
        const priceInput = this.querySelector('input[name="prix"]');
        const price = parseInt(priceInput.value);

        if (!price || price < 100) {
            e.preventDefault();
            alert('Pour un contenu premium, le prix doit être d\'au moins 100 FCFA.');
            priceInput.focus();
            return;
        }
    }

    // Demander confirmation
    if (!confirm('Êtes-vous sûr de vouloir enregistrer les modifications ?')) {
        e.preventDefault();
    }
});

// Restaurer l'image d'origine
function restoreOriginalImage() {
    document.getElementById('coverPreview').src = "{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}";
    document.getElementById('coverInput').value = '';
    document.querySelector('.current-image-badge').innerHTML = '<i class="bi bi-check-circle"></i> Image restaurée';
    document.querySelector('.current-image-badge').style.background = 'linear-gradient(135deg, #10b981, #34d399)';
}
</script>

@endsection
