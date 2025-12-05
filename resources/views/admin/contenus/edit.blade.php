@extends('admin.layouts')

@section('title', 'Modifier le contenu')

@section('content')

<style>
    .label-premium {
        font-weight:600;
        color:#1e1b4b;
    }

    .cover-preview {
        width: 150px;
        height: 110px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
        border:1px solid #ccc;
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-pencil-square"></i> Modifier le contenu
</h3>

<div class="card shadow-sm p-4">

    <form action="{{ route('admin.contenus.update', $contenu) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Titre --}}
            <div class="col-md-6">
                <label class="label-premium">Titre *</label>
                <input type="text" name="titre" class="form-control" value="{{ $contenu->titre }}" required>
            </div>

            {{-- Langue --}}
            <div class="col-md-6">
                <label class="label-premium">Langue *</label>
                <select name="langue_id" class="form-select" required>
                    @foreach($langues as $l)
                        <option value="{{ $l->id }}" @selected($l->id == $contenu->langue_id)>
                            {{ $l->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Région --}}
            <div class="col-md-6">
                <label class="label-premium">Région</label>
                <select name="region_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach($regions as $r)
                        <option value="{{ $r->id }}" @selected($r->id == $contenu->region_id)>
                            {{ $r->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Type contenu --}}
            <div class="col-md-6">
                <label class="label-premium">Type de contenu *</label>
                <select name="typecontenu_id" class="form-select" required>
                    @foreach($typecontenus as $t)
                        <option value="{{ $t->id }}" @selected($t->id == $contenu->typecontenu_id)>
                            {{ $t->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Image couverture --}}
            <div class="col-md-6">
                <label class="label-premium">Image de couverture</label>

                <img id="coverPreview" class="cover-preview"
                     src="{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}">

                <input type="file" name="image_couverture" class="form-control"
                       onchange="document.getElementById('coverPreview').src = window.URL.createObjectURL(this.files[0])">
            </div>

            {{-- Premium / Gratuit --}}
            <div class="col-md-6">
                <label class="label-premium">Contenu premium ?</label>
                <select name="is_premium" id="premiumSelect" class="form-select">
                    <option value="0" @selected(!$contenu->is_premium)>Non — Gratuit</option>
                    <option value="1" @selected($contenu->is_premium)>Oui — Premium</option>
                </select>
            </div>

            {{-- Prix --}}
            <div class="col-md-6" id="prixBloc" style="{{ $contenu->is_premium ? '' : 'display:none;' }}">
                <label class="label-premium">Prix (FCFA)</label>
                <input type="number" name="prix" class="form-control" min="100"
                       value="{{ $contenu->prix }}">
            </div>

            {{-- Contenu texte --}}
            <div class="col-md-12">
                <label class="label-premium">Contenu détaillé</label>
                <textarea name="contenu_texte" id="editor" rows="10">
                    {!! $contenu->contenu_texte !!}
                </textarea>
            </div>

        </div>

        <div class="mt-4">
            <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
                <i class="bi bi-save"></i> Enregistrer les modifications
            </button>

            <a href="{{ route('admin.contenus.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>

    </form>

</div>

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'));

document.getElementById('premiumSelect').addEventListener('change', function() {
    document.getElementById('prixBloc').style.display =
        this.value == "1" ? "block" : "none";
});
</script>

@endsection
