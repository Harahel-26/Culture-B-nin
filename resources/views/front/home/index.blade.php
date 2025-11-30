@extends('front.layouts.app')

@section('title', 'Culture du Bénin – Découvrez notre patrimoine')

@section('hero')
    <h1 class="fw-bold display-5 mb-3">Découvrez la richesse culturelle du Bénin</h1>
    <p class="lead">Langues, traditions, arts, rythmes, histoires & savoirs… Explorez un patrimoine vivant.</p>
@endsection

@section('content')

{{-- 🌄 SECTION 1 : DIAPORAMA --}}
<div id="heroCarousel" class="carousel slide mb-5 shadow" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{ asset('images/slides/benin1.jpg') }}" class="d-block w-100" style="height:480px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h3>Patrimoine Culturel</h3>
                <p>Un héritage vivant transmis de génération en génération.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/slides/benin2.jpg') }}" class="d-block w-100" style="height:480px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h3>Art & Artisanat</h3>
                <p>Le savoir-faire béninois, reconnu mondialement.</p>
            </div>
        </div>

        <div class="carousel-item">
            <img src="{{ asset('images/slides/benin3.jpg') }}" class="d-block w-100" style="height:480px; object-fit:cover;">
            <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                <h3>Langues & Traditions</h3>
                <p>Une diversité linguistique et culturelle exceptionnelle.</p>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>



{{-- 🌍 SECTION 2 : TEXTES + IMAGE DÉGRADÉ --}}
<div class="row align-items-center mb-5">
    <div class="col-md-6">
        <h2 class="fw-bold">À la découverte du Bénin</h2>
        <p class="text-muted">
            Terre de traditions, d’histoire et de créativité,
            le Bénin est l’un des berceaux de la culture africaine.
            Explorez ses langues, ses récits, ses rythmes, ses arts, ses peuples et son génie créatif.
        </p>

        <a href="{{ route('front.contenus.index') }}" class="btn btn-success px-4">
            Explorer les contenus →
        </a>
    </div>

    <div class="col-md-6">
        <div class="position-relative rounded shadow"
             style="height:280px; background:url('{{ asset('images/culture-degrade.jpg') }}') center/cover;">
            <div style="position:absolute;top:0;left:0;width:100%;height:100%;
                        background:linear-gradient(45deg, rgba(0,0,0,0.6), rgba(0,0,0,0.15));
                        border-radius:8px;">
            </div>
        </div>
    </div>
</div>



{{-- 🎵 SECTION 3 : DERNIERS MEDIAS (VIDEOS) --}}
<h3 class="fw-bold mb-3">🎬 Dernières Vidéos</h3>

<div class="row mb-5">
    @foreach($latestVideos ?? [] as $video)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm position-relative">
                <video class="w-100 rounded-top" height="180" controls preload="metadata">
                    <source src="{{ asset('storage/' . $video->fichier) }}" type="video/mp4">
                </video>
                <div class="p-3">
                    <h6 class="fw-bold">{{ $video->titre }}</h6>
                    <p class="text-muted mb-0">{{ $video->description }}</p>
                </div>
            </div>
        </div>
    @endforeach

    @if(empty($latestVideos) || count($latestVideos) == 0)
        <p class="text-muted">Aucune vidéo disponible pour le moment.</p>
    @endif
</div>



{{-- 🖼️ SECTION 4 : GALERIE D’IMAGES --}}
<h3 class="fw-bold mb-3">📸 Galerie d’images</h3>
<div class="row g-3 mb-5">
    @foreach($gallery ?? [] as $img)
        <div class="col-6 col-md-3">
            <div class="rounded shadow-sm"
                 style="height:170px; background:url('{{ asset("storage/".$img->fichier) }}') center/cover;">
            </div>
        </div>
    @endforeach

    @if(empty($gallery) || count($gallery) == 0)
        <p class="text-muted">Aucune image disponible.</p>
    @endif
</div>



{{-- 📚 SECTION 5 : DERNIERS CONTENUS --}}
<h3 class="fw-bold mb-3">📝 Derniers Contenus publiés</h3>

<div class="row mb-5">
    @foreach($latestContenus ?? [] as $c)
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/default-content.jpg') }}" class="card-img-top" style="height:180px; object-fit:cover;">
            <div class="card-body">
                <h5 class="fw-bold">{{ $c->titre }}</h5>
                <p class="text-muted small">{{ Str::limit($c->description, 120) }}</p>
                <a href="{{ route('front.contenus.show', $c->slug) }}" class="btn btn-outline-success btn-sm">
                    Lire plus →
                </a>
            </div>
        </div>
    </div>
    @endforeach

    @if(empty($latestContenus) || count($latestContenus) == 0)
        <p class="text-muted">Aucun contenu pour le moment.</p>
    @endif
</div>



{{-- 🔊 SECTION 6 : AUDIOS --}}
<h3 class="fw-bold mb-3">🔊 Audios & Rythmes</h3>

<div class="row mb-5">
    @foreach($latestAudios ?? [] as $audio)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h6 class="fw-bold">{{ $audio->titre }}</h6>
                <audio controls class="w-100">
                    <source src="{{ asset('storage/' . $audio->fichier) }}" type="audio/mpeg">
                </audio>
            </div>
        </div>
    @endforeach

    @if(empty($latestAudios) || count($latestAudios) == 0)
        <p class="text-muted">Aucun audio disponible.</p>
    @endif
</div>




@endsection
