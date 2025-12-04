@extends('front.layouts.app')

@section('title', 'Modifier mon profil - Culture Bénin')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Modifier mon profil
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('front.profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Avatar -->
                        <div class="text-center mb-4">
                            @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                 alt="Avatar"
                                 class="rounded-circle shadow mb-3"
                                 width="120"
                                 height="120"
                                 id="avatarPreview">
                            @else
                            <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3"
                                 id="avatarPreview"
                                 style="width: 120px; height: 120px;">
                                <i class="bi bi-person" style="font-size: 3rem;"></i>
                            </div>
                            @endif

                            <div class="mt-2">
                                <label for="avatar" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-camera"></i> Changer la photo
                                </label>
                                <input type="file"
                                       name="avatar"
                                       id="avatar"
                                       class="d-none"
                                       accept="image/*"
                                       onchange="previewAvatar(event)">
                                @if($user->avatar)
                                <button type="button"
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="removeAvatar()">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                                @endif
                            </div>
                            <small class="text-muted d-block mt-1">JPEG, PNG - Max 2MB</small>
                        </div>

                        <div class="row">
                            <!-- Nom -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom complet *</label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $user->name) }}"
                                       required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $user->email) }}"
                                       required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Téléphone -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="Ex: +229 00 00 00 00">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Bio -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio"
                                          class="form-control @error('bio') is-invalid @enderror"
                                          rows="4"
                                          placeholder="Présentez-vous en quelques mots...">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('front.profil.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section sécurité -->
            <div class="card mt-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="bi bi-shield-check"></i> Sécurité
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('password.request') }}" class="btn btn-outline-warning">
                            <i class="bi bi-key"></i> Changer mon mot de passe
                        </a>
                        @if(!$user->email_verified_at)
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-info">
                                <i class="bi bi-envelope-check"></i> Renvoyer l'email de vérification
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Prévisualisation de l'avatar
    function previewAvatar(event) {
        const reader = new FileReader();
        const preview = document.getElementById('avatarPreview');

        reader.onload = function() {
            if (preview.tagName === 'IMG') {
                preview.src = reader.result;
            } else {
                // Créer une image si c'est une div
                const img = document.createElement('img');
                img.src = reader.result;
                img.className = 'rounded-circle shadow';
                img.width = 120;
                img.height = 120;
                img.alt = 'Avatar preview';

                preview.parentNode.replaceChild(img, preview);
                img.id = 'avatarPreview';
            }
        }

        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Supprimer l'avatar
    function removeAvatar() {
        if (confirm('Supprimer votre photo de profil ?')) {
            // Tu pourras ajouter une requête AJAX ici pour supprimer l'avatar
            const preview = document.getElementById('avatarPreview');
            const div = document.createElement('div');
            div.className = 'rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center';
            div.style.width = '120px';
            div.style.height = '120px';
            div.innerHTML = '<i class="bi bi-person" style="font-size: 3rem;"></i>';
            div.id = 'avatarPreview';

            preview.parentNode.replaceChild(div, preview);

            // Ajouter un champ caché pour indiquer la suppression
            let deleteInput = document.querySelector('input[name="delete_avatar"]');
            if (!deleteInput) {
                deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'delete_avatar';
                deleteInput.value = '1';
                document.querySelector('form').appendChild(deleteInput);
            }
        }
    }
</script>
@endpush
