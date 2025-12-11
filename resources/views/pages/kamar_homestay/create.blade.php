@extends('layouts.guest.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow">
                <div class="card-header text-white py-3" style="background-color: #2c3e50;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Kamar Baru
                        </h4>
                        <a href="{{ route('kamar-homestay.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('kamar-homestay.store') }}" method="POST">
                        @csrf

                        <!-- Homestay Selection -->
                        <div class="mb-4">
                            <label for="homestay_id" class="form-label fw-bold">
                                <i class="bi bi-house-door me-2"></i>Pilih Homestay *
                            </label>
                            <select class="form-select @error('homestay_id') is-invalid @enderror" 
                                    id="homestay_id" name="homestay_id" required>
                                <option value="">-- Pilih Homestay --</option>
                                @foreach($homestays as $homestay)
                                    <option value="{{ $homestay->homestay_id }}" 
                                            {{ old('homestay_id') == $homestay->homestay_id ? 'selected' : '' }}>
                                        {{ $homestay->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('homestay_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Kamar -->
                        <div class="mb-4">
                            <label for="nama_kamar" class="form-label fw-bold">
                                <i class="bi bi-card-text me-2"></i>Nama Kamar *
                            </label>
                            <input type="text" class="form-control @error('nama_kamar') is-invalid @enderror" 
                                   id="nama_kamar" name="nama_kamar" 
                                   value="{{ old('nama_kamar') }}" 
                                   placeholder="Contoh: Kamar Deluxe, Suite Room, etc." required>
                            @error('nama_kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kapasitas & Harga -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="kapasitas" class="form-label fw-bold">
                                    <i class="bi bi-people me-2"></i>Kapasitas (orang) *
                                </label>
                                <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" 
                                       id="kapasitas" name="kapasitas" 
                                       value="{{ old('kapasitas', 1) }}" 
                                       min="1" max="10" required>
                                @error('kapasitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maksimal 10 orang per kamar</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="harga" class="form-label fw-bold">
                                    <i class="bi bi-currency-dollar me-2"></i>Harga (Rp) *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                                           id="harga" name="harga" 
                                           value="{{ old('harga', 0) }}" 
                                           min="0" step="1000" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Harga per kamar per malam</div>
                            </div>
                        </div>

                        <!-- Fasilitas JSON -->
                        <div class="mb-4">
                            <label for="fasilitas_json" class="form-label fw-bold">
                                <i class="bi bi-star me-2"></i>Fasilitas Kamar
                            </label>
                            <textarea class="form-control @error('fasilitas_json') is-invalid @enderror" 
                                      id="fasilitas_json" name="fasilitas_json" 
                                      rows="4" placeholder='["AC", "TV", "WiFi", "Kamar Mandi Dalam", "Breakfast"]'>
                                {{ old('fasilitas_json') }}
                            </textarea>
                            <div class="form-text">
                                Masukkan dalam format JSON array. Contoh: ["AC", "TV", "WiFi"]
                            </div>
                            @error('fasilitas_json')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-clockwise me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Kamar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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

// Format JSON saat fokus
document.getElementById('fasilitas_json').addEventListener('focus', function(e) {
    const value = e.target.value.trim();
    if (value) {
        try {
            const parsed = JSON.parse(value);
            e.target.value = JSON.stringify(parsed, null, 2);
        } catch (error) {
            // Biarkan jika bukan JSON valid
        }
    }
});
</script>
@endsection