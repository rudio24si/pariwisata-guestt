@extends('layouts.guest.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header text-white py-3" style="background-color: #004d60;">
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle p-2 me-3">
                                <i class="bi bi-pencil" style="color: #004d60;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Edit Destinasi Wisata</h5>
                                <small class="opacity-75">Perbarui data destinasi wisata</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        {{-- MODIFIKASI: Tambahkan enctype untuk upload file --}}
                        <form action="{{ route('destinasi-wisata.update', $destinasi->destinasi_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- ... Input Nama sampai Harga Tiket (Tetap Sama) ... --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Destinasi *</label>
                                    <input type="text" name="nama" class="form-control" required
                                        value="{{ old('nama', $destinasi->nama) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" class="form-control"
                                        value="{{ old('kontak', $destinasi->kontak) }}">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control"
                                        rows="3">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Alamat Lengkap *</label>
                                    <textarea name="alamat" class="form-control" rows="2"
                                        required>{{ old('alamat', $destinasi->alamat) }}</textarea>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control"
                                        value="{{ old('rt', $destinasi->rt) }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control"
                                        value="{{ old('rw', $destinasi->rw) }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jam Buka</label>
                                    <input type="time" name="jam_buka" class="form-control"
                                        value="{{ old('jam_buka', $destinasi->jam_buka ? date('H:i', strtotime($destinasi->jam_buka)) : '') }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jam Tutup</label>
                                    <input type="time" name="jam_tutup" class="form-control"
                                        value="{{ old('jam_tutup', $destinasi->jam_tutup ? date('H:i', strtotime($destinasi->jam_tutup)) : '') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Harga Tiket (Rp) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="tiket" class="form-control" required
                                            value="{{ old('tiket', $destinasi->tiket) }}">
                                    </div>
                                </div>

                                <hr>

                                {{-- MODIFIKASI: Bagian Manajemen Foto --}}
                                <div class="col-12 mb-4">
                                    <label class="form-label fw-bold">Foto Destinasi Saat Ini</label>
                                    <div class="row g-2 mb-3">
                                        @forelse($destinasi->media as $m)
                                            <div class="col-md-3 col-6 position-relative shadow-sm">
                                                <img src="{{ asset('images/' . $m->file_name) }}" class="img-thumbnail w-100"
                                                    style="height: 120px; object-fit: cover;">
                                                {{-- Checkbox untuk menghapus foto tertentu --}}
                                                <div class="position-absolute top-0 end-0 m-1">
                                                    <input type="checkbox" name="delete_media[]" value="{{ $m->id }}"
                                                        class="form-check-input border-danger" title="Ceklis untuk hapus">
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-muted small italic">Belum ada foto yang diunggah.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                    @if($destinasi->media->count() > 0)
                                        <small class="text-danger d-block mb-3">* Ceklis foto di atas jika ingin
                                            menghapusnya.</small>
                                    @endif

                                    <label class="form-label fw-bold">Tambah Foto Baru</label>
                                    <input type="file" name="filename[]" class="form-control" multiple accept="image/*">
                                    <small class="text-muted">Bisa pilih lebih dari satu foto (Max: 2MB per file)</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('destinasi-wisata.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <div class="btn-group">
                                    <a href="{{ route('destinasi-wisata.show', $destinasi->destinasi_id) }}"
                                        class="btn btn-info">
                                        <i class="bi bi-eye me-1"></i> Lihat
                                    </a>
                                    <button type="submit" class="btn" style="background-color: #004d60; color: white;">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection