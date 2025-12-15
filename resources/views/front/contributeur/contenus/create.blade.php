@extends('front.layouts.app')

@section('title', 'Créer un Contenu')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5">
        <h1 class="fw-bold text-white">Créer un nouveau contenu</h1>
        <p class="text-light">Partagez vos connaissances culturelles avec la communauté</p>
    </div>
</section>
@endsection

@section('content')

<div class="container">
    <div class="card shadow-sm p-4">

        <form action="{{ route('contributeur.contenus.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <div class="col-md-12">
                    <label class="form-label fw-bold">Titre *</label>
                    <input type="text" name="titre" class="form-control"
                           value="{{ old('titre') }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Langue *</label>
                    <select name="langue_id" class="form-select" required>
                        <option value="">Sélectionner</option>
                        @foreach($langues as $l)
                            <option value="{{ $l->id }}">{{ $l->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Région</label>
                    <select name="region_id" class="form-select">
                        <option value="">Aucune</option>
                        @foreach($regions as $r)
                            <option value="{{ $r->id }}">{{ $r->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Type de contenu *</label>
                    <select name="typecontenu_id" class="form-select" required>
                        @foreach($typecontenus as $t)
                            <option value="{{ $t->id }}">{{ $t->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Image de couverture</label>
                    <input type="file" name="image_couverture" class="form-control">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Contenu *</label>
                    <textarea name="contenu_texte" rows="7" class="form-control" required>
                        {{ old('contenu_texte') }}
                    </textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Premium ?</label>
                    <select name="is_premium" class="form-select">
                        <option value="0">Non</option>
                        <option value="1">Oui</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Prix (FCFA)</label>
                    <input type="number" name="prix" class="form-control" min="100"
                           value="{{ old('prix') }}">
                </div>

            </div>

            <button class="btn btn-gold mt-4">
                Publier le contenu
            </button>

        </form>

    </div>
</div>

@endsection
