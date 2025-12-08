@extends('admin.layouts')

@section('title', 'Nouvelle traduction')

@section('content')

<style>
    :root {
        --admin-primary: #1e1b4b;
        --admin-secondary: #8a2be2;
        --admin-accent: #6366f1;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-light: #f8f9fa;
        --admin-dark: #0f172a;
        --admin-gray: #64748b;
    }

    .translation-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 35px rgba(30, 27, 75, 0.1);
        border: 1px solid rgba(138, 43, 226, 0.1);
        position: relative;
        overflow: hidden;
    }

    .translation-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--admin-secondary), var(--admin-accent));
    }

    .card-header {
        background: none;
        border-bottom: 2px solid rgba(138, 43, 226, 0.1);
        padding-bottom: 20px;
        margin-bottom: 25px;
    }

    .card-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: var(--admin-primary);
        font-size: 1.8rem;
        display: flex;
        align-items: center;
        gap: 15px;
        margin: 0;
    }

    .content-preview {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(99, 102, 241, 0.05));
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(138, 43, 226, 0.1);
        position: relative;
        overflow: hidden;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(138, 43, 226, 0.1);
    }

    .content-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        color: var(--admin-primary);
        font-size: 1.4rem;
        margin: 0;
    }

    .content-badge {
        background: linear-gradient(135deg, var(--admin-secondary), #7c3aed);
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .preview-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-weight: 600;
        color: var(--admin-dark);
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .info-value {
        color: var(--admin-gray);
        font-size: 1rem;
    }

    .content-excerpt {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-top: 20px;
        border-left: 4px solid var(--admin-secondary);
        font-style: italic;
        color: var(--admin-dark);
        line-height: 1.6;
    }

    .content-excerpt::before {
        content: '"';
        font-size: 2rem;
        color: var(--admin-secondary);
        opacity: 0.3;
        margin-right: 5px;
    }

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
        padding: 16px 20px;
    }

    .alert-info {
        background: linear-gradient(135deg, rgba(0, 123, 255, 0.1), rgba(0, 123, 255, 0.05));
        color: #0c5460;
        border-left: 4px solid #0dcaf0;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(239, 68, 68, 0.05));
        color: #991b1b;
        border-left: 4px solid var(--admin-danger);
    }

    .alert ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid rgba(138, 43, 226, 0.1);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-save-draft {
        background: linear-gradient(135deg, var(--admin-warning), #d97706);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-save-draft:hover {
        background: linear-gradient(135deg, #d97706, #b45309);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    }

    .btn-cancel {
        background: white;
        color: var(--admin-gray);
        border: 2px solid #e2e8f0;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel:hover {
        background: var(--admin-light);
        border-color: var(--admin-secondary);
        color: var(--admin-dark);
    }

    .guidance-section {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), rgba(245, 158, 11, 0.02));
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        border: 1px solid rgba(245, 158, 11, 0.1);
    }

    .guidance-title {
        font-weight: 600;
        color: var(--admin-dark);
        font-size: 1.1rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .guidance-title i {
        color: var(--admin-warning);
    }

    .guidance-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }

    .guidance-item {
        padding: 8px 0;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: var(--admin-dark);
    }

    .guidance-item i {
        color: var(--admin-success);
        margin-top: 3px;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .translation-card {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .preview-header {
            flex-direction: column;
            gap: 10px;
        }

        .preview-info {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit,
        .btn-save-draft,
        .btn-cancel {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="translation-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-plus-circle"></i>
            Nouvelle traduction
        </h3>
    </div>

    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <strong><i class="bi bi-exclamation-triangle me-2"></i>Veuillez corriger les erreurs suivantes :</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Aperçu du contenu original -->
        <div class="content-preview">
            <div class="preview-header">
                <h4 class="content-title">Contenu à traduire</h4>
                <span class="content-badge">
                    <i class="bi bi-file-earmark-text"></i>
                    {{ $contenu->typecontenu->nom ?? 'Contenu' }}
                </span>
            </div>

            <div class="preview-info">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-card-heading"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Titre original</div>
                        <div class="info-value">{{ $contenu->titre }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Langue originale</div>
                        <div class="info-value">{{ $contenu->langue->nom }} ({{ $contenu->langue->code }})</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Auteur</div>
                        <div class="info-value">{{ $contenu->auteur ?? 'Non spécifié' }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="bi bi-calendar"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-label">Date de publication</div>
                        <div class="info-value">{{ $contenu->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            @if($contenu->description)
            <div class="content-excerpt">
                {{ Str::limit($contenu->description, 200) }}
            </div>
            @endif

            <div class="text-end mt-3">
                <a href="{{ route('admin.contenus.show', $contenu) }}"
                   class="btn btn-sm btn-outline-secondary"
                   target="_blank">
                    <i class="bi bi-eye me-1"></i>
                    Voir le contenu complet
                </a>
            </div>
        </div>

        <!-- Conseils de traduction -->
        <div class="guidance-section">
            <h5 class="guidance-title">
                <i class="bi bi-lightbulb"></i>
                Conseils pour une bonne traduction
            </h5>
            <ul class="guidance-list">
                <li class="guidance-item">
                    <i class="bi bi-check-circle"></i>
                    <span>Traduisez le sens, pas mot à mot</span>
                </li>
                <li class="guidance-item">
                    <i class="bi bi-check-circle"></i>
                    <span>Adaptez les références culturelles au contexte béninois</span>
                </li>
                <li class="guidance-item">
                    <i class="bi bi-check-circle"></i>
                    <span>Respectez le style et le ton du texte original</span>
                </li>
                <li class="guidance-item">
                    <i class="bi bi-check-circle"></i>
                    <span>Vérifiez la grammaire et l'orthographe avant de soumettre</span>
                </li>
            </ul>
        </div>

        <!-- Formulaire de traduction -->
        <form action="{{ route('admin.traductions.store') }}" method="POST" id="translationForm">
            @csrf
            <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

            <!-- Champs du formulaire -->
            @include('admin.traductions.form')

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-send-check"></i>
                    Soumettre la traduction
                </button>

                <button type="button" class="btn-save-draft" id="saveDraftBtn">
                    <i class="bi bi-save"></i>
                    Sauvegarder comme brouillon
                </button>

                <a href="{{ url()->previous() }}" class="btn-cancel">
                    <i class="bi bi-x-circle"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestionnaire de sauvegarde de brouillon
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const form = document.getElementById('translationForm');

        if (saveDraftBtn) {
            saveDraftBtn.addEventListener('click', function() {
                // Créer un champ caché pour indiquer qu'il s'agit d'un brouillon
                let draftField = form.querySelector('input[name="draft"]');
                if (!draftField) {
                    draftField = document.createElement('input');
                    draftField.type = 'hidden';
                    draftField.name = 'draft';
                    draftField.value = 'true';
                    form.appendChild(draftField);
                }

                // Soumettre le formulaire
                form.submit();
            });
        }

        // Avertissement avant de quitter avec des modifications non sauvegardées
        let hasUnsavedChanges = false;
        const formInputs = form.querySelectorAll('input, textarea, select');

        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                hasUnsavedChanges = true;
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (hasUnsavedChanges) {
                e.preventDefault();
                e.returnValue = 'Vous avez des modifications non sauvegardées. Êtes-vous sûr de vouloir quitter ?';
            }
        });

        form.addEventListener('submit', function() {
            hasUnsavedChanges = false;
        });

        // Afficher le texte original pour aider la traduction
        const originalContent = `{{ addslashes($contenu->contenu_texte ?? '') }}`;

        if (originalContent) {
            // Créer un bouton pour afficher le texte original
            const showOriginalBtn = document.createElement('button');
            showOriginalBtn.type = 'button';
            showOriginalBtn.className = 'btn btn-sm btn-outline-primary mb-3';
            showOriginalBtn.innerHTML = '<i class="bi bi-eye me-1"></i> Voir le texte original';
            showOriginalBtn.addEventListener('click', function() {
                showOriginalText(originalContent);
            });

            // Insérer le bouton avant le textarea du contenu
            const contentTextarea = document.querySelector('textarea[name="contenu_texte"]');
            if (contentTextarea) {
                contentTextarea.parentNode.insertBefore(showOriginalBtn, contentTextarea);
            }
        }

        function showOriginalText(text) {
            // Créer une modale pour afficher le texte original
            const modal = document.createElement('div');
            modal.className = 'modal fade';
            modal.id = 'originalTextModal';
            modal.innerHTML = `
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bi bi-file-text me-2"></i>
                                Texte original - ${document.title}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="bg-light p-3 rounded mb-3">
                                <pre style="white-space: pre-wrap; font-family: inherit; margin: 0;">${text}</pre>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg me-1"></i>
                                Fermer
                            </button>
                        </div>
                    </div>
                </div>
            `;

            document.body.appendChild(modal);

            // Afficher la modale
            const bsModal = new bootstrap.Modal(modal);
            bsModal.show();

            // Nettoyer après la fermeture
            modal.addEventListener('hidden.bs.modal', function() {
                modal.remove();
            });
        }
    });
</script>

@endsection
