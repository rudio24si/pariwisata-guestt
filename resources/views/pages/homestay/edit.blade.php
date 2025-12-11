@extends('layouts.guest.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center vh-100 align-items-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Homestay: {{ $homestay->nama }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('homestay.update', $homestay->homestay_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            {{-- BAGIAN PEMILIK --}}
                            <div class="mb-3">
                                <label for="pemilik_warga_id" class="form-label">Pemilik (Warga)</label>
                                <select class="form-control @error('pemilik_warga_id') is-invalid @enderror"
                                    id="pemilik_warga_id" name="pemilik_warga_id">
                                    <option value="">-- Pilih Pemilik (Opsional) --</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" 
                                            {{ old('pemilik_warga_id', $homestay->pemilik_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }}
                                            @if($w->no_ktp)
                                                (NIK: {{ $w->no_ktp }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">
                                    Kosongkan jika pemilik bukan warga terdaftar
                                </div>
                                @error('pemilik_warga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- NAMA HOMESTAY --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Homestay *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama', $homestay->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ALAMAT --}}
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3" required>{{ old('alamat', $homestay->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- RT & RW --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt"
                                        name="rt" value="{{ old('rt', $homestay->rt) }}" maxlength="3">
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw"
                                        name="rw" value="{{ old('rw', $homestay->rw) }}" maxlength="3">
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- HARGA PER MALAM --}}
                                <div class="col-md-6">
                                    <label for="harga_per_malam" class="form-label">Harga per Malam (Rp) *</label>
                                    <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror"
                                        id="harga_per_malam" name="harga_per_malam" 
                                        value="{{ old('harga_per_malam', $homestay->harga_per_malam) }}"
                                        min="0" step="1000" required>
                                    @error('harga_per_malam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- STATUS --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="aktif" {{ old('status', $homestay->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status', $homestay->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- FASILITAS JSON --}}
                            <div class="mb-3">
                                <label for="fasilitas_json" class="form-label">Fasilitas (Format JSON)</label>
                                <textarea class="form-control @error('fasilitas_json') is-invalid @enderror"
                                    id="fasilitas_json" name="fasilitas_json" rows="4"
                                    placeholder='["WiFi", "AC", "Parkir"]'>{{ old('fasilitas_json', $homestay->fasilitas_json) }}</textarea>
                                <div class="form-text">
                                    Masukkan dalam format array JSON. Contoh: ["WiFi", "AC", "Parkir"]
                                </div>
                                @error('fasilitas_json')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- TOMBOL --}}
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('homestay.index') }}" class="btn btn-secondary">Kembali</a>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update Homestay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validasi JSON
        document.getElementById('fasilitas_json').addEventListener('blur', function (e) {
            const value = e.target.value.trim();
            if (value) {
                try {
                    JSON.parse(value);
                    e.target.classList.remove('is-invalid');
                    e.target.classList.add('is-valid');
                } catch (error) {
                    e.target.classList.add('is-invalid');
                    e.target.classList.remove('is-valid');
                }
            }
        });

        // Format JSON yang sudah ada agar rapi
        document.addEventListener('DOMContentLoaded', function() {
            const fasilitasInput = document.getElementById('fasilitas_json');
            if (fasilitasInput.value) {
                try {
                    const parsed = JSON.parse(fasilitasInput.value);
                    fasilitasInput.value = JSON.stringify(parsed, null, 2);
                } catch (e) {
                    // Biarkan apa adanya jika bukan JSON valid
                }
            }
        });
    </script>
@endsection