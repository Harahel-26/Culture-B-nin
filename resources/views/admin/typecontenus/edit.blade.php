@extends('admin.layouts')

@section('title', 'Modifier Type de Contenu')

@section('content')

<style>
    .label-premium { font-weight: 600; color:#1e1b4b; }
</style>

<h3 class="fw-bold mb-3" style="color:#1e1b4b;">
    <i class="bi bi-pencil-square"></i> Modifier : {{ $typecontenu->nom }}
</h3>

<div class="card shadow-sm p-4">

    <form action="{{ route('admin.typecontenus.update', $typecontenu) }}" method="POST">
        @csrf @method('PUT')

        <label class="label-premium">Nom *</label>
        <input type="text" name="nom"
               class="form-control mb-3"
               value="{{ $typecontenu->nom }}">

        <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
            <i class="bi bi-save"></i> Sauvegarder
        </button>

        <a href="{{ route('admin.typecontenus.index') }}" class="btn btn-secondary">Annuler</a>
    </form>

</div>

@endsection
