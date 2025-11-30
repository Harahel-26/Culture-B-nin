@extends('layouts')

@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Détail du commentaire</h3>
  </div>

  <div class="card-body">
    <p><strong>Contenu :</strong> {{ $commentaire->contenu->titre }}</p>
    <p><strong>Auteur :</strong> {{ $commentaire->auteur->name }}</p>
    <p><strong>Note :</strong> {{ $commentaire->note }}/5</p>
    <p><strong>Commentaire :</strong></p>
    <p>{{ $commentaire->commentaire }}</p>

    <div class="mt-3">
      @if($commentaire->statut != 'validated')
        <form action="{{ route('admin.commentaires.valider', $commentaire) }}" method="POST" class="d-inline">
          @csrf @method('PUT')
          <button class="btn btn-success">Valider</button>
        </form>
      @endif

      @if($commentaire->statut != 'rejected')
        <form action="{{ route('admin.commentaires.rejeter', $commentaire) }}" method="POST" class="d-inline">
          @csrf @method('PUT')
          <button class="btn btn-danger">Rejeter</button>
        </form>
      @endif

      <a href="{{ route('admin.commentaires.index') }}" class="btn btn-secondary">Retour</a>
    </div>
  </div>
</div>
@endsection
