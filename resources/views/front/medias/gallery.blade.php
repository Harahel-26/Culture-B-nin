@extends('front.layouts.app')

@section('title', 'Galerie Multimédia')

@section('content')

<style>
    /* Onglets premium */
    .gallery-tabs {
        border-bottom: 2px solid #ddd;
        margin-bottom: 25px;
    }

    .gallery-tabs a {
        padding: 12px 22px;
        font-weight: 600;
        color: #1e1b4b;
        border-radius: 8px 8px 0 0;
        margin-right: 8px;
        display: inline-block;
        transition: .3s;
    }

    .gallery-tabs a.active {
        background: #1e1b4b;
        color: #fff;
    }

    .gallery-tabs a:hover {
        background: #2e2970;
        color: white;
    }

    /* Grille premium */
    .media-card {
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
        transition: .3s;
        box-shadow: 0 5px 18px rgba(0,0,0,0.07);
    }

    .media-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }
    .favori-btn {
    top: 10px;
    right: 10px;
    z-index: 3;
}


    .media-thumb {
        height: 200px;
        width: 100%;
        object-fit: cover;
    }

    .video-thumb {
        width: 100%;
        height: 200px;
        border-radius: 12px;
        overflow: hidden;
    }

    .audio-box {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 12px;
    }

    .media-caption {
        padding: 12px 15px;
        font-size: 1rem;
        font-weight: 600;
        color: #1e1b4b;
    }
</style>


<div class="container py-5">

    <!-- TITRE PAGE -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Galerie Multimédia</h1>
        <p class="text-muted" style="font-size:1.1rem;">
            Explorez les images, vidéos et audios de la plateforme culturelle.
        </p>
    </div>


    <!-- ONGLET DE NAVIGATION -->
    <div class="gallery-tabs d-flex justify-content-center">
        <a href="#" class="tab-link active" data-target="images">
            <i class="bi bi-image"></i> Images
        </a>

        <a href="#" class="tab-link" data-target="videos">
            <i class="bi bi-play-circle"></i> Vidéos
        </a>

        <a href="#" class="tab-link" data-target="audios">
            <i class="bi bi-music-note"></i> Audios
        </a>
    </div>


    <!-- CONTENU DES ONGLETS -->

    <!-- IMAGES -->
    <div class="tab-content" id="images">

        <div class="row g-4">

            @forelse($images as $img)
                <div class="col-md-4">

                    <div class="media-card">
                        
                        <img src="{{ $img->url }}" class="media-thumb">

                        <div class="media-caption">
                            {{ $img->titre ?? 'Image' }}
                        </div>
                    </div>

                </div>
            @empty

                <div class="col-12 text-center text-muted">Aucune image disponible.</div>

            @endforelse

        </div>

    </div>


    <!-- VIDEOS -->
    <div class="tab-content d-none" id="videos">

        <div class="row g-4">

            @forelse($videos as $vid)
                <div class="col-md-4">

                    <div class="media-card p-2">
                        <video class="video-thumb" controls>
                            <source src="{{ $vid->url }}">
                        </video>

                        <div class="media-caption">
                            {{ $vid->titre ?? 'Vidéo' }}
                        </div>
                    </div>

                </div>
            @empty

                <div class="col-12 text-center text-muted">Aucune vidéo trouvée.</div>

            @endforelse

        </div>

    </div>


    <!-- AUDIOS -->
    <div class="tab-content d-none" id="audios">

        <div class="row g-4">

            @forelse($audios as $aud)
                <div class="col-md-4">

                    <div class="media-card p-3">
                        <div class="audio-box">
                            <audio controls class="w-100">
                                <source src="{{ $aud->url }}">
                            </audio>
                        </div>

                        <div class="media-caption">
                            {{ $aud->titre ?? 'Audio' }}
                        </div>
                    </div>

                </div>
            @empty

                <div class="col-12 text-center text-muted">Aucun fichier audio disponible.</div>

            @endforelse

        </div>

    </div>

</div>


<!-- SCRIPT ONGLET -->
@push('scripts')
<script>
    document.querySelectorAll('.tab-link').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();

            // désactiver tous les onglets
            document.querySelectorAll('.tab-link').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // cacher tout
            document.querySelectorAll('.tab-content').forEach(c => c.classList.add('d-none'));

            // afficher le bon
            document.getElementById(this.dataset.target).classList.remove('d-none');
        });
    });
</script>
@endpush

@endsection
