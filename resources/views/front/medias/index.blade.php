@extends('front.layouts.app')

@section('title', 'Galerie multimédia')

@section('content')

<h2 class="fw-bold mb-4">Galerie Multimédia</h2>

<ul class="nav nav-tabs mb-4" id="mediaTabs">
    <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#images">📸 Images</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#videos">🎬 Vidéos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#audios">🔊 Audios</a>
    </li>
</ul>

<div class="tab-content">

    {{-- 🖼️ Images --}}
    <div class="tab-pane fade show active" id="images">
        <div class="row g-3 mb-4">
            @foreach($images as $img)
                <div class="col-6 col-md-3">
                    <div class="rounded shadow-sm"
                        style="height:180px; background:url('{{ asset("storage/".$img->fichier) }}') center/cover;">
                    </div>
                </div>
            @endforeach
        </div>

        {{ $images->links() }}
    </div>


    {{-- 🎬 Vidéos --}}
    <div class="tab-pane fade" id="videos">
        <div class="row mb-4">
            @foreach($videos as $vid)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm">
                        <video class="w-100 rounded-top" height="200" controls>
                            <source src="{{ asset('storage/'.$vid->fichier) }}" type="video/mp4">
                        </video>
                        <div class="card-body">
                            <h6 class="fw-bold">{{ $vid->titre }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $videos->links() }}
    </div>


    {{-- 🔊 Audios --}}
    <div class="tab-pane fade" id="audios">
        <div class="row mb-4">
            @foreach($audios as $aud)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm p-3">
                        <h6 class="fw-bold">{{ $aud->titre }}</h6>
                        <audio controls class="w-100">
                            <source src="{{ asset('storage/'.$aud->fichier) }}" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $audios->links() }}
    </div>

</div>

@endsection
