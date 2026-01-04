@extends('front.layouts.app')

@section('title', 'Modifier le contenu')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5 position-relative">
        <div class="hero-content" style="z-index: 2;">
            <h1 class="fw-bold text-white mb-3" style="font-size: 2.8rem; font-family: 'Playfair Display', serif;">
                Éditer votre contenu
            </h1>
            <p class="text-light fs-5 opacity-90" style="max-width: 600px; margin: 0 auto;">
                Modifiez et améliorez votre contenu avant re-soumission
            </p>

            <!-- Statut du contenu -->
            <div class="mt-4">
                <span class="badge
                    @if($contenu->status == 'validated') bg-success
                    @elseif($contenu->status == 'pending') bg-warning
                    @elseif($contenu->status == 'rejected') bg-danger
                    @else bg-secondary @endif
                    py-2 px-3 me-2">
                    @if($contenu->status == 'validated')
                        <i class="bi bi-check-circle me-1"></i> Validé
                    @elseif($contenu->status == 'pending')
                        <i class="bi bi-clock-history me-1"></i> En attente
                    @elseif($contenu->status == 'rejected')
                        <i class="bi bi-x-circle me-1"></i> Rejeté
                    @else
                        <i class="bi bi-question-circle me-1"></i> {{ $contenu->status }}
                    @endif
                </span>

                <span class="badge bg-light text-dark py-2 px-3">
                    <i class="bi bi-calendar me-1"></i>
                    Créé le {{ $contenu->created_at->format('d/m/Y') }}
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
        --warning: #f59e0b;
        --danger: #ef4444;
        --light-bg: #f8fafc;
        --border: #e2e8f0;
    }

    .edit-card {
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

    .current-image {
        border: 2px solid var(--border);
        border-radius: 12px;
        padding: 1.5rem;
        background: var(--light-bg);
    }

    .image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 8px;
        object-fit: cover;
    }

    .image-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 1rem;
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

    .btn-secondary-custom {
        background: var(--light-bg);
        color: var(--primary);
        border: 2px solid var(--border);
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background: #e2e8f0;
        color: var(--primary);
    }

    .status-alert {
        background: linear-gradient(135deg,
            @if($contenu->status == 'validated') rgba(16, 185, 129, 0.1)
            @elseif($contenu->status == 'pending') rgba(245, 158, 11, 0.1)
            @elseif($contenu->status == 'rejected') rgba(239, 68, 68, 0.1)
            @else rgba(100, 116, 139, 0.1) @endif,
            transparent);
        border-left: 4px solid
            @if($contenu->status == 'validated') var(--success)
            @elseif($contenu->status == 'pending') var(--warning)
            @elseif($contenu->status == 'rejected') var(--danger)
            @else #64748b @endif;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
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

    @media (max-width: 768px) {
        .edit-card {
            margin-top: -20px;
            border-radius: 16px;
        }

        .form-section {
            padding: 1.5rem;
        }

        .image-actions {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <div class="edit-card">
        <!-- Avertissement sur le statut -->
        @if($contenu->status == 'validated')
        <div class="status-alert">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-info-circle" style="font-size: 1.5rem; color: var(--success);"></i>
                <div>
                    <h5 class="fw-bold mb-2">Contenu déjà validé</h5>
                    <p class="mb-0">
                        Toute modification remettra ce contenu en attente de validation.
                        Les modifications ne seront visibles qu'après approbation par un modérateur.
                    </p>
                </div>
            </div>
        </div>
        @elseif($contenu->status == 'rejected')
        <div class="status-alert">
            <div class="d-flex align-items-start gap-3">
                <i class="bi bi-exclamation-triangle" style="font-size: 1.5rem; color: var(--danger);"></i>
                <div>
                    <h5 class="fw-bold mb-2">Contenu précédemment rejeté</h5>
                    <p class="mb-0">
                        Ce contenu a été rejeté. Veuillez apporter les corrections nécessaires
                        avant de le soumettre à nouveau pour validation.
                    </p>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('contributeur.contenus.update', $contenu) }}"
              method="POST"
              enctype="multipart/form-data"
              id="editForm"
              novalidate>
            @csrf
            @method('PUT')

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
                               value="{{ old('titre', $contenu->titre) }}"
                               placeholder="Ex: Les danses traditionnelles du peuple Fon"
                               required
                               maxlength="200"
                               id="titreInput">
                        <div class="character-counter">
                            <span id="titreCounter">{{ strlen($contenu->titre) }}</span>/200 caractères
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
                            @foreach($langues as $l)
                                <option value="{{ $l->id }}"
                                        {{ old('langue_id', $contenu->langue_id) == $l->id ? 'selected' : '' }}>
                                    {{ $l->nom }} ({{ $l->code }})
                                </option>
                            @endforeach
                        </select>
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
                            @foreach($typecontenus as $t)
                                <option value="{{ $t->id }}"
                                        {{ old('typecontenu_id', $contenu->typecontenu_id) == $t->id ? 'selected' : '' }}>
                                    {{ $t->nom }}
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
                                <option value="{{ $r->id }}"
                                        {{ old('region_id', $contenu->region_id) == $r->id ? 'selected' : '' }}>
                                    {{ $r->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <label class="form-label">
                            Description courte <span class="required">*</span>
                        </label>
                        <textarea name="description"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Résumez votre contenu..."
                                  required
                                  maxlength="500"
                                  id="descriptionInput">{{ old('description', $contenu->description) }}</textarea>
                        <div class="character-counter">
                            <span id="descriptionCounter">{{ strlen($contenu->description) }}</span>/500 caractères
                        </div>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 2 : IMAGE DE COUVERTURE -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-image"></i>
                    Image de couverture
                </h3>

                <div class="row g-4">
                    <div class="col-md-6">
                        <!-- Image actuelle -->
                        @if($contenu->image_couverture)
                        <div class="current-image">
                            <h6 class="fw-bold mb-3">Image actuelle</h6>
                            <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
                                 class="image-preview w-100 mb-3"
                                 alt="Image de couverture actuelle">

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    {{ basename($contenu->image_couverture) }}
                                </span>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="removeImage()">
                                    <i class="bi bi-trash me-1"></i> Supprimer
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-4 border rounded bg-light">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3 mb-0">Aucune image de couverture</p>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <!-- Upload nouvelle image -->
                        <label class="form-label mb-3">
                            @if($contenu->image_couverture)
                                Changer l'image
                            @else
                                Ajouter une image
                            @endif
                        </label>

                        <div class="border-2 border-dashed rounded-lg p-4 text-center"
                             style="border-color: var(--border); border-style: dashed;"
                             onclick="document.getElementById('imageInput').click()">
                            <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: var(--secondary);"></i>
                            <p class="mt-2 mb-1">Cliquez pour sélectionner une image</p>

                            <input type="file"
                                   name="image_couverture"
                                   id="imageInput"
                                   class="d-none"
                                   accept="image/*"
                                   onchange="previewNewImage(event)">
                        </div>

                        <!-- Prévisualisation nouvelle image -->
                        <div id="newImagePreview" class="mt-3" style="display: none;">
                            <h6 class="fw-bold mb-2">Nouvelle image</h6>
                            <img id="newImage" class="image-preview w-100 rounded" alt="Nouvelle image">
                            <button type="button"
                                    class="btn btn-sm btn-outline-secondary mt-2 w-100"
                                    onclick="cancelNewImage()">
                                <i class="bi bi-x-circle me-1"></i> Annuler
                            </button>
                        </div>

                        <!-- Champ caché pour suppression d'image -->
                        <input type="hidden" name="remove_image" id="removeImageField" value="0">

                        <div class="help-text mt-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Formats : JPG, PNG, WebP
                        </div>
                        @error('image_couverture')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 3 : CONTENU DÉTAILLÉ -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-file-text"></i>
                    Contenu détaillé
                </h3>

                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">
                            Contenu <span class="required">*</span>
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
                                  rows="15"
                                  placeholder="Rédigez votre contenu ici..."
                                  required
                                  id="contenuTextarea">{{ old('contenu_texte', $contenu->contenu_texte) }}</textarea>

                        <div class="help-text mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Vous pouvez utiliser des balises HTML de base pour la mise en forme
                        </div>
                        @error('contenu_texte')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- SECTION 4 : MÉTADONNÉES -->
            <div class="form-section">
                <h3 class="section-title">
                    <i class="bi bi-tags"></i>
                    Métadonnées
                </h3>

                <div class="row g-4">
                    <!-- Mots-clés -->
                    <div class="col-md-6">
                        <label class="form-label">Mots-clés</label>
                        <input type="text"
                               name="tags"
                               class="form-control"
                               value="{{ old('tags', $contenu->tags) }}"
                               placeholder="Ex: danse, tradition, fon, culture">
                        <div class="help-text">Séparez par des virgules</div>
                    </div>

                    <!-- Date de mise à jour -->
                    <div class="col-md-6">
                        <label class="form-label">Date de dernière modification</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $contenu->updated_at->format('d/m/Y à H:i') }}"
                               readonly
                               style="background-color: var(--light-bg);">
                        <div class="help-text">Cette date sera mise à jour automatiquement</div>
                    </div>
                </div>
            </div>

            <!-- BOUTONS D'ACTION -->
            <div class="form-section text-center pt-4 border-top-0">
                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="bi bi-save"></i>
                        Sauvegarder les modifications
                    </button>

                    <button type="button" class="btn btn-secondary-custom px-4"
                            onclick="window.location.href='{{ route('contributeur.contenus.show', $contenu) }}'">
                        <i class="bi bi-eye"></i>
                        Annuler et voir
                    </button>

                    <button type="button" class="btn btn-secondary-custom px-4"
                            onclick="window.location.href='{{ route('contributeur.contenus.index') }}'">
                        <i class="bi bi-arrow-left"></i>
                        Retour à la liste
                    </button>
                </div>

                <div class="mt-4">
                    <div class="alert alert-info border-0 bg-light" style="max-width: 600px; margin: 0 auto;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-3" style="font-size: 1.2rem;"></i>
                            <div class="small">
                                <strong>Important :</strong> Après modification, le contenu repassera en statut
                                "En attente" et devra être revalidé par un modérateur.
                            </div>
                        </div>
                    </div>
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

    // Gestion de l'image
    function removeImage() {
        if (confirm('Voulez-vous vraiment supprimer l\'image de couverture ?')) {
            document.getElementById('removeImageField').value = '1';
            document.querySelector('.current-image').style.opacity = '0.5';
            document.querySelector('.current-image').style.pointerEvents = 'none';

            // Afficher un message
            const currentImage = document.querySelector('.current-image');
            currentImage.innerHTML = `
                <div class="text-center py-4">
                    <i class="bi bi-trash text-danger" style="font-size: 2rem;"></i>
                    <p class="text-danger mt-2 mb-0">Image marquée pour suppression</p>
                </div>
            `;
        }
    }

    function previewNewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('newImage').src = e.target.result;
                document.getElementById('newImagePreview').style.display = 'block';

                // Si on ajoute une nouvelle image, annuler la suppression
                document.getElementById('removeImageField').value = '0';
                const currentImage = document.querySelector('.current-image');
                if (currentImage) {
                    currentImage.style.opacity = '1';
                    currentImage.style.pointerEvents = 'auto';
                }
            }
            reader.readAsDataURL(file);
        }
    }

    function cancelNewImage() {
        document.getElementById('imageInput').value = '';
        document.getElementById('newImagePreview').style.display = 'none';
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

        const newPos = start + (selectedText ? before.length + selectedText.length : before.length + 'Votre texte ici'.length);
        textarea.setSelectionRange(newPos, newPos);
    }

    // Validation du formulaire
    document.getElementById('editForm').addEventListener('submit', function(e) {
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

    // Confirmation avant de quitter si des modifications
    let formChanged = false;
    const formInputs = document.querySelectorAll('#editForm input, #editForm textarea, #editForm select');

    formInputs.forEach(input => {
        input.addEventListener('input', () => {
            formChanged = true;
        });
        input.addEventListener('change', () => {
            formChanged = true;
        });
    });

    window.addEventListener('beforeunload', (e) => {
        if (formChanged) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    document.querySelectorAll('a, button[type="button"]').forEach(element => {
        element.addEventListener('click', (e) => {
            if (formChanged && !confirm('Vous avez des modifications non enregistrées. Continuer ?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
