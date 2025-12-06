@auth
<form action="{{ route('front.favoris.toggle') }}"
      method="POST"
      class="favori-btn position-absolute">
    @csrf

    <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

    <button class="btn p-0 border-0 bg-transparent">
        @if(auth()->user()->favoris->contains($contenu->id))
            <i class="bi bi-heart-fill text-danger fs-4"></i>
        @else
            <i class="bi bi-heart text-white fs-4"></i>
        @endif
    </button>
</form>
@endauth
