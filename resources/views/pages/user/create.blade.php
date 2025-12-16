@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5 vh-100">
        <h2>Tambah Data User</h2>
        <br>
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Email Address *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Password *</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password *</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Role *</label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="" selected disabled>-- Pilih Role --</option>
                    <option value="Super Admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="Pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="Mitra" {{ old('role') == 'mitra' ? 'selected' : '' }}>Mitra</option>
                </select>
                @error('role') <div class="text-danger">{{ $message }}</div> @enderror
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

            <button type="submit" class="btn btn-success">Simpan User</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection