@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Nouvelle traduction</h3>
    </div>

    <div class="card-body">

        <p>
            <strong>Contenu :</strong> {{ $contenu->titre }} <br>
            <strong>Langue originale :</strong> {{ $contenu->langue->nom }}
        </p>

        <form action="{{ route('traductions.store') }}" method="POST">
            @csrf

            <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">

            @include('admin.traductions.form')

            <button class="btn btn-primary mt-3">Soumettre la traduction</button>
        </form>

    </div>
</div>

@endsection
