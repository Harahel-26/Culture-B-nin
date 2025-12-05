@extends('admin.layouts')

@section('title', 'Ajouter une Langue')

@section('content')

<h3 class="fw-bold mb-3">Ajouter une langue</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.langues.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom *</label>
                    <input type="text" name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}">
                    @error('nom') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Code *</label>
                    <input type="text" name="code"
                           class="form-control @error('code') is-invalid @enderror"
                           value="{{ old('code') }}">
                    @error('code') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" rows="3"
                              class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Icône (PNG / SVG)</label>
                    <input type="file" name="icone" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold d-block">Statut</label>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                               name="is_active" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>

                    <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">
                        Annuler
                    </a>
                </div>

            </div>

        </form>

    </div>
</div>

@endsection
