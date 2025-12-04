@extends('admin.layouts')

@section('content')
<div class="card">
    <div class="card-header">Détails</div>

    <div class="card-body">
        <p><strong>Nom :</strong> {{ $typecontenu->nom }}</p>

        <a href="{{ route('admin.typecontenus.index') }}" class="btn btn-secondary mt-3">
            Retour
        </a>
    </div>
</div>
@endsection
