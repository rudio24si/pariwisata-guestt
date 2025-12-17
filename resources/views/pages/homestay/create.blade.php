@extends('layouts.guest.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center m-5 align-items-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Homestay Baru</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('homestay.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- BAGIAN INI YANG DIUBAH --}}
                            <div class="mb-3">
                                <label for="pemilik_warga_id" class="form-label">Pemilik (Warga)</label>
                                <select class="form-control @error('pemilik_warga_id') is-invalid @enderror"
                                    id="pemilik_warga_id" name="pemilik_warga_id">
                                    <option value="">-- Pilih Pemilik (Opsional) --</option>
                                    @foreach($warga as $w)
                                        <option value="{{ $w->warga_id }}" {{ old('pemilik_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }} <!-- GANTI $w->name JADI $w->nama -->
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

                            {{-- BAGIAN LAIN TETAP SAMA --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Homestay *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt"
                                        name="rt" value="{{ old('rt') }}" maxlength="3">
                                    @error('rt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw"
                                        name="rw" value="{{ old('rw') }}" maxlength="3">
                                    @error('rw')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="harga_per_malam" class="form-label">Harga per Malam (Rp) *</label>
                                    <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror"
                                        id="harga_per_malam" name="harga_per_malam" value="{{ old('harga_per_malam', 0) }}"
                                        min="0" step="1000" required>
                                    @error('harga_per_malam')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status">
                                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="fasilitas_json" class="form-label">Fasilitas (Format JSON)</label>
                                <textarea class="form-control @error('fasilitas_json') is-invalid @enderror"
                                    id="fasilitas_json" name="fasilitas_json" rows="4"
                                    placeholder='["WiFi", "AC", "Parkir"]'>{{ old('fasilitas_json') }}</textarea>
                                <div class="form-text">
                                    Masukkan dalam format array JSON. Contoh: ["WiFi", "AC", "Parkir"]
                                </div>
                                @error('fasilitas_json')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tambah Foto Baru</label>
                                <input type="file" name="filename[]"
                                    class="form-control @error('filename.*') is-invalid @enderror" multiple
                                    accept="image/*">
                                <small class="text-muted">Bisa memilih lebih dari satu foto.</small>
                                @error('filename.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('homestay.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan Homestay</button>
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
    </script>
@endsection