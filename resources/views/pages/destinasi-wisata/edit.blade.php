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
                        <form action="{{ route('destinasi-wisata.update', $destinasi->destinasi_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Destinasi *</label>
                                    <input type="text" name="nama" class="form-control" required
                                        placeholder="Nama tempat wisata" value="{{ old('nama', $destinasi->nama) }}">
                                    @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" placeholder="Nomor telepon"
                                        value="{{ old('kontak', $destinasi->kontak) }}">
                                    @error('kontak') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3"
                                        placeholder="Deskripsi tempat wisata">{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Alamat Lengkap *</label>
                                    <textarea name="alamat" class="form-control" rows="2" required
                                        placeholder="Alamat lengkap">{{ old('alamat', $destinasi->alamat) }}</textarea>
                                    @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control" placeholder="001"
                                        value="{{ old('rt', $destinasi->rt) }}">
                                    @error('rt') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control" placeholder="002"
                                        value="{{ old('rw', $destinasi->rw) }}">
                                    @error('rw') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jam Buka</label>
                                    <input type="time" name="jam_buka" class="form-control"
                                        value="{{ old('jam_buka', $destinasi->jam_buka ? date('H:i', strtotime($destinasi->jam_buka)) : '') }}">
                                    @error('jam_buka') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jam Tutup</label>
                                    <input type="time" name="jam_tutup" class="form-control"
                                        value="{{ old('jam_tutup', $destinasi->jam_tutup ? date('H:i', strtotime($destinasi->jam_tutup)) : '') }}">
                                    @error('jam_tutup') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Harga Tiket (Rp) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="tiket" class="form-control" required min="0" step="1000"
                                            value="{{ old('tiket', $destinasi->tiket) }}">
                                    </div>
                                    <small class="text-muted">Masukkan 0 jika gratis</small>
                                    @error('tiket') <div class="text-danger small">{{ $message }}</div> @enderror
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
                                        <i class="bi bi-save me-1"></i> Update Data
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection