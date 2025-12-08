@extends('admin.layouts')

@section('title', 'Ajouter une Langue')

@section('content')

<style>
    /* Styles généraux */
    .form-container {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 12px 40px rgba(30, 27, 75, 0.08);
        border: 1px solid rgba(30, 27, 75, 0.05);
        position: relative;
        overflow: hidden;
    }

    .form-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, #8a2be2, #1e1b4b, #d4a017);
    }

    /* En-tête */
    .page-header {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(30, 27, 75, 0.1);
    }

    .page-title {
        color: #1e1b4b;
        font-weight: 800;
        font-size: 2.2rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-title i {
        background: linear-gradient(135deg, #8a2be2, #d4a017);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 2.4rem;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 1.1rem;
        margin-top: 10px;
        padding-left: 45px;
    }

    /* Messages d'erreur */
    .alert-container {
        border-radius: 14px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(248, 113, 113, 0.05));
        border: 2px solid #ef4444;
        border-left: 6px solid #ef4444;
        color: #dc2626;
        padding: 25px;
        border-radius: 14px;
    }

    .alert-danger strong {
        color: #b91c1c;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    .alert-danger ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert-danger li {
        margin-bottom: 8px;
        padding-left: 10px;
        position: relative;
    }

    .alert-danger li::before {
        content: '•';
        color: #ef4444;
        font-weight: bold;
        position: absolute;
        left: -10px;
    }

    /* Labels de formulaire */
    .form-label-premium {
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-label-premium i {
        color: #8a2be2;
        font-size: 1.2rem;
    }

    .required::after {
        content: ' *';
        color: #ef4444;
        font-weight: bold;
    }

    /* Champs de formulaire */
    .form-control-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 16px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
    }

    .form-control-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }

    .form-control-enhanced.is-invalid {
        border-color: #ef4444;
        background: rgba(239, 68, 68, 0.02);
    }

    .form-control-enhanced.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
    }

    /* Messages d'erreur des champs */
    .invalid-feedback {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #dc2626;
        font-weight: 500;
        margin-top: 8px;
        padding: 10px 15px;
        background: rgba(239, 68, 68, 0.05);
        border-radius: 8px;
        border-left: 3px solid #ef4444;
    }

    .invalid-feedback i {
        font-size: 1.1rem;
    }

    /* Upload d'icône */
    .icon-upload-container {
        border: 2px dashed rgba(30, 27, 75, 0.2);
        border-radius: 14px;
        padding: 30px;
        text-align: center;
        background: rgba(30, 27, 75, 0.01);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .icon-upload-container:hover {
        border-color: #8a2be2;
        background: rgba(138, 43, 226, 0.03);
    }

    .icon-upload-container:hover .upload-icon {
        transform: scale(1.1);
        color: #8a2be2;
    }

    .icon-preview {
        width: 100px;
        height: 100px;
        object-fit: contain;
        margin: 0 auto 20px;
        display: block;
        border-radius: 12px;
        background: white;
        padding: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        border: 2px solid rgba(30, 27, 75, 0.1);
        transition: all 0.3s ease;
    }

    .icon-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .upload-icon {
        font-size: 3rem;
        color: #9ca3af;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .upload-text {
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .upload-subtext {
        color: #9ca3af;
        font-size: 0.9rem;
        margin-bottom: 15px;
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

    /* Switch de statut */
    .status-container {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.03), rgba(138, 43, 226, 0.03));
        border-radius: 14px;
        padding: 25px;
        border: 2px solid rgba(30, 27, 75, 0.1);
        transition: all 0.3s ease;
    }

    .status-container:hover {
        border-color: #8a2be2;
        background: linear-gradient(135deg, rgba(138, 43, 226, 0.05), rgba(212, 160, 23, 0.05));
    }

    .status-label {
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        font-weight: 700;
        color: #1e1b4b;
        font-size: 1.1rem;
        margin-bottom: 15px;
    }

    .status-label i {
        color: #8a2be2;
        font-size: 1.4rem;
    }

    .status-switch {
        position: relative;
        display: inline-block;
        width: 70px;
        height: 34px;
    }

    .status-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .status-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #e0e0e0, #b0b0b0);
        transition: .4s;
        border-radius: 34px;
    }

    .status-slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background: white;
        transition: .4s;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    input:checked + .status-slider {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
    }

    input:checked + .status-slider:before {
        transform: translateX(36px);
    }

    .status-text {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-weight: 600;
        color: #6b7280;
    }

    .status-active {
        color: #10b981;
    }

    .status-inactive {
        color: #ef4444;
    }

    /* Textarea */
    .textarea-enhanced {
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 18px 20px;
        font-size: 1rem;
        line-height: 1.6;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        resize: vertical;
        min-height: 120px;
    }

    .textarea-enhanced:focus {
        border-color: #8a2be2;
        box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        outline: none;
    }

    .textarea-enhanced.is-invalid {
        border-color: #ef4444;
        background: rgba(239, 68, 68, 0.02);
    }

    /* Boutons */
    .btn-submit {
        background: linear-gradient(135deg, #8a2be2, #1e1b4b);
        color: white;
        border: none;
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 6px 20px rgba(138, 43, 226, 0.2);
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #9b4dff, #2a2470);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(138, 43, 226, 0.3);
        color: white;
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: white;
        color: #6b7280;
        border: 2px solid #e0e0e0;
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #f8f9fa;
        border-color: #9ca3af;
        color: #374151;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Informations de champ */
    .field-info {
        font-size: 0.85rem;
        color: #9ca3af;
        margin-top: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .field-info i {
        font-size: 0.9rem;
    }

    /* Drapeau exemple */
    .flag-example {
        background: linear-gradient(135deg, rgba(30, 27, 75, 0.03), rgba(138, 43, 226, 0.03));
        border-radius: 12px;
        padding: 15px;
        margin-top: 15px;
        border: 1px solid rgba(30, 27, 75, 0.1);
    }

    .flag-example-title {
        font-weight: 600;
        color: #1e1b4b;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .flag-example-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .flag-example-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        background: white;
        border-radius: 8px;
        border: 1px solid rgba(30, 27, 75, 0.1);
        font-size: 0.9rem;
        color: #6b7280;
    }

    .flag-example-item i {
        color: #8a2be2;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-container {
            padding: 25px;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .btn-submit, .btn-cancel {
            width: 100%;
            justify-content: center;
            margin-bottom: 10px;
        }
    }
</style>

<div class="mb-5">
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-translate"></i>
            Ajouter une Nouvelle Langue
        </h1>
        <p class="page-subtitle">
            <i class="bi bi-info-circle"></i>
            Enrichissez le patrimoine linguistique du Bénin en ajoutant une nouvelle langue
        </p>
    </div>
</div>

<!-- Messages d'erreur -->
@if ($errors->any())
    <div class="alert-container">
        <div class="alert-danger">
            <strong>
                <i class="bi bi-exclamation-triangle"></i>
                Des erreurs sont présentes dans le formulaire
            </strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="form-container">
    <form action="{{ route('admin.langues.store') }}"
          method="POST"
          enctype="multipart/form-data"
          id="langueForm">
        @csrf

        <div class="row g-4">

            <!-- Nom de la langue -->
            <div class="col-lg-6">
                <label class="form-label-premium required">
                    <i class="bi bi-fonts"></i>
                    Nom de la langue
                </label>
                <input type="text"
                       name="nom"
                       class="form-control-enhanced @error('nom') is-invalid @enderror"
                       value="{{ old('nom') }}"
                       placeholder="Ex : Français, Fon, Yoruba"
                       required>
                @error('nom')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="field-info">
                    <i class="bi bi-lightbulb"></i>
                    Utilisez le nom officiel de la langue
                </div>
            </div>

            <!-- Code ISO -->
            <div class="col-lg-6">
                <label class="form-label-premium required">
                    <i class="bi bi-code-slash"></i>
                    Code ISO
                </label>
                <input type="text"
                       name="code"
                       class="form-control-enhanced @error('code') is-invalid @enderror"
                       value="{{ old('code') }}"
                       placeholder="Ex : fr, fon, yor"
                       required
                       maxlength="3">
                @error('code')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="field-info">
                    <i class="bi bi-info-circle"></i>
                    Code ISO 639-1 (2 ou 3 lettres, minuscules)
                </div>
                
                <!-- Exemples de codes -->
                <div class="flag-example">
                    <div class="flag-example-title">Exemples de codes :</div>
                    <div class="flag-example-list">
                        <div class="flag-example-item">
                            <i class="bi bi-flag"></i>
                            Français = fr
                        </div>
                        <div class="flag-example-item">
                            <i class="bi bi-flag"></i>
                            English = en
                        </div>
                        <div class="flag-example-item">
                            <i class="bi bi-flag"></i>
                            Yoruba = yo
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label-premium">
                    <i class="bi bi-card-text"></i>
                    Description
                </label>
                <textarea name="description"
                          rows="4"
                          class="textarea-enhanced @error('description') is-invalid @enderror"
                          placeholder="Décrivez la langue, son origine, son importance culturelle...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="field-info">
                    <i class="bi bi-pencil"></i>
                    Optionnel - Décrivez l'importance culturelle de cette langue
                </div>
            </div>

            <!-- Icône / Drapeau -->
            <div class="col-lg-6">
                <label class="form-label-premium">
                    <i class="bi bi-flag"></i>
                    Drapeau / Icône
                </label>
                
                <div class="icon-upload-container" onclick="document.getElementById('iconInput').click()">
                    <img id="iconPreview" class="icon-preview" 
                         src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='12' fill='%23f3f4f6'/%3E%3Ctext x='50' y='50' font-family='Arial' font-size='40' fill='%239ca3af' text-anchor='middle' dy='.3em'%3E🏳️%3C/text%3E%3C/svg%3E"
                         alt="Aperçu de l'icône">
                    
                    <div class="upload-icon">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    
                    <div class="upload-text">Cliquez pour télécharger un drapeau</div>
                    <div class="upload-subtext">PNG, JPG ou SVG • Max 2MB</div>
                    
                    <input type="file" 
                           name="icone" 
                           id="iconInput" 
                           class="file-input"
                           accept="image/*"
                           onchange="previewIcon(event)">
                </div>
                
                @error('icone')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror
                <div class="field-info">
                    <i class="bi bi-image"></i>
                    Téléchargez le drapeau ou une icône représentative
                </div>
            </div>

            <!-- Statut -->
            <div class="col-lg-6">
                <label class="form-label-premium">
                    <i class="bi bi-toggle-on"></i>
                    Statut de la langue
                </label>
                
                <div class="status-container">
                    <label class="status-label">
                        <i class="bi bi-power"></i>
                        Activer cette langue ?
                    </label>
                    
                    <div class="d-flex align-items-center gap-4">
                        <label class="status-switch">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="activeSwitch"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="status-slider"></span>
                        </label>
                        
                        <div class="status-text">
                            <span class="status-inactive" id="statusInactive">Inactive</span>
                            <span class="status-active" id="statusActive">Active</span>
                        </div>
                    </div>
                    
                    <div class="field-info mt-3">
                        <i class="bi bi-info-circle"></i>
                        Les langues actives seront disponibles pour les contenus
                    </div>
                </div>
            </div>

        </div>

        <!-- Boutons d'action -->
        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
            <div>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-plus-circle"></i>
                    Ajouter la langue
                </button>
                
                <a href="{{ route('admin.langues.index') }}" class="btn-cancel ms-3">
                    <i class="bi bi-arrow-left"></i>
                    Retour à la liste
                </a>
            </div>
            
            <div class="text-muted">
                <i class="bi bi-asterisk"></i>
                Les champs marqués * sont obligatoires
            </div>
        </div>

    </form>
</div>

<!-- Scripts -->
<script>
// Prévisualisation de l'icône
function previewIcon(event) {
    const input = event.target;
    const preview = document.getElementById('iconPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.parentElement.querySelector('.upload-text').textContent = 'Drapeau sélectionné';
            preview.parentElement.querySelector('.upload-icon').innerHTML = '<i class="bi bi-check-circle-fill" style="color: #10b981;"></i>';
        }
        
        reader.readAsDataURL(input.files[0]);
        
        // Vérifier la taille du fichier
        if (input.files[0].size > 2 * 1024 * 1024) {
            alert('Le fichier est trop volumineux. Taille maximale : 2MB');
            input.value = '';
            preview.src = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Crect width='100' height='100' rx='12' fill='%23f3f4f6'/%3E%3Ctext x='50' y='50' font-family='Arial' font-size='40' fill='%239ca3af' text-anchor='middle' dy='.3em'%3E🏳️%3C/text%3E%3C/svg%3E";
            preview.parentElement.querySelector('.upload-text').textContent = 'Cliquez pour télécharger un drapeau';
            preview.parentElement.querySelector('.upload-icon').innerHTML = '<i class="bi bi-cloud-arrow-up"></i>';
        }
    }
}

// Gérer l'affichage du statut
const activeSwitch = document.getElementById('activeSwitch');
const statusActive = document.getElementById('statusActive');
const statusInactive = document.getElementById('statusInactive');

function updateStatusDisplay() {
    if (activeSwitch.checked) {
        statusActive.style.fontWeight = '700';
        statusActive.style.opacity = '1';
        statusInactive.style.fontWeight = '400';
        statusInactive.style.opacity = '0.6';
    } else {
        statusInactive.style.fontWeight = '700';
        statusInactive.style.opacity = '1';
        statusActive.style.fontWeight = '400';
        statusActive.style.opacity = '0.6';
    }
}

activeSwitch.addEventListener('change', updateStatusDisplay);
updateStatusDisplay(); // Initialiser l'affichage

// Validation du formulaire
document.getElementById('langueForm').addEventListener('submit', function(e) {
    const nom = this.querySelector('input[name="nom"]').value.trim();
    const code = this.querySelector('input[name="code"]').value.trim();
    
    if (!nom) {
        e.preventDefault();
        alert('Veuillez saisir un nom pour la langue.');
        this.querySelector('input[name="nom"]').focus();
        return;
    }
    
    if (!code) {
        e.preventDefault();
        alert('Veuillez saisir un code pour la langue.');
        this.querySelector('input[name="code"]').focus();
        return;
    }
    
    // Valider le format du code (2-3 lettres minuscules)
    const codeRegex = /^[a-z]{2,3}$/;
    if (!codeRegex.test(code)) {
        e.preventDefault();
        alert('Le code doit contenir 2 ou 3 lettres minuscules.');
        this.querySelector('input[name="code"]').focus();
        return;
    }
});

// Mise en évidence des champs requis
document.querySelectorAll('input[required], textarea[required]').forEach(field => {
    field.addEventListener('blur', function() {
        if (!this.value.trim()) {
            this.style.borderColor = '#ef4444';
            this.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
        } else {
            this.style.borderColor = '#8a2be2';
            this.style.boxShadow = '0 0 0 4px rgba(138, 43, 226, 0.15)';
        }
    });
});
</script>

@endsection