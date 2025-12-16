@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5 vh-100">
        <h2>Tambah Data User</h2>
        <br>
        {{-- Ganti route ke users.store --}}
        <form action="{{ route('user.store') }}" method="POST">
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

            {{-- User biasanya butuh Password --}}
            <div class="mb-3">
                <label>Password *</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    required>
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            {{-- Opsional: Konfirmasi Password --}}
            <div class="mb-3">
                <label>Konfirmasi Password *</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan User</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection