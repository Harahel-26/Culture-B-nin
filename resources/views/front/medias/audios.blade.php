@extends('front.layouts.app')

@section('title', 'Audios')

@section('content')

<h2 class="fw-bold mb-4">🔊 Audios & Rythmes</h2>

<div class="row">
    @foreach($audios as $aud)
        <div class="col-md-4 mb-4">
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

@endsection
