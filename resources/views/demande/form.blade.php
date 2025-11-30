@extends('layouts')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Demande pour devenir contributeur</h3>
    </div>

    <div class="card-body">

        @if($existe)
            <div class="alert alert-warning">
                Vous avez déjà une demande en attente.
            </div>
        @else
            <form method="POST" action="{{ route('demande.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Motif de la demande</label>
                    <textarea name="motif" class="form-control" rows="5" required>
                        {{ old('motif') }}
                    </textarea>
                </div>

                <button class="btn btn-primary">Envoyer la demande</button>
            </form>
        @endif

    </div>
</div>

@endsection
