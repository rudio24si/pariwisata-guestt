@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5 vh-100">
        <h2>Edit Data Warga</h2>
        <br>
        <form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
            @csrf
            @method('PUT') {{-- ATAU @method('PATCH') --}}

            <div class="mb-3">
                <label>No KTP *</label>
                <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $warga->no_ktp) }}" required
                    maxlength="16">
                @error('no_ktp') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Nama *</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $warga->nama) }}" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $warga->email) }}">
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin *</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label>Agama *</label>
                <input type="text" name="agama" class="form-control" value="{{ old('agama', $warga->agama) }}" required>
            </div>

            <div class="mb-3">
                <label>Pekerjaan *</label>
                <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $warga->pekerjaan) }}"
                    required>
            </div>

            <div class="mb-3">
                <label>Telepon</label>
                <input type="text" name="telp" class="form-control" value="{{ old('telp', $warga->telp) }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('warga.show', $warga->warga_id) }}" class="btn btn-info">Lihat Detail</a>
        </form>
    </div>
@endsection