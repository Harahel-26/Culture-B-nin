@extends('front.layouts.app')

@section('title', 'Galerie des médias')

@section('hero')
<section class="page-header-hero text-center">
    <div class="container py-5">
        <h1 class="fw-bold text-white">Galerie des médias</h1>
        <p class="text-light fs-6">Images, vidéos et audios liés aux contenus culturels du Bénin.</p>
    </div>
</section>
@endsection

@section('content')

<style>
    .media-card {
        background:#fff;
        border-radius:12px;
        overflow:hidden;
        box-shadow:0 4px 12px rgba(0,0,0,0.08);
        transition:.3s;
        cursor:pointer;
    }
    .media-card:hover {
        transform:translateY(-5px);
        box-shadow:0 6px 18px rgba(0,0,0,0.15);
    }
    .media-thumb {
        width:100%;
        height:180px;
        object-fit:cover;
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}

    .audio-box, .video-box {
        border-radius:10px;
        overflow:hidden;
        background:#000;
    }
    .filter-tab {
        display:inline-block;
        padding:8px 18px;
        border-radius:20px;
        margin-right:8px;
        background:#f1f1f3;
        color:#333;
        transition:.2s;
        text-decoration:none;
    }
    .filter-tab.active {
        background:#d4a017;
        color:#fff !important;
        font-weight:bold;
    }
</style>

<div class="container">

    {{-- ⭐ FILTRES --}}
    <div class="mb-4">
        <a href="{{ route('front.medias.index') }}"
           class="filter-tab {{ !request('type') ? 'active' : '' }}">
            Tous
        </a>

        <a href="{{ route('front.medias.index', ['type' => 'image']) }}"
           class="filter-tab {{ request('type')==='image' ? 'active' : '' }}">
            Images
        </a>

        <a href="{{ route('front.medias.index', ['type' => 'video']) }}"
           class="filter-tab {{ request('type')==='video' ? 'active' : '' }}">
            Vidéos
        </a>

        <a href="{{ route('front.medias.index', ['type' => 'audio']) }}"
           class="filter-tab {{ request('type')==='audio' ? 'active' : '' }}">
            Audios
        </a>
    </div>


    {{-- ⭐ GALERIE DES MÉDIAS --}}
    <div class="row g-4">

        @forelse($medias as $m)

            <div class="col-md-4">

                <div class="media-card">

                    {{-- IMAGE --}}
                    @if($m->typeMedia->nom === 'image')
                        <img src="{{ asset('storage/'.$m->fichier) }}"
                             class="media-thumb"
                             data-bs-toggle="modal"
                             data-bs-target="#modalImage{{ $m->id }}">

                    {{-- VIDEO --}}
                    @elseif($m->typeMedia->nom === 'video')
                        <div class="video-box">
                            <video controls width="100%">
                                <source src="{{ asset('storage/'.$m->fichier) }}">
                            </video>
                        </div>

                    {{-- AUDIO --}}
                    @elseif($m->typeMedia->nom === 'audio')
                        <div class="audio-box p-3 bg-light">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/'.$m->fichier) }}">
                            </audio>
                        </div>
                    @endif

                    <div class="p-3">
                        <h6 class="fw-bold">{{ $m->titre ?? 'Média' }}</h6>
                        <small class="text-muted">
                            Contenu : {{ $m->contenu->titre }}
                        </small>
                    </div>

                </div>

            </div>


            {{-- ⭐ MODAL POUR APERCU IMAGE --}}
            @if($m->typeMedia->nom === 'image')
            <div class="modal fade" id="modalImage{{ $m->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-dark">
                        <img src="{{ asset('storage/'.$m->fichier) }}" class="w-100">
                    </div>
                </div>
            </div>
            @endif

        @empty
            <p class="text-muted text-center">Aucun média disponible.</p>
        @endforelse

    </div>

    <div class="mt-4">
        {{ $medias->links() }}
    </div>

</div>

@endsection
