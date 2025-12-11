@extends('layouts.guest.app')

@section('content')
    <div class="container py-5">
        <!-- Header dengan gradient -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header text-white py-4" style="background-color: #004d60;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">
                            <i class="bi bi-house-door me-2"></i>Detail Homestay
                        </h1>
                        <p class="mb-0 small opacity-75">
                            ID Homestay: #{{ $homestay->homestay_id }}
                        </p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('homestay.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('homestay.edit', $homestay->homestay_id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Avatar / Status Side -->
                    <div class="col-md-4 bg-light p-5 text-center border-end">
                        <div class="mb-4">
                            <div class="avatar-circle mx-auto mb-3">
                                @if($homestay->status == 'aktif')
                                    <i class="bi bi-house-check text-success" style="font-size: 5rem;"></i>
                                @else
                                    <i class="bi bi-house-x text-danger" style="font-size: 5rem;"></i>
                                @endif
                            </div>
                            <h3 class="mb-1">{{ $homestay->nama }}</h3>
                        </div>

                        <!-- Harga per Malam -->
                        <div class="bg-white rounded-3 p-4 mb-4 shadow-sm">
                            <div class="text-muted small mb-1">HARGA PER MALAM</div>
                            <h2 class="text-success mb-0">Rp {{ number_format($homestay->harga_per_malam, 0, ',', '.') }}</h2>
                        </div>

                        <!-- Quick Actions -->
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">
                                <i class="bi bi-calendar-check me-2"></i> Pesan Sekarang
                            </a>
                            @if($homestay->pemilik && $homestay->pemilik->telp)
                                <a href="tel:{{ $homestay->pemilik->telp }}" class="btn btn-outline-primary">
                                    <i class="bi bi-telephone me-2"></i> Hubungi Pemilik
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Data Details -->
                    <div class="col-md-8 p-5">
                        <div class="row">
                            <!-- Informasi Homestay -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Homestay
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Nama Homestay</span>
                                        <span class="text-dark">{{ $homestay->nama }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">RT/RW</span>
                                        <span class="text-muted">RT {{ $homestay->rt ?? '-' }} / RW {{ $homestay->rw ?? '-' }}</span>
                                    </div>
                                    <div class="list-group-item px-0">
                                        <span class="fw-medium d-block mb-1">Alamat Lengkap</span>
                                        <span class="text-muted">{{ $homestay->alamat }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pemilik Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-success mb-3 border-bottom pb-2">
                                    <i class="bi bi-person-badge me-2"></i>Pemilik
                                </h5>
                                @if($homestay->pemilik)
                                    <div class="card border-success border-2">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-success rounded-circle p-3 me-3">
                                                    <i class="bi bi-person text-white fs-4"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">{{ $homestay->pemilik->nama }}</h5>
                                                    <p class="text-muted small mb-0">
                                                        NIK: {{ $homestay->pemilik->no_ktp ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                            @if($homestay->pemilik->telp || $homestay->pemilik->email)
                                                <div class="small">
                                                    @if($homestay->pemilik->telp)
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class="bi bi-telephone text-success me-2"></i>
                                                            {{ $homestay->pemilik->telp }}
                                                        </div>
                                                    @endif
                                                    @if($homestay->pemilik->email)
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-envelope text-success me-2"></i>
                                                            {{ $homestay->pemilik->email }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted py-4">
                                        <i class="bi bi-person-x display-6 mb-3"></i>
                                        <p class="mb-0">Pemilik tidak terdaftar sebagai warga</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Fasilitas Section -->
                            <div class="col-12 mb-4">
                                <h5 class="text-warning mb-3 border-bottom pb-2">
                                    <i class="bi bi-star me-2"></i>Fasilitas
                                </h5>
                                @php
                                    $fasilitas = json_decode($homestay->fasilitas_json, true) ?? [];
                                @endphp

                                @if(count($fasilitas) > 0)
                                    <div class="row g-2">
                                        @foreach($fasilitas as $fasilitasItem)
                                            <div class="col-auto">
                                                <div class="card bg-warning bg-opacity-10 border-warning border">
                                                    <div class="card-body py-2 px-3">
                                                        <div class="d-flex align-items-center">
                                                            <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                                            <span class="fw-medium">{{ $fasilitasItem }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="alert alert-light border" role="alert">
                                        <i class="bi bi-info-circle me-2"></i>Belum ada fasilitas yang tercatat
                                    </div>
                                @endif
                            </div>

                            <!-- Info Tambahan -->
                            <div class="col-lg-6">
                                <h5 class="text-info mb-3 border-bottom pb-2">
                                    <i class="bi bi-clock-history me-2"></i>Riwayat
                                </h5>
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-info rounded-circle p-3 me-3">
                                                <i class="bi bi-calendar-plus text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Dibuat</small>
                                                <strong>{{ $homestay->created_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary rounded-circle p-3 me-3">
                                                <i class="bi bi-arrow-clockwise text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Terakhir Diperbarui</small>
                                                <strong>{{ $homestay->updated_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Booking -->
                            <div class="col-lg-6">
                                <h5 class="text-purple mb-3 border-bottom pb-2">
                                    <i class="bi bi-calendar-check me-2"></i>Ketersediaan
                                </h5>
                                <div class="card border-purple border-2">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-calendar-week display-4 text-purple"></i>
                                        </div>
                                        <h4 class="text-purple mb-2">Siap Dipesan</h4>
                                        <p class="text-muted small mb-0">
                                            Status: <span class="fw-bold">{{ $homestay->status == 'aktif' ? 'Tersedia' : 'Tidak Tersedia' }}</span>
                                        </p>
                                        <button class="btn btn-purple mt-3">
                                            <i class="bi bi-calendar-range me-2"></i> Cek Jadwal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="card-footer bg-light py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small">
                            <i class="bi bi-tag me-1"></i> Homestay ID: {{ $homestay->homestay_id }}
                        </span>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('homestay.destroy', $homestay->homestay_id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus homestay ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Hapus Homestay
                            </button>
                        </form>
                        <a href="{{ route('homestay.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-list me-1"></i> Daftar Homestay
                        </a>
                        <a href="#" class="btn btn-success btn-sm">
                            <i class="bi bi-whatsapp me-1"></i> Share via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .text-purple {
            color: #6f42c1;
        }

        .bg-purple {
            background-color: #6f42c1;
        }

        .border-purple {
            border-color: #6f42c1 !important;
        }

        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border: none;
        }

        .btn-purple:hover {
            background-color: #5a32a3;
            color: white;
        }

        .avatar-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 5px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .list-group-item {
            background: transparent;
            border-color: rgba(0, 0, 0, .125);
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }

        .btn-outline-primary:hover,
        .btn-outline-success:hover {
            transform: translateY(-2px);
            transition: all 0.3s;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
        }
    </style>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Optional: JavaScript for interactivity -->
    <script>
        // Share via WhatsApp
        function shareViaWhatsApp() {
            const text = `Check out this homestay: ${encodeURIComponent("{{ $homestay->nama }}")}\n` +
                        `Price: Rp ${encodeURIComponent("{{ number_format($homestay->harga_per_malam, 0, ',', '.') }}")}/night\n` +
                        `Address: ${encodeURIComponent("{{ $homestay->alamat }}")}`;

            const url = `https://wa.me/?text=${text}`;
            window.open(url, '_blank');
        }

        // Copy address to clipboard
        function copyToClipboard(text, elementId) {
            navigator.clipboard.writeText(text).then(() => {
                const element = document.getElementById(elementId);
                const original = element.innerHTML;
                element.innerHTML = '<i class="bi bi-check"></i> Tersalin!';
                setTimeout(() => {
                    element.innerHTML = original;
                }, 2000);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            // WhatsApp share button
            const whatsappBtn = document.querySelector('.btn-success.btn-sm:last-child');
            if (whatsappBtn) {
                whatsappBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    shareViaWhatsApp();
                });
            }

            // Click to copy address
            const addressElement = document.querySelector('.list-group-item:nth-child(3) .text-muted');
            if (addressElement) {
                addressElement.style.cursor = 'pointer';
                addressElement.title = 'Klik untuk menyalin alamat';
                addressElement.addEventListener('click', function() {
                    copyToClipboard("{{ $homestay->alamat }}", 'address-copy');
                });
            }
        });
    </script>
@endsection