@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Créer un contenu</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.contenus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.contenus.form')

            <button class="btn btn-primary mt-3">Enregistrer</button>
        </form>

    </div>
</div>

@endsection
