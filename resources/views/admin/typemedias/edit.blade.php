@extends('layouts')

@section('content')
<div class="card">
    <div class="card-header">Modifier le type de média</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.typemedias.update', $typemedia) }}">
            @csrf @method('PUT')

            @include('admin.typemedias.form')

            <button class="btn btn-warning mt-2">Modifier</button>
        </form>
    </div>
</div>
@endsection
