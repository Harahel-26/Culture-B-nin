@extends('admin.layouts')

@section('title', 'Nouvelle Région')

@section('content')

<style>
    .label-premium {
        font-weight: 600;
        color: #1e1b4b;
    }
</style>

<h3 class="fw-bold mb-3" style="color:#1e1b4b;">➕ Ajouter une Région</h3>

<div class="card shadow-sm p-4">

    <form action="{{ route('admin.regions.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            <div class="col-md-6">
                <label class="label-premium">Nom *</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom') }}">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Type</label>
                <select name="type" class="form-select">
                    <option value="">Sélectionner</option>
                    <option value="Département">Département</option>
                    <option value="Commune">Commune</option>
                    <option value="Village">Village</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="label-premium">Description</label>
                <textarea name="description" rows="3"
                          class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Langue principale</label>
                <select name="langue_principale_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}">{{ $langue->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium d-block">Statut</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary"
                        style="background:#1e1b4b; border:none;">
                    <i class="bi bi-save"></i> Enregistrer
                </button>

                <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>

    </form>

</div>

@endsection
