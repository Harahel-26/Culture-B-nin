@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Ajouter un type</div>

    <div class="card-body">
        <form action="{{ route('admin.typecontenus.store') }}" method="POST">
            @csrf

            @include('admin.typecontenus.form')

            <button class="btn btn-primary mt-2">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
