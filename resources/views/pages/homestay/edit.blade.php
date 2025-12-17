@extends('layouts.guest.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Edit Homestay: {{ $homestay->nama }}</h4>
                    </div>
                    <div class="card-body">
                        {{-- MODIFIKASI: Tambahkan enctype="multipart/form-data" --}}
                        <form action="{{ route('homestay.update', $homestay->homestay_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- BAGIAN PEMILIK --}}
                            <div class="mb-3">
                                <label for="pemilik_warga_id" class="form-label">Pemilik (Warga)</label>
                                <select class="form-control @error('pemilik_warga_id') is-invalid @enderror"
                                    id="pemilik_warga_id" name="pemilik_warga_id">
                                    <option value="">-- Pilih Pemilik (Opsional) --</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->warga_id }}"
                                            {{ old('pemilik_warga_id', $homestay->pemilik_warga_id) == $w->warga_id ? 'selected' : '' }}>
                                            {{ $w->nama }}
                                            @if ($w->no_ktp) (NIK: {{ $w->no_ktp }}) @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemilik_warga_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- NAMA HOMESTAY --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Homestay *</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $homestay->nama) }}" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- ALAMAT --}}
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="2"
                                    required>{{ old('alamat', $homestay->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- RT, RW & HARGA --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="rt" class="form-label">RT</label>
                                    <input type="text" class="form-control @error('rt') is-invalid @enderror"
                                        id="rt" name="rt" value="{{ old('rt', $homestay->rt) }}" maxlength="3">
                                </div>
                                <div class="col-md-3">
                                    <label for="rw" class="form-label">RW</label>
                                    <input type="text" class="form-control @error('rw') is-invalid @enderror"
                                        id="rw" name="rw" value="{{ old('rw', $homestay->rw) }}" maxlength="3">
                                </div>
                                <div class="col-md-6">
                                    <label for="harga_per_malam" class="form-label">Harga per Malam (Rp) *</label>
                                    <input type="number" class="form-control @error('harga_per_malam') is-invalid @enderror"
                                        id="harga_per_malam" name="harga_per_malam"
                                        value="{{ old('harga_per_malam', $homestay->harga_per_malam) }}" required>
                                </div>
                            </div>

                            {{-- STATUS --}}
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="aktif" {{ old('status', $homestay->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $homestay->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            {{-- FASILITAS JSON --}}
                            <div class="mb-3">
                                <label for="fasilitas_json" class="form-label">Fasilitas (Format JSON)</label>
                                <textarea class="form-control @error('fasilitas_json') is-invalid @enderror" id="fasilitas_json" name="fasilitas_json"
                                    rows="3">{{ old('fasilitas_json', json_encode($homestay->fasilitas_json)) }}</textarea>
                                     <div class="form-text">
                                    Masukkan dalam format array JSON. Contoh: ["WiFi", "AC", "Parkir"]
                                </div>
                                @error('fasilitas_json') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <hr>

                            {{-- MODIFIKASI: BAGIAN FOTO --}}
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="bi bi-images"></i> Foto Homestay Saat Ini</label>
                                <div class="row g-2 mb-3">
                                    @forelse($homestay->media as $m)
                                        <div class="col-md-4 col-6">
                                            <div class="position-relative border rounded p-1">
                                                <img src="{{ asset('images/' . $m->file_name) }}" class="img-fluid rounded" style="height: 120px; width: 100%; object-fit: cover;">
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input border-danger" type="checkbox" name="delete_media[]" value="{{ $m->id }}" id="del_{{ $m->id }}">
                                                    <label class="form-check-label small text-danger" for="del_{{ $m->id }}">Hapus foto ini</label>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12"><p class="text-muted small">Belum ada foto diunggah.</p></div>
                                    @endforelse
                                </div>

                                <label class="form-label fw-bold">Tambah Foto Baru</label>
                                <input type="file" name="filename[]" class="form-control @error('filename.*') is-invalid @enderror" multiple accept="image/*">
                                <small class="text-muted">Bisa memilih lebih dari satu foto.</small>
                                @error('filename.*') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            {{-- TOMBOL --}}
                            <div class="d-flex justify-content-between pt-3 border-top">
                                <a href="{{ route('homestay.index') }}" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Update Homestay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Link Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script>
        // Script JSON formatting Anda (tetap sama)
        document.getElementById('fasilitas_json').addEventListener('blur', function(e) {
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

        document.addEventListener('DOMContentLoaded', function() {
            const fasilitasInput = document.getElementById('fasilitas_json');
            if (fasilitasInput.value) {
                try {
                    const parsed = JSON.parse(fasilitasInput.value);
                    fasilitasInput.value = JSON.stringify(parsed, null, 2);
                } catch (e) {}
            }
        });
    </script>
@endsection