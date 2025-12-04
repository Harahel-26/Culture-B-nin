@extends('front.layouts.app')

@section('title', 'Modifier : ' . $contenu->titre . ' - Culture Bénin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Modifier le contenu
                        </h4>
                        <div>
                            <span class="badge bg-{{ $contenu->status == 'validated' ? 'success' : ($contenu->status == 'pending' ? 'warning' : 'secondary') }}">
                                {{ $contenu->status }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($contenu->status == 'validated')
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle"></i>
                        <strong>Ce contenu est déjà publié.</strong> Les modifications nécessiteront une nouvelle validation.
                    </div>
                    @endif
                    
                    <form action="{{ route('front.contenus.update', $contenu) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Titre -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Titre du contenu *</label>
                            <input type="text" 
                                   name="titre" 
                                   class="form-control form-control-lg @error('titre') is-invalid @enderror" 
                                   value="{{ old('titre', $contenu->titre) }}"
                                   required>
                            @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Description *</label>
                            <textarea name="description" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      rows="4"
                                      required>{{ old('description', $contenu->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contenu texte -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Contenu complet *</label>
                            <textarea name="contenu_texte" 
                                      class="form-control @error('contenu_texte') is-invalid @enderror" 
                                      rows="15"
                                      required>{{ old('contenu_texte', $contenu->contenu_texte) }}</textarea>
                            @error('contenu_texte')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Langue -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Langue *</label>
                                <select name="langue_id" class="form-select @error('langue_id') is-invalid @enderror" required>
                                    @foreach($langues as $langue)
                                    <option value="{{ $langue->id }}" {{ (old('langue_id', $contenu->langue_id) == $langue->id) ? 'selected' : '' }}>
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
                                    <option value="">Non spécifié</option>
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}" {{ (old('region_id', $contenu->region_id) == $region->id) ? 'selected' : '' }}>
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
                                    @foreach($typecontenus as $type)
                                    <option value="{{ $type->id }}" {{ (old('typecontenu_id', $contenu->typecontenu_id) == $type->id) ? 'selected' : '' }}>
                                        {{ $type->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('typecontenu_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image de couverture -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Image de couverture</label>
                            
                            <!-- Image actuelle -->
                            @if($contenu->image_couverture)
                            <div class="mb-3">
                                <p>Image actuelle :</p>
                                <img src="{{ asset('storage/' . $contenu->image_couverture) }}" 
                                     alt="Image actuelle" 
                                     class="img-thumbnail" 
                                     style="max-height: 200px;">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="remove_image" 
                                           id="remove_image" 
                                           value="1">
                                    <label class="form-check-label text-danger" for="remove_image">
                                        Supprimer cette image
                                    </label>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Nouvelle image -->
                            <div class="card border-dashed">
                                <div class="card-body text-center py-4">
                                    <i class="bi bi-image text-muted display-4 mb-3"></i>
                                    <p class="text-muted mb-3">Choisir une nouvelle image</p>
                                    <input type="file" 
                                           name="image_couverture" 
                                           class="form-control @error('image_couverture') is-invalid @enderror"
                                           accept="image/*">
                                    @error('image_couverture')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted d-block mt-2">JPEG, PNG - Max 2MB</small>
                                </div>
                            </div>
                        </div>

                        <!-- Options premium -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           name="is_premium" 
                                           id="is_premium" 
                                           value="1"
                                           {{ (old('is_premium', $contenu->is_premium) ? 'checked' : '') }}
                                           onchange="togglePremiumFields()"
                                           style="transform: scale(1.5);">
                                    <label class="form-check-label fw-bold fs-5" for="is_premium">
                                        <i class="bi bi-star-fill"></i> Contenu premium
                                    </label>
                                </div>
                            </div>
                            <div class="card-body" id="premiumFields" style="{{ (old('is_premium', $contenu->is_premium) ? '' : 'display: none;') }}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Prix (FCFA) *</label>
                                        <div class="input-group">
                                            <input type="number" 
                                                   name="prix" 
                                                   class="form-control @error('prix') is-invalid @enderror" 
                                                   value="{{ old('prix', $contenu->prix) }}"
                                                   min="100"
                                                   step="100"
                                                   id="prixInput">
                                            <span class="input-group-text">FCFA</span>
                                        </div>
                                        @error('prix')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Aperçu gratuit</label>
                                        <textarea name="extrait_gratuit" 
                                                  class="form-control" 
                                                  rows="5">{{ old('extrait_gratuit', $contenu->extrait_gratuit) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-between border-top pt-4">
                            <div>
                                <a href="{{ route('front.contenus.show', $contenu->slug) }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-eye"></i> Voir le contenu
                                </a>
                                <a href="{{ route('front.profil.contenus') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Mes contenus
                                </a>
                            </div>
                            <div>
                                @if($contenu->status == 'draft')
                                <button type="submit" name="action" value="draft" class="btn btn-outline-primary">
                                    <i class="bi bi-save"></i> Sauvegarder comme brouillon
                                </button>
                                @endif
                                <button type="submit" name="action" value="update" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Mettre à jour
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Suppression (uniquement pour brouillons) -->
                    @if(in_array($contenu->status, ['draft', 'rejected']))
                    <div class="border-top mt-5 pt-4">
                        <div class="alert alert-danger">
                            <h5 class="alert-heading">
                                <i class="bi bi-exclamation-triangle"></i> Zone dangereuse
                            </h5>
                            <p>Cette action est irréversible. Supprimez ce contenu uniquement si vous êtes sûr.</p>
                            <form action="{{ route('front.contenus.destroy', $contenu) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce contenu ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Supprimer définitivement
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
    
    document.addEventListener('DOMContentLoaded', function() {
        togglePremiumFields();
    });
</script>
@endpush