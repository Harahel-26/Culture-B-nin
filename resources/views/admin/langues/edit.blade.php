@extends('admin.layouts')

@section('content')
<div class="card">
    <div class="card-header">Modifier la langue</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.langues.update',$langue) }}">
            @csrf @method('PUT')

            @include('admin.langues.form')

            <button class="btn btn-warning">Modifier</button>
        </form>
    </div>
</div>
@endsection
