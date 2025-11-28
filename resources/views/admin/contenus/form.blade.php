<div class="mb-3">
    <label class="form-label">Titre</label>
    <input type="text" name="titre" class="form-control"
           value="{{ old('titre', $contenu->titre ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $contenu->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Contenu (texte)</label>
    <textarea name="contenu_texte" class="form-control" rows="5">
        {{ old('contenu_texte', $contenu->contenu_texte ?? '') }}
    </textarea>
</div>

{{-- Image couverture --}}
<div class="mb-3">
    <label class="form-label">Image de couverture</label>
    <input type="file" name="image_couverture" class="form-control">

    @if(isset($contenu) && $contenu->image_couverture)
        <img src="{{ asset('storage/'.$contenu->image_couverture) }}"
             width="120" class="mt-2 rounded">
    @endif
</div>

{{-- Langue --}}
<div class="mb-3">
    <label class="form-label">Langue</label>
    <select name="langue_id" class="form-control" required>
        @foreach($langues as $l)
            <option value="{{ $l->id }}"
                {{ old('langue_id', $contenu->langue_id ?? '') == $l->id ? 'selected' : '' }}>
                {{ $l->nom }}
            </option>
        @endforeach
    </select>
</div>

{{-- Région --}}
<div class="mb-3">
    <label class="form-label">Région</label>
    <select name="region_id" class="form-control">
        <option value="">Aucune</option>
        @foreach($regions as $r)
            <option value="{{ $r->id }}"
                {{ old('region_id', $contenu->region_id ?? '') == $r->id ? 'selected' : '' }}>
                {{ $r->nom }}
            </option>
        @endforeach
    </select>
</div>

{{-- Type de contenu --}}
<div class="mb-3">
    <label class="form-label">Type de contenu</label>
    <select name="typecontenu_id" class="form-control" required>
        @foreach($typecontenus as $t)
            <option value="{{ $t->id }}"
                {{ old('typecontenu_id', $contenu->typecontenu_id ?? '') == $t->id ? 'selected' : '' }}>
                {{ $t->nom }}
            </option>
        @endforeach
    </select>
</div>

