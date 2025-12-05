@extends('front.layouts.app')

@section('title', $contenu->titre)

@section('content')

<style>
    .cover-large {
        width: 100%;
        max-height: 340px;
        object-fit: cover;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,0.2);
        margin-bottom: 30px;
    }
    .badge-premium {
        background:#d4a017;
        color:#fff;
        padding:6px 10px;
        border-radius:6px;
        font-size:.85rem;
    }
    .blocked-area {
        background:#f0f0f0;
        border-radius:12px;
        padding:25px;
        text-align:center;
        font-size:1.1rem;
        color:#333;
    }
    .media-thumb {
        width: 180px;
        height: 120px;
        object-fit:cover;
        border-radius:10px;
        margin:5px;
    }
</style>

<div class="container py-5">

    {{-- IMAGE COUVERTURE --}}
    <img src="{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}"
         class="cover-large">

    {{-- TITRE --}}
    <h1 class="fw-bold">{{ $contenu->titre }}</h1>

    {{-- METAS --}}
    <p class="text-muted">
        {{ $contenu->typecontenu->nom }} — {{ $contenu->langue->nom }}
        <br>
        <small>Publié le {{ $contenu->published_at?->format('d/m/Y') }}</small>
    </p>

    {{-- PREMIUM --}}
    @if($contenu->is_premium)
        <span class="badge-premium">
            Premium — {{ $contenu->prix_formatte }}
        </span>
    @else
        <span class="text-success fw-bold">Gratuit</span>
    @endif

    <hr class="my-4">


    {{-- SI NON ACCESSIBLE (premium non achete) --}}
    @if(!$accessible)
        <div class="blocked-area mb-4">
            <p class="fw-bold">Ce contenu est premium.</p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">
                    Se connecter pour débloquer
                </a>
            @else
                <button class="btn btn-warning"
        onclick="openKkiapayPayment()">
    <i class="bi bi-credit-card"></i> Acheter ce contenu
</button>

            @endguest

        </div>

        {{-- extrait gratuit --}}
        <h4>Extrait gratuit :</h4>
        <p>
            {{ $contenu->extrait }}
        </p>

        <hr>
    @else

        {{-- CONTENU COMPLET --}}
        <div class="content-area mb-4">
            {!! $contenu->contenu_texte !!}
        </div>

        <hr>

    @endif


    {{-- MÉDIAS ASSOCIÉS --}}
    <h4 class="fw-bold mt-4">Médias associés</h4>

    <div class="d-flex flex-wrap">

        @forelse($contenu->medias as $m)

            @if($m->typeMedia->nom === 'image')
                <img src="{{ asset('storage/'.$m->fichier) }}" class="media-thumb">

            @elseif($m->typeMedia->nom === 'video')
                <video controls class="media-thumb">
                    <source src="{{ asset('storage/'.$m->fichier) }}">
                </video>

            @elseif($m->typeMedia->nom === 'audio')
                <audio controls class="media-thumb" style="height:40px;">
                    <source src="{{ asset('storage/'.$m->fichier) }}">
                </audio>
            @endif

        @empty
            <p class="text-muted">Aucun média.</p>
        @endforelse

    </div>

    <hr class="my-5">

    {{-- COMMENTAIRES --}}
    <h4 class="fw-bold">Commentaires</h4>

    @foreach($contenu->commentaires as $cm)
        <div class="border p-3 rounded mb-2">
            <strong>{{ $cm->utilisateur->name }}</strong>
            <br>
            {!! str_repeat('★', $cm->note) !!}
            <p>{{ $cm->commentaire }}</p>
        </div>
    @endforeach

</div>
<script src="https://cdn.kkiapay.me/k.js"></script>

<script>
function openKkiapayPayment() {

    const amount = {{ $contenu->prix }};
    const contenuId = {{ $contenu->id }};
    const userEmail = "{{ auth()->check() ? auth()->user()->email : '' }}";

    openKkiapayWidget({
        amount: amount,
        position: "right",
        email: userEmail,
        theme: "#1e1b4b",
        key: "{{ env('KKIAPAY_PUBLIC_KEY') }}",
        callback: "{{ route('paiement.callback') }}?contenu_id=" + contenuId
    });
}
</script>

@endsection
