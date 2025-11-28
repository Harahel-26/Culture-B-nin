@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">Modifier le type</div>

    <div class="card-body">
        <form action="{{ route('admin.typecontenus.update', $typecontenu) }}" method="POST">
            @csrf @method('PUT')

            @include('admin.typecontenus.form')

            <button class="btn btn-warning mt-2">Modifier</button>
        </form>
    </div>
</div>
@endsection
