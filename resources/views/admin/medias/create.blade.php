@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Ajouter un média</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('medias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('admin.medias.form')

            <button class="btn btn-primary mt-3">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>

    </div>
</div>

@endsection
