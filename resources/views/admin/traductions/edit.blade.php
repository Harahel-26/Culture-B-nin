@extends('admin.layouts')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Modifier la traduction</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('traductions.update', $traduction) }}" method="POST">
            @csrf
            @method('PUT')

            @include('admin.traductions.form')

            <button class="btn btn-warning mt-3">
                Mettre à jour
            </button>
        </form>

    </div>
</div>

@endsection
