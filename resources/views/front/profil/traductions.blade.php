@extends('front.layouts.app')
@section('title','Mes traductions')
@section('content')
<div class="container py-4">
  <h3>Mes traductions</h3>
  @forelse($traductions as $t)
    <div class="card mb-2 p-3">
      <h5>{{ $t->contenu->titre ?? 'Traduction' }}</h5>
      <p>{{ Str::limit($t->texte, 200) }}</p>
    </div>
  @empty
    <p>Vous n'avez encore soumis aucune traduction.</p>
  @endforelse

  {{ $traductions->links() }}
</div>
@endsection
