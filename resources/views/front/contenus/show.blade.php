@extends('front.layouts.app')

@section('title', $contenu->titre)

{{-- HERO IMAGE --}}
@section('hero')
<section class="page-header-hero text-center"
        style="background: url('{{ $contenu->image_couverture ? asset('storage/'.$contenu->image_couverture) : asset('images/default-cover.jpg') }}');
               background-size: cover; background-position: center;">
    <div class="container py-5" style="background:rgba(0,0,0,0.55); border-radius:12px;">
        <h1 class="fw-bold text-white">{{ $contenu->titre }}</h1>
        <p class="text-light mt-2">
            {{ $contenu->typecontenu->nom }} • {{ $contenu->langue->nom }}
        </p>
    </div>
</section>
@endsection

@section('content')

<style>
    .premium-box {
        background:#fff8e1;
        border:1px solid #d4a017;
        border-radius:12px;
        padding:25px;
        text-align:center;
        box-shadow:0 3px 8px rgba(0,0,0,0.1);
    }
    .media-thumb {
        width: 240px;
        height: 150px;
        object-fit:cover;
        border-radius:10px;
        margin:5px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.12);
    }
    .comment-box {
        background:#fff;
        padding:15px;
        border-radius:10px;
        box-shadow:0 3px 10px rgba(0,0,0,0.06);
    }
</style>

<div class="container">

    {{-- ⭐ INFORMATIONS --}}
    <div class="mb-3">
        <small class="text-muted">
            Publié le {{ $contenu->published_at?->format('d/m/Y') }}
            • Vues : {{ $contenu->vues_total }}
        </small>

        @if($contenu->is_premium)
            <span class="badge-premium ms-2">Premium</span>
        @else
            <span class="badge bg-success ms-2">Gratuit</span>
        @endif
    </div>


    {{-- ⭐ SI NON ACCESSIBLE (premium non acheté) --}}
    @if(!$accessible)

        <div class="premium-box mb-4">
            <h4 class="fw-bold mb-3">
                 Ce contenu est Premium
            </h4>

            <p class="mb-3">
                Prix : <strong>{{ $contenu->prix_formatte }}</strong>
            </p>

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                    Se connecter pour acheter
                </a>
            @else

                {{-- BOUTON KKIAPAY --}}
                <button class="btn btn-warning btn-lg" onclick="openKkiapayPayment()">
                    <i class="bi bi-credit-card"></i> Acheter ce contenu
                </button>

                {{-- Script Kkiapay --}}
                <script src="https://cdn.kkiapay.me/k.js"></script>

                <script>
                function openKkiapayPayment() {
                    openKkiapayWidget({
                        amount: {{ $contenu->prix }},
                        email: "{{ auth()->user()->email }}",
                        name: "{{ auth()->user()->name }}",
                        phone: "{{ auth()->user()->phone ?? '' }}",
                        key: "{{ env('KKIAPAY_PUBLIC_KEY') }}",
                        sandbox: true,
                        position: "center",
                        callback: "{{ route('paiement.callback') }}?contenu_id={{ $contenu->id }}"
                    });
                }
                </script>

            @endguest
        </div>

        <h4 class="fw-bold mb-3">Aperçu gratuit</h4>
        <p class="text-muted fs-6">
            {{ $contenu->extrait }}
        </p>

        <hr>

    @else

        {{-- ⭐ CONTENU COMPLET --}}
        <div class="content-area fs-6 mb-4">
            {!! $contenu->contenu_texte !!}
        </div>

    @endif


    {{-- ⭐ MÉDIAS ASSOCIÉS --}}
    <h3 class="fw-bold mt-5 mb-3">Médias associés</h3>

    <div class="d-flex flex-wrap">

        @forelse($contenu->medias as $m)

            {{-- IMAGE --}}
            @if($m->typeMedia->nom === 'image')
                <img src="{{ asset('storage/'.$m->fichier) }}"
                     class="media-thumb">

            {{-- VIDEO --}}
            @elseif($m->typeMedia->nom === 'video')
                <video controls class="media-thumb">
                    <source src="{{ asset('storage/'.$m->fichier) }}">
                </video>

            {{-- AUDIO --}}
            @elseif($m->typeMedia->nom === 'audio')
                <audio controls class="w-100 my-3">
                    <source src="{{ asset('storage/'.$m->fichier) }}">
                </audio>
            @endif

        @empty
            <p class="text-muted">Aucun média pour ce contenu.</p>
        @endforelse

    </div>

    <hr class="my-5">


    {{-- ⭐ COMMENTAIRES --}}
    <h3 class="fw-bold mb-3">Commentaires</h3>

    {{-- AFFICHAGE DES COMMENTAIRES --}}
    @forelse($contenu->commentaires as $cm)
        <div class="comment-box mb-3">
            <strong>{{ $cm->utilisateur->name }}</strong>
            <br>
            <small class="text-warning">
                {!! str_repeat('★', $cm->note) !!}
            </small>
            <p class="mt-2">{{ $cm->commentaire }}</p>
        </div>
    @empty
        <p class="text-muted">Aucun commentaire pour le moment.</p>
    @endforelse

    @auth
    <h4 class="mt-4">Laisser un commentaire</h4>

    <form action="{{ route('front.commentaire.store') }}" method="POST" class="mb-5">
        @csrf

        <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

        <div class="mb-3">
            <label class="form-label">Note</label>
            <select name="note" class="form-select" required>
                <option value="">Sélectionner</option>
                <option value="5">★★★★★ (5)</option>
                <option value="4">★★★★☆ (4)</option>
                <option value="3">★★★☆☆ (3)</option>
                <option value="2">★★☆☆☆ (2)</option>
                <option value="1">★☆☆☆☆ (1)</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Votre commentaire</label>
            <textarea name="commentaire" class="form-control" rows="4" required></textarea>
        </div>

        <button class="btn btn-gold">
            <i class="bi bi-send"></i> Envoyer
        </button>
    </form>
@endauth



    {{-- ⭐ CONTENUS SIMILAIRES --}}
    <h3 class="fw-bold mt-5 mb-3">Contenus similaires</h3>

    <div class="row g-4">

        @foreach(
            \App\Models\Contenu::where('typecontenu_id', $contenu->typecontenu_id)
                ->where('id','!=',$contenu->id)
                ->take(3)
                ->get()
        as $sim)
        <div class="col-md-4">

            <a href="{{ route('front.contenus.show',$sim->slug) }}"
               class="text-decoration-none text-dark">

                <div class="contenu-card">
                    <x-favori-button :contenu="$c" />
                    <img src="{{ asset('storage/'.$sim->image_couverture) }}"
                         class="contenu-cover">

                    <div class="p-3">
                        <h5 class="fw-bold">{{ $sim->titre }}</h5>

                        <small class="text-muted">
                            {{ $sim->typecontenu->nom }} • {{ $sim->langue->nom }}
                        </small>

                    </div>
                </div>

            </a>

        </div>
        @endforeach

    </div>

</div>

@endsection
