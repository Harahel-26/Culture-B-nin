@extends('admin.layouts')

@section('title', 'Modifier utilisateur')

@section('content')

<style>
    .label-premium { font-weight: 600; color:#1e1b4b; }
    .avatar-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #eee;
        display: block;
        margin-bottom: 15px;
    }
</style>

<h3 class="fw-bold mb-4" style="color:#1e1b4b;">
    <i class="bi bi-pencil-square"></i> Modifier : {{ $user->name }}
</</h3>

<div class="card shadow-sm p-4">

    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="row g-4">

            <div class="col-md-6">
                <label class="label-premium">Nom *</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" value="{{ $user->username }}">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Téléphone</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Adresse</label>
                <input type="text" name="adresse" class="form-control">
            </div>



            <div class="col-md-6">
                <label class="label-premium">Nouveau mot de passe</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="label-premium">Rôle *</label>
                <select name="role" class="form-select">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}"
                            @selected($user->hasRole($role->name))>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="label-premium">Avatar</label>

                <img id="avatarPreview" class="avatar-preview"
                     src="{{ $user->avatar_url }}">

                <input type="file" name="avatar" class="form-control"
                       onchange="document.getElementById('avatarPreview').src = window.URL.createObjectURL(this.files[0])">
            </div>

            <div class="mb-3">
                <label class="form-label">Biographie</label>
                <textarea name="bio" class="form-control" rows="3"></textarea>
            </div>

        </div>

        <div class="mt-4">
            <button class="btn btn-primary" style="background:#1e1b4b; border:none;">
                <i class="bi bi-save"></i> Mettre à jour
            </button>

            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>

    </form>

</div>

@endsection
