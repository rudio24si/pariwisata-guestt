@extends('layouts.guest.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow">
                    <div class="card-header text-white py-3" style="background-color: #004d60;">
                        <div class="d-flex align-items-center">
                            <div class="bg-white rounded-circle p-2 me-3">
                                <i class="bi bi-plus-circle" style="color: #004d60;"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Tambah Destinasi Wisata</h5>
                                <small class="opacity-75">Isi form berikut untuk menambah data</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('destinasi-wisata.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Destinasi *</label>
                                    <input type="text" name="nama" class="form-control" required
                                        placeholder="Nama tempat wisata" value="{{ old('nama') }}">
                                    @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kontak</label>
                                    <input type="text" name="kontak" class="form-control" placeholder="Nomor telepon"
                                        value="{{ old('kontak') }}">
                                    @error('kontak') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3"
                                        placeholder="Deskripsi tempat wisata">{{ old('deskripsi') }}</textarea>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Alamat Lengkap *</label>
                                    <textarea name="alamat" class="form-control" rows="2" required
                                        placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                                    @error('alamat') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" class="form-control" placeholder="001"
                                        value="{{ old('rt') }}">
                                    @error('rt') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" class="form-control" placeholder="002"
                                        value="{{ old('rw') }}">
                                    @error('rw') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jam Buka</label>
                                    <input type="time" name="jam_buka" class="form-control" value="{{ old('jam_buka') }}">
                                    @error('jam_buka') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Jam Tutup</label>
                                    <input type="time" name="jam_tutup" class="form-control" value="{{ old('jam_tutup') }}">
                                    @error('jam_tutup') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Harga Tiket (Rp) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="tiket" class="form-control" required min="0" step="1000"
                                            value="{{ old('tiket', 0) }}">
                                    </div>
                                    <small class="text-muted">Masukkan 0 jika gratis</small>
                                    @error('tiket') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold">Unggah Foto Wisata</label>

                                    <div class="input-group has-validation">
                                        <span class="input-group-text bg-primary text-white">
                                            <i class="bi bi-images"></i>
                                        </span>

                                        <input type="file" name="filename[]" id="fileInput"
                                            class="form-control @error('filename.*') is-invalid @enderror" multiple
                                            accept="image/*" onchange="previewImages()">

                                        <button class="btn btn-outline-secondary" type="button"
                                            onclick="resetPreview()">Reset</button>
                                    </div>

                                    <div class="form-text mt-2">
                                        <i class="bi bi-info-circle"></i> Anda bisa memilih banyak foto sekaligus (Format:
                                        JPG, PNG).
                                    </div>

                                    <div id="preview-container" class="row gx-2 gy-2 mt-3">
                                    </div>

                                    @error('filename.*')
                                        <div class="text-danger small mt-1">Salah satu file tidak valid atau ukuran terlalu
                                            besar.</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('destinasi-wisata.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn" style="background-color: #004d60; color: white;">
                                    <i class="bi bi-save me-1"></i> Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script>
        function previewImages() {
            const container = document.getElementById('preview-container');
            const files = document.getElementById('fileInput').files;

            container.innerHTML = ''; // Bersihkan preview sebelumnya

            Array.from(files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Membuat elemen col Bootstrap secara dinamis
                    const col = document.createElement('div');
                    col.className = 'col-6 col-sm-4 col-md-2';

                    col.innerHTML = `
                    <div class="card h-100 shadow-sm">
                        <img src="${e.target.result}" class="card-img p-1" style="height: 100px; object-fit: cover;">
                        <div class="card-footer p-1 bg-white border-0">
                            <p class="text-truncate mb-0 small text-center" style="font-size: 0.7rem;">
                                ${file.name}
                            </p>
                        </div>
                    </div>
                `;
                    container.appendChild(col);
                }

                reader.readAsDataURL(file);
            });
        }

        function resetPreview() {
            document.getElementById('fileInput').value = '';
            document.getElementById('preview-container').innerHTML = '';
        }
    </script>
@endsection