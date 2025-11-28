{{-- Langue cible --}}
<div class="mb-3">
    <label class="form-label">Langue de traduction</label>
    <select name="langue_id" class="form-control" required>
        @foreach($langues as $l)
            <option value="{{ $l->id }}"
                {{ old('langue_id', $traduction->langue_id ?? '') == $l->id ? 'selected' : '' }}>
                {{ $l->nom }}
            </option>
        @endforeach
    </select>
</div>

{{-- Titre traduit --}}
<div class="mb-3">
    <label class="form-label">Titre traduit</label>
    <input type="text" name="titre" class="form-control"
           value="{{ old('titre', $traduction->titre ?? '') }}">
</div>

{{-- Description traduite --}}
<div class="mb-3">
    <label class="form-label">Description traduite</label>
    <textarea name="description" class="form-control" rows="3">
        {{ old('description', $traduction->description ?? '') }}
    </textarea>
</div>

{{-- Contenu texte traduit --}}
<div class="mb-3">
    <label class="form-label">Texte traduit</label>
    <textarea name="contenu_texte" class="form-control" rows="6">
        {{ old('contenu_texte', $traduction->contenu_texte ?? '') }}
    </textarea>
</div>
