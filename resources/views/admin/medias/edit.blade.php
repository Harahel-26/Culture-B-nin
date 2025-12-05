@extends('admin.layouts')

@section('title', 'Modifier un Média')

@section('content')

<style>
    .label-premium {
        font-weight: 600;
        color: #1e1b4b;
    }
    .preview-large {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-pencil-square"></i> Modifier le Média
</h3>

<div class="card shadow-sm p-4">

    <!-- Aperçu du média -->
    @if($media->typeMedia->nom === 'image')
        <img src="{{ $media->url }}" class="preview-large">

    @elseif($media->typeMedia->nom === 'video')
        <video class="preview-large" controls>
            <source src="{{ $media->url }}">
        </video>

    @elseif($media->typeMedia->nom === 'audio')
        <audio controls class="w-100 mb-3">
            <source src="{{ $media->url }}">
        </audio>
    @endif

    <form action="{{ route('admin.medias.update', $media) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

            <div class="col-md-6">
                <label class="label-premium">Contenu associé *</label>
                <select name="contenu_id" class="form-select">
                    @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id }}" @selected($contenu->id == $media->contenu_id)>
                            {{ $contenu->titre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Type de média *</label>
                <select name="type_media_id" class="form-select">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @selected($type->id == $media->type_media_id)>
                            {{ $type->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Titre</label>
                <input type="text" name="titre" class="form-control"
                       value="{{ $media->titre }}">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Langue</label>
                <select name="langue_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id }}" @selected($langue->id == $media->langue_id)>
                            {{ $langue->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12">
                <label class="label-premium">Description</label>
                <textarea name="description" class="form-control" rows="3">
                    {{ $media->description }}
                </textarea>
            </div>

        </div>

        <div class="mt-4">
            <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
                <i class="bi bi-save"></i> Enregistrer
            </button>

            <a href="{{ route('admin.medias.index') }}" class="btn btn-secondary"> Annuler </a>
        </div>

    </form>
</div>

@endsection
