@extends('front.layouts.app')

@section('title', 'Créer un Contenu')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5 position-relative">
        <div class="hero-content" style="z-index: 2;">
            <h1 class="fw-bold text-white mb-3" style="font-size: 2.8rem; font-family: 'Playfair Display', serif;">
                Partager votre savoir
            </h1>
            <p class="text-light fs-5 opacity-90" style="max-width: 600px; margin: 0 auto;">
                Créez un contenu unique et contribuez à la préservation
                du patrimoine culturel béninois
            </p>
            <div class="mt-4">
                <span class="badge bg-light text-dark me-2 py-2 px-3">
                    <i class="bi bi-info-circle me-1"></i> Remplissez tous les champs obligatoires
                </span>
                <span class="badge bg-light text-dark py-2 px-3">
                    <i class="bi bi-shield-check me-1"></i> Contenu vérifié par nos modérateurs
                </span>
            </div>
        </div>
    </div>
</section>
@endsection

@section('content')
<style>
    :root {
        --primary: #1E2B4D;
        --secondary: #E8C676;
        --accent: #A52A2A;
        --success: #10b981;
        --light-bg: #f8fafc;
        --border: #e2e8f0;
    }

    .creation-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid var(--border);
        margin-top: -40px;
        position: relative;
        z-index: 10;
    }

    .form-section {
        padding: 2.5rem;
        border-bottom: 1px solid var(--border);
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .section-title {
        color: var(--primary);
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(232, 198, 118, 0.3);
    }

    .section-title i {
        color: var(--secondary);
        font-size: 1.2rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-label .required {
        color: var(--accent);
        margin-left: 2px;
    }

    .form-control, .form-select {
        border: 2px solid var(--border);
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 0 3px rgba(232, 198, 118, 0.15);
    }

    .form-control-lg {
        padding: 1rem 1.25rem;
        font-size: 1.1rem;
    }

    .premium-toggle {
        background: var(--light-bg);
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .premium-toggle.active {
        background: rgba(232, 198, 118, 0.1);
        border: 2px solid var(--secondary);
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: var(--secondary);
    }

    input:checked + .toggle-slider:before {
        transform: translateX(30px);
    }

    .image-upload-area {
        border: 2px dashed var(--border);
        border-radius: 12px;
        padding: 3rem 2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--light-bg);
    }

    .image-upload-area:hover {
        border-color: var(--secondary);
        background: rgba(232, 198, 118, 0.05);
    }

    .image-upload-area.dragover {
        border-color: var(--secondary);
        background: rgba(232, 198, 118, 0.1);
    }

    .image-preview {
        max-width: 100%;
        max-height: 300px;
        border-radius: 12px;
        margin-top: 1rem;
        display: none;
    }

    .help-text {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .character-counter {
        font-size: 0.85rem;
        color: #64748b;
        text-align: right;
        margin-top: 0.25rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--accent), #dc2626);
        color: white;
        border: none;
        padding: 1rem 3rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(165, 42, 42, 0.3);
        color: white;
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 3rem;
    }

    .progress-steps::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--border);
        transform: translateY(-50%);
        z-index: 1;
    }

    .step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 2px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        font-weight: 600;
        color: #94a3b8;
        transition: all 0.3s ease;
    }

    .step.active .step-circle {
        background: var(--secondary);
        border-color: var(--secondary);
        color: var(--primary);
    }

    .step-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 500;
    }

    .step.active .step-label {
        color: var(--primary);
        font-weight: 600;
    }

    .rich-text-toolbar {
        background: var(--light-bg);
        border: 2px solid var(--border);
        border-bottom: none;
        border-radius: 10px 10px 0 0;
        padding: 0.75rem;
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .rich-text-toolbar button {
        background: white;
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .rich-text-toolbar button:hover {
        background: var(--secondary);
        border-color: var(--secondary);
        color: var(--primary);
    }

    #contenu_texte {
        border-radius: 0 0 10px 10px;
        min-height: 300px;
    }

    @media (max-width: 768px) {
        .creation-card {
            margin-top: -20px;
            border-radius: 16px;
        }

        .form-section {
            padding: 1.5rem;
        }
    }
</style>

<div class="container">
    <div class="creation-card">
        <!-- Étapes de progression -->
        <div class="form-section">
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-circle">1</div>
                    <div class="step-label">Informations</div>
                </div>
                <div class="step">
                    <div class="step-circle">2</div>
                    <div class="step-label">Contenu</div>
                </div>
                <div class="step">
                    <div class="step-circle">3</div>
                    <div class="step-label">Médias</div>
                </div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Publication</div>
                </div>
            </div>
        </div>

        <form action="{{ route('contributeur.contenus.store') }}"
              method="POST"
              enctype="multipart/form-data"
              id="contentForm"
              novalidate>
            @csrf

            <!-- SECTION 1 : INFORMATIONS DE BASE -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-card-heading"></i>
                    Informations de base
                </h3>

                <div class="row g-4">
                    <!-- Titre -->
                    <div class="col-12">
                        <label class="form-label">
                            Titre du contenu <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="titre"
                               class="form-control form-control-lg"
                               value="{{ old('titre') }}"
                               placeholder="Ex: Les danses traditionnelles du peuple Fon"
                               required
                               maxlength="200"
                               id="titreInput">
                        <div class="character-counter">
                            <span id="titreCounter">0</span>/200 caractères
                        </div>
                        @error('titre')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Langue -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Langue <span class="required">*</span>
                        </label>
                        <select name="langue_id" class="form-select" required>
                            <option value="">Choisir une langue</option>
                            @foreach($langues as $l)
                                <option value="{{ $l->id }}" {{ old('langue_id') == $l->id ? 'selected' : '' }}>
                                    {{ $l->nom }} ({{ $l->code }})
                                </option>
                            @endforeach
                        </select>
                        <div class="help-text">Sélectionnez la langue principale de votre contenu</div>
                        @error('langue_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type de contenu -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Catégorie <span class="required">*</span>
                        </label>
                        <select name="typecontenu_id" class="form-select" required>
                            <option value="">Choisir une catégorie</option>
                            @foreach($typecontenus as $t)
                                <option value="{{ $t->id }}" {{ old('typecontenu_id') == $t->id ? 'selected' : '' }}>
                                    {{ $t->nom }}
                                    @if($t->description)
                                        - {{ $t->description }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('typecontenu_id')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Région -->
                    <div class="col-md-6">
                        <label class="form-label">Région associée</label>
                        <select name="region_id" class="form-select">
                            <option value="">Sélectionner une région (optionnel)</option>
                            @foreach($regions as $r)
                                <option value="{{ $r->id }}" {{ old('region_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nom }}
                                </option>
                            @endforeach
                        </select>
                        <div class="help-text">Liez votre contenu à une région spécifique du Bénin</div>
                    </div>

                    <!-- Tags/Mots-clés -->
                    <div class="col-md-6">
                        <label class="form-label">Mots-clés</label>
                        <input type="text"
                               name="tags"
                               class="form-control"
                               value="{{ old('tags') }}"
                               placeholder="Ex: danse, tradition, fon, culture">
                        <div class="help-text">Séparez les mots-clés par des virgules</div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2 : CONTENU PRINCIPAL -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-file-text"></i>
                    Contenu principal
                </h3>

                <div class="row g-4">
                    <!-- Description courte -->
                    <div class="col-12">
                        <label class="form-label">
                            Description courte <span class="required">*</span>
                        </label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Résumez votre contenu en quelques lignes..."
                                  required
                                  maxlength="500"
                                  id="descriptionInput">{{ old('description') }}</textarea>
                        <div class="character-counter">
                            <span id="descriptionCounter">0</span>/500 caractères
                        </div>
                        <div class="help-text">Cette description sera visible dans les résultats de recherche</div>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contenu texte riche -->
                    <div class="col-12">
                        <label class="form-label">
                            Contenu détaillé <span class="required">*</span>
                        </label>
                        <div class="rich-text-toolbar">
                            <button type="button" onclick="formatText('bold')" title="Gras">
                                <i class="bi bi-type-bold"></i>
                            </button>
                            <button type="button" onclick="formatText('italic')" title="Italique">
                                <i class="bi bi-type-italic"></i>
                            </button>
                            <button type="button" onclick="formatText('underline')" title="Souligné">
                                <i class="bi bi-type-underline"></i>
                            </button>
                            <div style="width: 1px; background: var(--border); margin: 0 0.5rem;"></div>
                            <button type="button" onclick="insertText('<h3>', '</h3>')" title="Titre">
                                <i class="bi bi-type-h3"></i>
                            </button>
                            <button type="button" onclick="insertText('<ul><li>', '</li></ul>')" title="Liste">
                                <i class="bi bi-list-ul"></i>
                            </button>
                            <button type="button" onclick="insertText('<blockquote>', '</blockquote>')" title="Citation">
                                <i class="bi bi-quote"></i>
                            </button>
                        </div>
                        <textarea name="contenu_texte"
                                  class="form-control"
                                  rows="12"
                                  placeholder="Rédigez votre contenu ici."
                                  required
                                  id="contenuTextarea">{{ old('contenu_texte') }}</textarea>
                        <div class="help-text mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Vous pouvez utiliser des balises HTML de base (h1-h6, p, ul, li, strong, em, blockquote)
                        </div>
                        @error('contenu_texte')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 3 : MÉDIAS ET VISUEL -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-images"></i>
                    Médias et visuel
                </h3>

                <div class="row g-4">
                    <!-- Image de couverture -->
                    <div class="col-12">
                        <label class="form-label">
                            Image de couverture
                        </label>
                        <div class="image-upload-area" id="imageUploadArea">
                            <i class="bi bi-cloud-arrow-up" style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                            <h5>Cliquez pour sélectionner un fichier</h5>
                            <button type="button" class="btn btn-sm"
                                    style="background: var(--secondary); color: var(--primary);"
                                    onclick="document.getElementById('imageInput').click()">
                                <i class="bi bi-folder2-open me-1"></i>
                                Parcourir les fichiers
                            </button>
                            <input type="file"
                                   name="image_couverture"
                                   id="imageInput"
                                   class="d-none"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            <div class="help-text mt-3">
                                Formats acceptés : JPG, PNG, WebP
                            </div>
                        </div>
                        <img id="imagePreview" class="image-preview" alt="Aperçu de l'image">
                        @error('image_couverture')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Galerie d'images supplémentaires -->
                    <div class="col-12">
                        <label class="form-label">Images supplémentaires</label>
                        <input type="file"
                               name="images[]"
                               class="form-control"
                               multiple
                               accept="image/*">
                        <div class="help-text">Sélectionner votre image </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 4 : PARAMÈTRES DE PUBLICATION -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-gear"></i>
                    Paramètres de publication
                </h3>

                <div class="row g-4">
                    <!-- Premium option -->
                    <div class="col-md-6">
                        <div class="premium-toggle" id="premiumToggle">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1">Contenu Premium</h5>
                                    <p class="text-muted small mb-0">Rendez ce contenu accessible uniquement aux abonnés</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" name="is_premium" value="1"
                                           {{ old('is_premium') ? 'checked' : '' }}
                                           onchange="togglePremium(this.checked)">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>

                            <div id="priceSection" style="display: {{ old('is_premium') ? 'block' : 'none' }};">
                                <label class="form-label mt-3">Prix (FCFA)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">FCFA</span>
                                    <input type="number"
                                           name="prix"
                                           class="form-control"
                                           min="500"
                                           step="100"
                                           value="{{ old('prix', 1000) }}"
                                           placeholder="1000">
                                    <span class="input-group-text bg-light">.00</span>
                                </div>
                                <div class="help-text">Prix minimum recommandé : 500 FCFA</div>
                            </div>
                        </div>
                    </div>

                    <!-- Date de publication -->
                    <div class="col-md-6">
                        <label class="form-label">Date de publication</label>
                        <select name="published_at" class="form-select">
                            <option value="now">Publier immédiatement</option>
                            <option value="schedule">Programmer pour plus tard</option>
                        </select>
                        <div class="help-text">Par défaut, le contenu sera publié immédiatement après validation</div>
                    </div>
                </div>
            </div>

            <!-- BOUTONS D'ACTION -->
            <div class="form-section text-center pt-4 border-top-0">
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="bi bi-send-check"></i>
                        Soumettre pour validation
                    </button>

                    <button type="button" class="btn btn-outline-secondary px-4"
                            onclick="window.location.href='{{ route('contributeur.dashboard') }}'">
                        <i class="bi bi-x-circle"></i>
                        Annuler
                    </button>

                    <button type="button" class="btn btn-outline-primary px-4"
                            onclick="saveDraft()">
                        <i class="bi bi-save"></i>
                        Sauvegarder comme brouillon
                    </button>
                </div>

                <div class="mt-3">
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-1"></i>
                        Votre contenu sera vérifié par nos modérateurs dans un délai de 24-48h
                    </small>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Compteurs de caractères
    document.getElementById('titreInput').addEventListener('input', function() {
        document.getElementById('titreCounter').textContent = this.value.length;
    });

    document.getElementById('descriptionInput').addEventListener('input', function() {
        document.getElementById('descriptionCounter').textContent = this.value.length;
    });

    // Initialiser les compteurs
    document.getElementById('titreCounter').textContent = document.getElementById('titreInput').value.length;
    document.getElementById('descriptionCounter').textContent = document.getElementById('descriptionInput').value.length;

    // Gestion du drag & drop pour les images
    const imageUploadArea = document.getElementById('imageUploadArea');
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageUploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadArea.classList.add('dragover');
    });

    imageUploadArea.addEventListener('dragleave', () => {
        imageUploadArea.classList.remove('dragover');
    });

    imageUploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadArea.classList.remove('dragover');
        if (e.dataTransfer.files.length) {
            imageInput.files = e.dataTransfer.files;
            previewImage({ target: imageInput });
        }
    });

    // Prévisualisation d'image
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                imageUploadArea.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }

    // Gestion du toggle premium
    function togglePremium(isPremium) {
        const priceSection = document.getElementById('priceSection');
        const premiumToggle = document.getElementById('premiumToggle');

        if (isPremium) {
            priceSection.style.display = 'block';
            premiumToggle.classList.add('active');
        } else {
            priceSection.style.display = 'none';
            premiumToggle.classList.remove('active');
        }
    }

    // Outils d'édition de texte
    function formatText(command) {
        const textarea = document.getElementById('contenuTextarea');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);

        let formattedText;
        switch(command) {
            case 'bold':
                formattedText = `<strong>${selectedText}</strong>`;
                break;
            case 'italic':
                formattedText = `<em>${selectedText}</em>`;
                break;
            case 'underline':
                formattedText = `<u>${selectedText}</u>`;
                break;
        }

        textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
        textarea.focus();
        textarea.setSelectionRange(start + formattedText.length, start + formattedText.length);
    }

    function insertText(before, after) {
        const textarea = document.getElementById('contenuTextarea');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);

        const formattedText = before + (selectedText || 'Votre texte ici') + after;
        textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
        textarea.focus();

        // Positionner le curseur au bon endroit
        const newPos = start + (selectedText ? before.length + selectedText.length : before.length + 'Votre texte ici'.length);
        textarea.setSelectionRange(newPos, newPos);
    }

    // Sauvegarde de brouillon
    function saveDraft() {
        const form = document.getElementById('contentForm');
        const submitBtn = document.getElementById('submitBtn');

        // Ajouter un champ caché pour indiquer que c'est un brouillon
        const draftInput = document.createElement('input');
        draftInput.type = 'hidden';
        draftInput.name = 'is_draft';
        draftInput.value = '1';
        form.appendChild(draftInput);

        submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sauvegarde en cours...';
        submitBtn.disabled = true;

        // Soumettre le formulaire
        form.submit();
    }

    // Validation en temps réel
    document.getElementById('contentForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    });
</script>
@endsection
