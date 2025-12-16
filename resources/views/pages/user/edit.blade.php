@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5 vh-100">
        <h2>Edit Data User</h2>
        <br>
        {{-- Ganti ke route users.update dan gunakan variabel $user --}}
        <form action="{{ route('user.update', $user->id) }}" method="POST">
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

            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection