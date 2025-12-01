@extends('front.layouts.app')

@section('title', 'Vidéos')

@section('content')

<h2 class="fw-bold mb-4">🎬 Vidéos</h2>

<div class="row">
    @foreach($videos as $vid)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <video controls class="w-100 rounded-top" height="220">
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

@endsection
