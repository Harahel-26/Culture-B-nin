@extends('admin.layouts')

@section('title', 'Ajouter une Langue')

@section('content')

<h3 class="fw-bold mb-3">Ajouter une langue</h3>

{{-- Affichage des erreurs --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Erreurs :</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.langues.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                {{-- Nom --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom *</label>
                    <input type="text"
                           name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom') }}"
                           placeholder="Ex : Français, Fon, Yoruba">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Code --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Code *</label>
                    <input type="text"
                           name="code"
                           class="form-control @error('code') is-invalid @enderror"
                           value="{{ old('code') }}"
                           placeholder="Ex : fr, fon, yor">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-md-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description"
                              rows="3"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Description de la langue...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Icône --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Icône (PNG, SVG, JPG)</label>
                    <input type="file"
                           name="icone"
                           class="form-control @error('icone') is-invalid @enderror">
                    @error('icone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Statut --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold d-block">Statut</label>

                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               name="is_active"
                               id="activeSwitch"
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="activeSwitch">Active</label>
                    </div>
                </div>

                {{-- Boutons --}}
                <div class="col-12 mt-4 d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>

                    <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

            </div>

        </form>

    </div>
</div>

@endsection
