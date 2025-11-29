@extends('layouts.admin')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Modifier le média</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('medias.update', $media) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.medias.form')

            <button class="btn btn-warning mt-3">
                <i class="fas fa-save"></i> Mettre à jour
            </button>
        </form>

    </div>

</div>

@endsection
