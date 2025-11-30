@extends('layouts')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Modifier le contenu</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.contenus.update', $contenu) }}"
              method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('admin.contenus.form')

            <button class="btn btn-warning mt-3">Mettre à jour</button>
        </form>

    </div>

</div>

@endsection
