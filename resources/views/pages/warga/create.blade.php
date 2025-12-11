@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5 vh-100">
        <h2>Tambah Data Warga</h2>
        <br>
        <form action="{{ route('warga.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>No KTP *</label>
                <input type="text" name="no_ktp" class="form-control" required maxlength="16">
                @error('no_ktp') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Nama *</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Jenis Kelamin *</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Agama *</label>
                <input type="text" name="agama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Pekerjaan *</label>
                <input type="text" name="pekerjaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Telepon</label>
                <input type="text" name="telp" class="form-control">
            </div>


            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection