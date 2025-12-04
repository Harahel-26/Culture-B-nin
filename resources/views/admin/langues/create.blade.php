@extends('admin.layouts')

@section('content')
<div class="card">
    <div class="card-header">Nouvelle langue</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.langues.store') }}">
            @csrf

            @include('admin.langues.form')

            <button class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
