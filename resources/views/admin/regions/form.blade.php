<div class="mb-3">
    <label class="form-label">Nom</label>
    <input name="nom" class="form-control" value="{{ old('nom', $region->nom ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Type</label>
    <input name="type" class="form-control" value="{{ old('type', $region->type ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Langue principale</label>
    <input name="langue_principale" class="form-control"
           value="{{ old('langue_principale', $region->langue_principale ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $region->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Active</label>
    <select name="is_active" class="form-control">
        <option value="1" {{ old('is_active', $region->is_active ?? '')==1 ? 'selected':'' }}>Oui</option>
        <option value="0" {{ old('is_active', $region->is_active ?? '')==0 ? 'selected':'' }}>Non</option>
    </select>
</div>
