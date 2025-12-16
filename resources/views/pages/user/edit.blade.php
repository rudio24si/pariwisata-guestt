@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5 vh-100">
        <h2>Edit Data User</h2>
        <br>
        {{-- Ganti ke route users.update dan gunakan variabel $user --}}
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Aduh! Ada yang salah:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Email Address *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <hr>
            <div class="alert alert-info text-sm">
                Kosongkan password jika tidak ingin mengubahnya.
            </div>

            <div class="mb-3">
                <label>Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="mb-3">
                <label for="profile_picture" class="form-label fw-medium">Foto Profil</label>
                <div class="input-group">
                    <span class="input-group-text bg-primary text-white">
                        <i class="bi bi-image"></i>
                    </span>
                    <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                </div>
                <div class="form-text">Format: JPG, PNG, atau WEBP. Maksimal 2MB.</div>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection