{{-- Langue cible --}}
<div class="mb-4">
    <label class="form-label fw-semibold mb-2">
        <i class="bi bi-globe me-2" style="color: var(--admin-secondary);"></i>
        Langue de traduction
        <span class="text-danger">*</span>
    </label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="bi bi-translate"></i>
        </span>
        <select name="langue_id" class="form-select border-start-0" required>
            <option value="">Sélectionnez une langue</option>
            @foreach($langues as $l)
                <option value="{{ $l->id }}"
                    {{ old('langue_id', $traduction->langue_id ?? '') == $l->id ? 'selected' : '' }}
                    data-flag="{{ $l->flag_url ?? '' }}">
                    {{ $l->nom }} ({{ $l->code }})
                </option>
            @endforeach
        </select>
    </div>
    <small class="form-text text-muted mt-2">
        <i class="bi bi-info-circle me-1"></i>
        Sélectionnez la langue dans laquelle vous traduisez ce contenu
    </small>
</div>

{{-- Titre traduit --}}
<div class="mb-4">
    <label class="form-label fw-semibold mb-2">
        <i class="bi bi-type me-2" style="color: var(--admin-secondary);"></i>
        Titre traduit
    </label>
    <div class="input-group">
        <span class="input-group-text bg-light border-end-0">
            <i class="bi bi-card-heading"></i>
        </span>
        <input type="text"
               name="titre"
               class="form-control border-start-0"
               value="{{ old('titre', $traduction->titre ?? '') }}"
               placeholder="Entrez le titre traduit dans la langue cible">
    </div>
    <div class="d-flex justify-content-between align-items-center mt-2">
        <small class="form-text text-muted">
            <i class="bi bi-lightbulb me-1"></i>
            Traduction du titre original
        </small>
        <small class="text-muted" id="titleCounter">0/200 caractères</small>
    </div>
</div>

{{-- Description traduite --}}
<div class="mb-4">
    <label class="form-label fw-semibold mb-2">
        <i class="bi bi-text-paragraph me-2" style="color: var(--admin-secondary);"></i>
        Description traduite
    </label>
    <div class="position-relative">
        <textarea name="description"
                  class="form-control translation-textarea"
                  rows="3"
                  placeholder="Entrez la description traduite...">{{ old('description', $traduction->description ?? '') }}</textarea>
        <div class="textarea-overlay"></div>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-2">
        <small class="form-text text-muted">
            <i class="bi bi-info-circle me-1"></i>
            Brève description du contenu traduit
        </small>
        <small class="text-muted" id="descriptionCounter">0/500 caractères</small>
    </div>
</div>

{{-- Contenu texte traduit --}}
<div class="mb-4">
    <label class="form-label fw-semibold mb-2">
        <i class="bi bi-file-text me-2" style="color: var(--admin-secondary);"></i>
        Texte traduit
        <span class="text-danger">*</span>
    </label>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-header bg-light py-3">
            <div class="d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Éditeur de traduction</span>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-secondary" onclick="formatText('bold')">
                        <i class="bi bi-type-bold"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="formatText('italic')">
                        <i class="bi bi-type-italic"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="formatText('underline')">
                        <i class="bi bi-type-underline"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <textarea name="contenu_texte"
                      class="form-control translation-editor"
                      rows="8"
                      required
                      placeholder="Traduisez le contenu complet ici...">{{ old('contenu_texte', $traduction->contenu_texte ?? '') }}</textarea>
        </div>
        <div class="card-footer bg-light py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    <i class="bi bi-keyboard me-1"></i>
                    Appuyez sur Ctrl+S pour sauvegarder automatiquement
                </small>
                <small class="text-muted" id="contentCounter">0 caractères</small>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="alert alert-info p-3 border-0">
                <h6 class="alert-heading">
                    <i class="bi bi-lightbulb me-2"></i>
                    Conseils de traduction
                </h6>
                <ul class="mb-0 ps-3">
                    <li>Respectez le style original</li>
                    <li>Adaptez les références culturelles</li>
                    <li>Vérifiez la grammaire et l'orthographe</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-warning p-3 border-0">
                <h6 class="alert-heading">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    À éviter
                </h6>
                <ul class="mb-0 ps-3">
                    <li>Traduction mot à mot</li>
                    <li>Anglicismes non adaptés</li>
                    <li>Termes trop techniques</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-light: #f8f9fa;
        --admin-gray: #64748b;
    }

    .input-group .input-group-text {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(99, 102, 241, 0.05));
        border-color: #e2e8f0;
        color: var(--admin-secondary);
        font-weight: 500;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--admin-secondary);
        box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
        outline: none;
    }

    .translation-textarea {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 15px;
        font-size: 1rem;
        line-height: 1.6;
        resize: vertical;
        transition: all 0.3s ease;
        background: white;
        min-height: 120px;
    }

    .translation-textarea:focus {
        border-color: var(--admin-secondary);
        background: linear-gradient(to right, rgba(138, 43, 226, 0.02), white);
    }

    .translation-editor {
        border: none;
        border-radius: 0;
        padding: 20px;
        font-size: 1.05rem;
        line-height: 1.8;
        resize: vertical;
        background: white;
        min-height: 300px;
        font-family: 'Inter', system-ui, sans-serif;
    }

    .translation-editor:focus {
        outline: none;
        background: linear-gradient(to right, rgba(138, 43, 226, 0.01), white);
    }

    .textarea-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        border-radius: 10px;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .translation-textarea:focus ~ .textarea-overlay {
        border-color: var(--admin-secondary);
        box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.1);
    }

    .card {
        border: 1px solid rgba(138, 43, 226, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(99, 102, 241, 0.05));
        border-bottom: 1px solid rgba(138, 43, 226, 0.1);
    }

    .alert {
        border-radius: 10px;
        border: none;
        margin: 0;
    }

    .alert-info {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.05), rgba(0, 123, 255, 0.02));
        color: #0c5460;
        border-left: 4px solid #0dcaf0;
    }

    .alert-warning {
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.05), rgba(255, 193, 7, 0.02));
        color: #856404;
        border-left: 4px solid #ffc107;
    }

    .alert-heading {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .alert ul {
        margin-bottom: 0;
        padding-left: 1rem;
    }

    .alert li {
        font-size: 0.85rem;
        margin-bottom: 4px;
    }

    .btn-outline-secondary {
        border-color: #e2e8f0;
        color: var(--admin-gray);
    }

    .btn-outline-secondary:hover {
        background: rgba(138, 43, 226, 0.1);
        border-color: var(--admin-secondary);
        color: var(--admin-secondary);
    }

    .form-text {
        font-size: 0.85rem;
    }

    .text-danger {
        color: #ef4444 !important;
    }

    .fw-semibold {
        font-weight: 600;
    }
</style>

<script>
    // Compteurs de caractères
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.querySelector('input[name="titre"]');
        const descriptionInput = document.querySelector('textarea[name="description"]');
        const contentInput = document.querySelector('textarea[name="contenu_texte"]');

        const titleCounter = document.getElementById('titleCounter');
        const descriptionCounter = document.getElementById('descriptionCounter');
        const contentCounter = document.getElementById('contentCounter');

        function updateCounter(input, counter, max) {
            const length = input.value.length;
            counter.textContent = `${length}${max ? '/' + max : ''} caractères`;

            if (max && length > max * 0.9) {
                counter.style.color = '#ef4444';
                counter.style.fontWeight = '600';
            } else if (max && length > max * 0.75) {
                counter.style.color = '#f59e0b';
                counter.style.fontWeight = '500';
            } else {
                counter.style.color = '#64748b';
                counter.style.fontWeight = '400';
            }
        }

        if (titleInput && titleCounter) {
            updateCounter(titleInput, titleCounter, 200);
            titleInput.addEventListener('input', () => updateCounter(titleInput, titleCounter, 200));
        }

        if (descriptionInput && descriptionCounter) {
            updateCounter(descriptionInput, descriptionCounter, 500);
            descriptionInput.addEventListener('input', () => updateCounter(descriptionInput, descriptionCounter, 500));
        }

        if (contentInput && contentCounter) {
            updateCounter(contentInput, contentCounter);
            contentInput.addEventListener('input', () => updateCounter(contentInput, contentCounter));
        }

        // Sauvegarde automatique avec Ctrl+S
        contentInput.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                showSaveNotification();
            }
        });

        function showSaveNotification() {
            const notification = document.createElement('div');
            notification.className = 'position-fixed bottom-0 end-0 m-3 p-3 bg-success text-white rounded shadow';
            notification.style.zIndex = '9999';
            notification.innerHTML = `
                <i class="bi bi-check-circle me-2"></i>
                Traduction sauvegardée automatiquement
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Formatage de texte simple
        window.formatText = function(type) {
            if (!contentInput) return;

            const start = contentInput.selectionStart;
            const end = contentInput.selectionEnd;
            const selectedText = contentInput.value.substring(start, end);
            let formattedText = '';

            switch(type) {
                case 'bold':
                    formattedText = `**${selectedText}**`;
                    break;
                case 'italic':
                    formattedText = `*${selectedText}*`;
                    break;
                case 'underline':
                    formattedText = `__${selectedText}__`;
                    break;
            }

            contentInput.setRangeText(formattedText, start, end, 'end');
            contentInput.focus();
            updateCounter(contentInput, contentCounter);
        };

        // Afficher le drapeau de la langue sélectionnée
        const langueSelect = document.querySelector('select[name="langue_id"]');
        if (langueSelect) {
            const flagContainer = document.createElement('div');
            flagContainer.className = 'position-absolute end-0 top-0 h-100 d-flex align-items-center pe-3';
            flagContainer.style.pointerEvents = 'none';

            const inputGroup = document.querySelector('.input-group');
            if (inputGroup) {
                inputGroup.style.position = 'relative';
                inputGroup.appendChild(flagContainer);

                function updateFlag() {
                    const selectedOption = langueSelect.options[langueSelect.selectedIndex];
                    const flagUrl = selectedOption.getAttribute('data-flag');

                    if (flagUrl) {
                        flagContainer.innerHTML = `<img src="${flagUrl}" alt="" style="width: 20px; height: auto; border-radius: 3px;">`;
                    } else {
                        flagContainer.innerHTML = '';
                    }
                }

                updateFlag();
                langueSelect.addEventListener('change', updateFlag);
            }
        }
    });
</script>
