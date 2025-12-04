@extends('admin.layouts')

@section('content')
<div class="card">
    <div class="card-header">Créer une région</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.regions.store') }}">
            @csrf

            @include('admin.regions.form')

            <button class="btn btn-primary mt-2">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
