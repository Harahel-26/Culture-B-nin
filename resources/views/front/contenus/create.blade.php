@extends('front.layouts.app')

@section('title', 'Créer un contenu - Culture Bénin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-plus-circle"></i> Créer un nouveau contenu culturel
                        </h4>
                        <a href="{{ route('front.profil.contenus') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left"></i> Mes contenus
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('front.contenus.store') }}" method="POST" enctype="multipart/form-data" id="createForm">
                        @csrf
                        
                        <!-- Étape 1 : Informations de base -->
                        <div class="mb-5">
                            <h5 class="border-bottom pb-2 mb-3">
                                <span class="badge bg-primary rounded-circle">1</span>
                                Informations de base
                            </h5>
                            
                            <!-- Titre -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Titre du contenu *</label>
                                <input type="text" 
                                       name="titre" 
                                       class="form-control form-control-lg @error('titre') is-invalid @enderror" 
                                       value="{{ old('titre') }}"
                                       placeholder="Ex: Le conte de la tortue et du lièvre en langue Fon"
                                       required>
                                @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Un titre clair et descriptif qui attire l'attention.</small>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Description *</label>
                                <textarea name="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="4"
                                          placeholder="Brève description de votre contenu..."
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Cette description apparaîtra dans les listes et résultats de recherche (max 500 caractères).</small>
                            </div>

                            <!-- Contenu texte -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Contenu complet *</label>
                                <textarea name="contenu_texte" 
                                          class="form-control @error('contenu_texte') is-invalid @enderror" 
                                          rows="15"
                                          placeholder="Rédigez ici votre contenu complet..."
                                          required>{{ old('contenu_texte') }}</textarea>
                                @error('contenu_texte')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Vous pouvez utiliser des paragraphes, des titres, etc. Ce contenu sera formaté automatiquement.</small>
                            </div>
                        </div>

                        <!-- Étape 2 : Catégorisation -->
                        <div class="mb-5">
                            <h5 class="border-bottom pb-2 mb-3">
                                <span class="badge bg-primary rounded-circle">2</span>
                                Catégorisation
                            </h5>
                            
                            <div class="row">
                                <!-- Langue -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Langue *</label>
                                    <select name="langue_id" class="form-select @error('langue_id') is-invalid @enderror" required>
                                        <option value="">Choisir une langue</option>
                                        @foreach($langues as $langue)
                                        <option value="{{ $langue->id }}" {{ old('langue_id') == $langue->id ? 'selected' : '' }}>
                                            {{ $langue->nom }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('langue_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Région -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Région</label>
                                    <select name="region_id" class="form-select @error('region_id') is-invalid @enderror">
                                        <option value="">Sélectionner une région</option>
                                        <option value="">Non spécifié</option>
                                        @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->nom }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('region_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Type de contenu -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Type de contenu *</label>
                                    <select name="typecontenu_id" class="form-select @error('typecontenu_id') is-invalid @enderror" required>
                                        <option value="">Choisir un type</option>
                                        @foreach($typecontenus as $type)
                                        <option value="{{ $type->id }}" {{ old('typecontenu_id') == $type->id ? 'selected' : '' }}>
                                            <i class="bi bi-{{ $type->icone ?? 'file-earmark' }}"></i> {{ $type->nom }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('typecontenu_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Étape 3 : Médias -->
                        <div class="mb-5">
                            <h5 class="border-bottom pb-2 mb-3">
                                <span class="badge bg-primary rounded-circle">3</span>
                                Médias et visuel
                            </h5>
                            
                            <!-- Image de couverture -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Image de couverture</label>
                                <div class="card border-dashed">
                                    <div class="card-body text-center py-5">
                                        <div id="imagePreview" class="mb-3" style="display: none;">
                                            <img src="" alt="Preview" class="img-thumbnail mb-3" style="max-height: 200px;">
                                        </div>
                                        <i class="bi bi-image text-muted display-4 mb-3"></i>
                                        <p class="text-muted">Glissez-déposez une image ou cliquez pour sélectionner</p>
                                        <input type="file" 
                                               name="image_couverture" 
                                               id="image_couverture"
                                               class="form-control d-none @error('image_couverture') is-invalid @enderror"
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('image_couverture').click()">
                                            <i class="bi bi-upload"></i> Choisir une image
                                        </button>
                                        @error('image_couverture')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted d-block mt-2">Format recommandé : 1200x630px. JPEG, PNG - Max 2MB</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Étape 4 : Options premium -->
                        <div class="mb-5">
                            <h5 class="border-bottom pb-2 mb-3">
                                <span class="badge bg-primary rounded-circle">4</span>
                                Options de monétisation
                            </h5>
                            
                            <div class="card">
                                <div class="card-header bg-warning text-dark">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="is_premium" 
                                               id="is_premium" 
                                               value="1"
                                               {{ old('is_premium') ? 'checked' : '' }}
                                               onchange="togglePremiumFields()"
                                               style="transform: scale(1.5);">
                                        <label class="form-check-label fw-bold fs-5" for="is_premium">
                                            <i class="bi bi-star-fill"></i> Rendre ce contenu premium
                                        </label>
                                    </div>
                                </div>
                                <div class="card-body" id="premiumFields" style="{{ old('is_premium') ? '' : 'display: none;' }}">
                                    <div class="alert alert-warning">
                                        <i class="bi bi-info-circle"></i>
                                        <strong>Contenu premium :</strong> Les utilisateurs devront acheter ce contenu pour y accéder complètement.
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Prix (FCFA) *</label>
                                            <div class="input-group">
                                                <input type="number" 
                                                       name="prix" 
                                                       class="form-control @error('prix') is-invalid @enderror" 
                                                       value="{{ old('prix', 500) }}"
                                                       min="100"
                                                       step="100"
                                                       id="prixInput">
                                                <span class="input-group-text">FCFA</span>
                                            </div>
                                            @error('prix')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Minimum 100 FCFA. Vous recevrez 80% du prix.</small>
                                            
                                            <!-- Échelle de prix suggérée -->
                                            <div class="mt-3">
                                                <small class="text-muted d-block mb-2">Prix suggérés :</small>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setPrice(500)">500 FCFA</button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setPrice(1000)">1 000 FCFA</button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setPrice(2000)">2 000 FCFA</button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="setPrice(5000)">5 000 FCFA</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Aperçu gratuit</label>
                                            <textarea name="extrait_gratuit" 
                                                      class="form-control" 
                                                      rows="5"
                                                      placeholder="Texte visible gratuitement avant achat...">{{ old('extrait_gratuit') }}</textarea>
                                            <small class="text-muted">Les utilisateurs pourront lire cet extrait gratuitement avant de décider d'acheter.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations importantes -->
                        <div class="alert alert-info">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-info-circle fs-4"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="alert-heading">Informations importantes</h5>
                                    <ul class="mb-0">
                                        <li>Votre contenu sera soumis à validation par un modérateur avant publication.</li>
                                        <li>Assurez-vous de respecter les droits d'auteur et la qualité du contenu.</li>
                                        <li>Les contenus premium génèrent des revenus partagés avec la plateforme (80% pour vous).</li>
                                        <li>Vous pourrez modifier votre contenu tant qu'il n'est pas validé.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-between align-items-center border-top pt-4">
                            <div>
                                <a href="{{ route('front.profil.contenus') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Annuler
                                </a>
                                <button type="button" class="btn btn-outline-primary" onclick="saveDraft()">
                                    <i class="bi bi-save"></i> Sauvegarder comme brouillon
                                </button>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send-check"></i> Soumettre pour validation
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Prévisualisation d'image
    function previewImage(event) {
        const reader = new FileReader();
        const preview = document.getElementById('imagePreview');
        const img = preview.querySelector('img');
        
        reader.onload = function() {
            img.src = reader.result;
            preview.style.display = 'block';
        }
        
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
    
    // Basculer les champs premium
    function togglePremiumFields() {
        const isPremium = document.getElementById('is_premium').checked;
        const premiumFields = document.getElementById('premiumFields');
        const prixInput = document.getElementById('prixInput');
        
        premiumFields.style.display = isPremium ? 'block' : 'none';
        if (isPremium) {
            prixInput.required = true;
        } else {
            prixInput.required = false;
        }
    }
    
    // Définir le prix
    function setPrice(price) {
        document.getElementById('prixInput').value = price;
    }
    
    // Sauvegarder comme brouillon
    function saveDraft() {
        const form = document.getElementById('createForm');
        const draftInput = document.createElement('input');
        draftInput.type = 'hidden';
        draftInput.name = 'status';
        draftInput.value = 'draft';
        form.appendChild(draftInput);
        form.submit();
    }
    
    // Initialiser
    document.addEventListener('DOMContentLoaded', function() {
        togglePremiumFields();
    });
</script>
@endpush

@push('styles')
<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
    }
    .border-dashed:hover {
        border-color: #0d6efd;
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>
@endpush