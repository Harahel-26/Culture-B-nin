@auth
<div class="card mb-4">
  <div class="card-body">
    <h5>Laisser un avis</h5>

    {{-- Si déjà un top-level commentaire existant --}}
    @php
      $existing = \App\Models\Commentaire::where('contenu_id', $contenu->id)
                  ->where('user_id', auth()->id())
                  ->whereNull('parent_id')->first();
    @endphp

    @if($existing)
      <div class="alert alert-info">
        Vous avez déjà laissé un avis ({{ $existing->note }}/5).
        <a href="{{ route('commentaires.edit', $existing) }}">Modifier mon avis</a>
      </div>
    @else
      <form action="{{ route('commentaires.store') }}" method="POST">
        @csrf
        <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

        <div class="mb-2">
          <label class="form-label">Note (1 à 5)</label>
          <select name="note" class="form-control" required>
            <option value="">--</option>
            @for($i=5;$i>=1;$i--)
              <option value="{{ $i }}">{{ $i }} étoile{{ $i>1?'s':'' }}</option>
            @endfor
          </select>
        </div>

        <div class="mb-2">
          <label class="form-label">Votre commentaire</label>
          <textarea name="commentaire" class="form-control" rows="4" required>{{ old('commentaire') }}</textarea>
        </div>

        <button class="btn btn-primary">Envoyer</button>
      </form>
    @endif

  </div>
</div>
@else
<div class="alert alert-info">
  <a href="{{ route('login') }}">Connectez-vous</a> pour laisser un avis.
</div>
@endauth
