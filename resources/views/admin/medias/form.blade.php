{{-- Contenu lié --}}
<div class="mb-3">
    <label class="form-label">Contenu lié</label>
    <select name="contenu_id" class="form-control" required>
        <option value="">-- Choisir un contenu --</option>
        @foreach($contenus as $c)
            <option value="{{ $c->id }}"
                {{ old('contenu_id', $media->contenu_id ?? '') == $c->id ? 'selected' : '' }}>
                {{ $c->titre }}
            </option>
        @endforeach
    </select>
</div>

{{-- Type de média --}}
<div class="mb-3">
    <label class="form-label">Type de média</label>
    <select name="type_media_id" class="form-control" required>
        @foreach($types as $t)
            <option value="{{ $t->id }}"
                {{ old('type_media_id', $media->type_media_id ?? '') == $t->id ? 'selected' : '' }}>
                {{ $t->nom }}
            </option>
        @endforeach
    </select>
</div>

{{-- Langue (optionnel) --}}
<div class="mb-3">
    <label class="form-label">Langue du média (optionnel)</label>
    <select name="langue_id" class="form-control">
        <option value="">-- Aucune --</option>
        @foreach($langues as $l)
            <option value="{{ $l->id }}"
                {{ old('langue_id', $media->langue_id ?? '') == $l->id ? 'selected' : '' }}>
                {{ $l->nom }}
            </option>
        @endforeach
    </select>
</div>

{{-- Titre --}}
<div class="mb-3">
    <label class="form-label">Titre (optionnel)</label>
    <input type="text" name="titre" class="form-control"
        value="{{ old('titre', $media->titre ?? '') }}">
</div>

{{-- Description --}}
<div class="mb-3">
    <label class="form-label">Description (optionnelle)</label>
    <textarea name="description" class="form-control" rows="3">
        {{ old('description', $media->description ?? '') }}
    </textarea>
</div>

{{-- Upload fichier --}}
<div class="mb-3">
    <label class="form-label">Fichier média</label>
    <input type="file" name="fichier" class="form-control" {{ isset($media) ? '' : 'required' }}>
</div>

{{-- Preview si édition --}}
@if(isset($media))
    <div class="mb-3">
        <label class="form-label">Fichier actuel :</label><br>

        @if(in_array($media->extension, ['jpg','jpeg','png']))
            <img src="{{ asset('storage/' . $media->fichier) }}" width="160" class="rounded shadow">
        @else
            <a href="{{ asset('storage/'.$media->fichier) }}" target="_blank">
                <i class="fas fa-file fa-3x"></i>
            </a>
        @endif
    </div>
@endif
