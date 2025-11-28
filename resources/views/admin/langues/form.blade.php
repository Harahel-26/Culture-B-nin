<div class="mb-3">
    <label class="form-label">Code</label>
    <input name="code" class="form-control" value="{{ old('code', $langue->code ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Nom</label>
    <input name="nom" class="form-control" value="{{ old('nom', $langue->nom ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $langue->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Active</label>
    <select name="is_active" class="form-control">
        <option value="1" {{ old('is_active', $langue->is_active ?? '')==1 ? 'selected':'' }}>Oui</option>
        <option value="0" {{ old('is_active', $langue->is_active ?? '')==0 ? 'selected':'' }}>Non</option>
    </select>
</div>
