@extends('admin.layouts')

@section('title', 'Ajouter un Média')

@section('content')

<style>
    .label-premium { font-weight:600; color:#1e1b4b; }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-upload"></i> Ajouter un Média
</h3>

<div class="card shadow-sm p-4">

    <form action="{{ route('admin.medias.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            <div class="col-md-6">
                <label class="label-premium">Contenu associé *</label>
                <select name="contenu_id" class="form-select">
                    @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id }}">{{ $contenu->titre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Type de média *</label>
                <select name="type_media_id" class="form-select">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Fichier média *</label>
                <input type="file" name="fichier" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Langue (optionnel)</label>
                <select name="langue_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}">{{ $langue->nom }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <label class="label-premium">Titre (optionnel)</label>
                <input type="text" name="titre" class="form-control" placeholder="Titre du média">
            </div>

            <div class="col-md-12">
                <label class="label-premium">Description (optionnel)</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

        </div>

        <div class="mt-4">
            <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
                <i class="bi bi-save"></i> Enregistrer
            </button>
            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>

    </form>

</div>

@endsection
