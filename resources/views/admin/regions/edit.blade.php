@extends('admin.layouts')

@section('title', 'Modifier Région')

@section('content')

<style>
    .label-premium {
        font-weight: 600;
        color: #1e1b4b;
    }
</style>

<h3 class="fw-bold mb-3" style="color:#1e1b4b;">
    Modifier : {{ $region->nom }}
</h3>

<div class="card shadow-sm p-4">

    <form action="{{ route('admin.regions.update', $region) }}" method="POST">
        @csrf @method('PUT')

        <div class="row g-4">

            <div class="col-md-6">
                <label class="label-premium">Nom *</label>
                <input type="text" name="nom" value="{{ $region->nom }}" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Type</label>
                <select name="type" class="form-select">
                    <option value="">Sélectionner</option>
                    <option {{ $region->type=='Département'?'selected':'' }}>Département</option>
                    <option {{ $region->type=='Commune'?'selected':'' }}>Commune</option>
                    <option {{ $region->type=='Village'?'selected':'' }}>Village</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="label-premium">Description</label>
                <textarea name="description" rows="3" class="form-control">
                    {{ $region->description }}
                </textarea>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Langue principale</label>
                <select name="langue_principale_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}"
                            @selected($langue->id == $region->langue_principale_id)>
                            {{ $langue->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium d-block">Statut</label>
                <div class="form-check form-switch">
                    <input class="form-check-input"
                           type="checkbox"
                           name="is_active"
                           @checked($region->is_active)>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary"
                        style="background:#1e1b4b; border:none;">
                    <i class="bi bi-save"></i> Mettre à jour
                </button>

                <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </div>

    </form>

</div>

@endsection
