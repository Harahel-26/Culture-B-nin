@extends('front.layouts.app')

@section('title', 'Galerie d’images')

@section('content')

<h2 class="fw-bold mb-4">📸 Galerie d’images</h2>

<div class="row g-3">
    @foreach($images as $img)
        <div class="col-6 col-md-3">
            <div class="rounded shadow-sm position-relative img-hover"
                style="height:180px; background:url('{{ asset("storage/".$img->fichier) }}') center/cover;">
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4">
    {{ $images->links() }}
</div>

<style>
.img-hover:hover {
    transform: scale(1.05);
    transition: 0.3s;
    cursor: pointer;
}
</style>

@endsection
