<div class="card mb-4">
  <div class="card-body">
    <h5>Avis des utilisateurs ({{ $contenu->totalNotes() }} avis)</h5>

    <p>
      Note moyenne : <strong>{{ number_format($contenu->moyenneNotes(), 1) ?? '0.0' }}</strong> / 5
    </p>

    @foreach($contenu->commentaires()->where('statut','validated')->whereNull('parent_id')->with('auteur','reponses')->get() as $c)
      <div class="mb-3">
        <strong>{{ $c->auteur->name ?? 'Anonyme' }}</strong> — {{ $c->note }}/5
        <div>{{ $c->commentaire }}</div>

        {{-- Réponses --}}
        @foreach($c->reponses()->where('statut','validated')->with('auteur')->get() as $r)
          <div class="ms-4 mt-2">
            <small><strong>{{ $r->auteur->name ?? 'Anonyme' }}</strong> :</small>
            <div>{{ $r->commentaire }}</div>
          </div>
        @endforeach
      </div>
    @endforeach

  </div>
</div>
