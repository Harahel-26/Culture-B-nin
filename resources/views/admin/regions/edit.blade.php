@extends('admin.layouts')

@section('content')
<div class="card">
    <div class="card-header">Modifier la région</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.regions.update', $region) }}">
            @csrf @method('PUT')

            @include('admin.regions.form')

            <button class="btn btn-warning mt-2">Modifier</button>
        </form>
    </div>
</div>
@endsection
