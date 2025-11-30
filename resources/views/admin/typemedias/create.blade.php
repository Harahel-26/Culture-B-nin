@extends('layouts')

@section('content')
<div class="card">
    <div class="card-header">Ajouter un type de média</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.typemedias.store') }}">
            @csrf

            @include('admin.typemedias.form')

            <button class="btn btn-primary mt-2">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
