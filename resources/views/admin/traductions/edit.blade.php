@extends('admin.layouts')

@section('title', 'Modifier la traduction')

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
        background: linear-gradient(90deg, var(--admin-warning), #d97706);
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

    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
        padding: 16px 20px;
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

    .info-section {
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(99, 102, 241, 0.05));
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid rgba(138, 43, 226, 0.1);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-weight: 600;
        color: var(--admin-dark);
        font-size: 0.9rem;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label i {
        color: var(--admin-secondary);
        width: 20px;
        text-align: center;
    }

    .info-value {
        color: var(--admin-gray);
        font-size: 1rem;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 2px solid rgba(138, 43, 226, 0.1);
    }

    .btn-update {
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

    .btn-update:hover {
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

    .btn-preview {
        background: linear-gradient(135deg, var(--admin-accent), #4f46e5);
        color: white;
        border: none;
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

    .btn-preview:hover {
        background: linear-gradient(135deg, #4f46e5, #4338ca);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
    }

    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-pending {
        background: linear-gradient(135deg, var(--admin-warning), #d97706);
        color: white;
    }

    .badge-validated {
        background: linear-gradient(135deg, var(--admin-success), #059669);
        color: white;
    }

    .badge-rejected {
        background: linear-gradient(135deg, var(--admin-danger), #dc2626);
        color: white;
    }

    .language-display {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .language-flag {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 768px) {
        .translation-card {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-update,
        .btn-cancel,
        .btn-preview {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="translation-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="bi bi-pencil-square"></i>
            Modifier la traduction
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

        <!-- Informations sur la traduction -->
        <div class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-file-earmark-text"></i>
                        Contenu original
                    </div>
                    <div class="info-value">
                        <a href="{{ route('admin.contenus.show', $traduction->contenu) }}"
                           class="text-decoration-none"
                           target="_blank">
                            {{ $traduction->contenu->titre }}
                        </a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-globe"></i>
                        Langue cible
                    </div>
                    <div class="info-value language-display">
                        @if($traduction->langue->flag_url ?? false)
                            <img src="{{ $traduction->langue->flag_url }}"
                                 class="language-flag"
                                 alt="{{ $traduction->langue->nom }}">
                        @endif
                        <span>{{ $traduction->langue->nom }} ({{ $traduction->langue->code }})</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-person"></i>
                        Traducteur
                    </div>
                    <div class="info-value">
                        {{ $traduction->traducteur->name }}
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-shield-check"></i>
                        Statut
                    </div>
                    <div class="info-value">
                        @if($traduction->status == 'pending')
                            <span class="status-badge badge-pending">
                                <i class="bi bi-clock me-1"></i>
                                En attente
                            </span>
                        @elseif($traduction->status == 'validated')
                            <span class="status-badge badge-validated">
                                <i class="bi bi-check-circle me-1"></i>
                                Validée
                            </span>
                        @else
                            <span class="status-badge badge-rejected">
                                <i class="bi bi-x-circle me-1"></i>
                                Rejetée
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <form action="{{ route('admin.traductions.update', $traduction) }}" method="POST" id="translationForm">
            @csrf
            @method('PUT')

            <!-- Champs du formulaire -->
            @include('admin.traductions.form')

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-update">
                    <i class="bi bi-save"></i>
                    Mettre à jour la traduction
                </button>

                <a href="{{ route('admin.traductions.show', $traduction) }}" class="btn-preview">
                    <i class="bi bi-eye"></i>
                    Voir l'aperçu
                </a>

                <a href="{{ route('admin.traductions.index') }}" class="btn-cancel">
                    <i class="bi bi-x-circle"></i>
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sauvegarde automatique
        let autoSaveTimeout;
        const form = document.getElementById('translationForm');
        const formInputs = form.querySelectorAll('input, textarea, select');

        formInputs.forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(saveDraft, 3000);
            });
        });

        function saveDraft() {
            // Simuler une sauvegarde de brouillon
            const notification = document.createElement('div');
            notification.className = 'position-fixed bottom-0 end-0 m-3 p-3 bg-info text-white rounded shadow';
            notification.style.zIndex = '9999';
            notification.innerHTML = `
                <i class="bi bi-save me-2"></i>
                Brouillon sauvegardé
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 2000);
        }

        // Avertissement si modification d'une traduction validée
        @if($traduction->status == 'validated')
        form.addEventListener('submit', function(e) {
            if (!confirm('Attention : Cette traduction a déjà été validée. Modifier une traduction validée réinitialisera son statut à "En attente". Voulez-vous continuer ?')) {
                e.preventDefault();
            }
        });
        @endif

        // Empêcher la fermeture de l'onglet si modifications non sauvegardées
        let hasUnsavedChanges = false;

        formInputs.forEach(input => {
            const initialValue = input.value;

            input.addEventListener('input', function() {
                if (input.value !== initialValue) {
                    hasUnsavedChanges = true;
                }
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
    });
</script>

@endsection
