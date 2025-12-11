@extends('layouts.guest.app')

@section('content')
    <div class="container py-5">
        <!-- Header dengan gradient -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header text-white py-4" style="background-color: #004d60;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">
                            <i class="bi bi-door-open me-2"></i>Detail Kamar Homestay
                        </h1>
                        <p class="mb-0 small opacity-75">
                            ID Kamar: #{{ $kamarHomestay->kamar_id }}
                        </p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('kamar-homestay.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('kamar-homestay.edit', $kamarHomestay->kamar_id) }}"
                            class="btn btn-warning btn-sm">
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
                                @if($kamarHomestay->kapasitas >= 4)
                                    <i class="bi bi-people-fill text-primary" style="font-size: 5rem;"></i>
                                @elseif($kamarHomestay->kapasitas >= 2)
                                    <i class="bi bi-people text-success" style="font-size: 5rem;"></i>
                                @else
                                    <i class="bi bi-person text-info" style="font-size: 5rem;"></i>
                                @endif
                            </div>
                            <h3 class="mb-1">{{ $kamarHomestay->nama_kamar }}</h3>
                            <p class="text-muted mb-2">{{ $kamarHomestay->homestay->nama ?? 'Homestay tidak ditemukan' }}
                            </p>
                        </div>

                        <!-- Harga per Malam -->
                        <div class="bg-white rounded-3 p-4 mb-4 shadow-sm">
                            <div class="text-muted small mb-1">HARGA PER MALAM</div>
                            <h2 class="text-success mb-0">Rp {{ number_format($kamarHomestay->harga, 0, ',', '.') }}</h2>
                            <div class="text-muted small mt-1">Per Kamar</div>
                        </div>

                        <!-- Kapasitas -->
                        <div class="card border-info mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="bg-info rounded-circle p-3 me-3">
                                        <i class="bi bi-people text-white fs-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small">KAPASITAS</div>
                                        <h3 class="mb-0">{{ $kamarHomestay->kapasitas }} Orang</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="d-grid gap-2">
                            <a href="#" class="btn btn-success">
                                <i class="bi bi-calendar-check me-2"></i> Pesan Sekarang
                            </a>
                            <a href="{{ route('homestay.show', $kamarHomestay->homestay_id) }}"
                                class="btn btn-outline-primary">
                                <i class="bi bi-house-door me-2"></i> Lihat Homestay
                            </a>
                        </div>
                    </div>

                    <!-- Data Details -->
                    <div class="col-md-8 p-5">
                        <div class="row">
                            <!-- Informasi Kamar -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle me-2"></i>Informasi Kamar
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Nama Kamar</span>
                                        <span class="text-dark">{{ $kamarHomestay->nama_kamar }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Homestay</span>
                                        <span class="text-muted">
                                            @if($kamarHomestay->homestay)
                                                {{ $kamarHomestay->homestay->nama }}
                                            @else
                                                <span class="text-danger">Homestay tidak ditemukan</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Kapasitas</span>
                                        <span>
                                            <i class="bi bi-people me-1"></i>{{ $kamarHomestay->kapasitas }} Orang
                                        </span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Harga per Malam</span>
                                        <span class="text-success fw-bold">
                                            Rp {{ number_format($kamarHomestay->harga, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Fasilitas Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-warning mb-3 border-bottom pb-2">
                                    <i class="bi bi-star me-2"></i>Fasilitas Kamar
                                </h5>
                                @php
                                    $fasilitas = json_decode($kamarHomestay->fasilitas_json, true) ?? [];
                                @endphp

                                @if(count($fasilitas) > 0)
                                    <div class="card border-warning border-2">
                                        <div class="card-body">
                                            <div class="row g-2">
                                                @foreach($fasilitas as $item)
                                                    <div class="col-6">
                                                        <div class="d-flex align-items-center p-2 bg-warning bg-opacity-10 rounded">
                                                            <i class="bi bi-check-circle-fill text-warning me-2"></i>
                                                            <span class="fw-medium">{{ $item }}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center text-muted py-4">
                                        <i class="bi bi-inbox display-6 mb-3"></i>
                                        <p class="mb-0">Belum ada fasilitas yang tercatat</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Informasi Homestay -->
                            <div class="col-12 mb-4">
                                <h5 class="text-success mb-3 border-bottom pb-2">
                                    <i class="bi bi-house-door me-2"></i>Informasi Homestay
                                </h5>
                                @if($kamarHomestay->homestay)
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <div class="bg-success rounded-circle p-3 me-3">
                                                            <i class="bi bi-house text-white fs-4"></i>
                                                        </div>
                                                        <div>
                                                            <h5 class="mb-1">{{ $kamarHomestay->homestay->nama }}</h5>
                                                            <p class="text-muted small mb-0">
                                                                Status:
                                                                <span>
                                                                    {{ $kamarHomestay->homestay->status }}
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="small">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <i class="bi bi-geo-alt text-success me-2"></i>
                                                            <span>{{ Str::limit($kamarHomestay->homestay->alamat, 60) }}</span>
                                                        </div>
                                                        @if($kamarHomestay->homestay->rt || $kamarHomestay->homestay->rw)
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-pin-map text-success me-2"></i>
                                                                <span>
                                                                    RT {{ $kamarHomestay->homestay->rt ?? '-' }} /
                                                                    RW {{ $kamarHomestay->homestay->rw ?? '-' }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        <i class="bi bi-exclamation-triangle me-2"></i>
                                        Homestay terkait tidak ditemukan atau telah dihapus.
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
                                                <strong>{{ $kamarHomestay->created_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary rounded-circle p-3 me-3">
                                                <i class="bi bi-arrow-clockwise text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Terakhir Diperbarui</small>
                                                <strong>{{ $kamarHomestay->updated_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistik -->
                            <div class="col-lg-6">
                                <h5 class="text-purple mb-3 border-bottom pb-2">
                                    <i class="bi bi-bar-chart me-2"></i>Statistik
                                </h5>
                                <div class="card border-purple border-2">
                                    <div class="card-body">
                                        <div class="row text-center">
                                            <div class="col-6 border-end">
                                                <div class="text-muted small mb-1">PERBANDINGAN</div>
                                                <h4 class="text-purple mb-0">
                                                    {{ $kamarHomestay->harga > 500000 ? 'Premium' : ($kamarHomestay->harga > 250000 ? 'Standar' : 'Ekonomi') }}
                                                </h4>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-muted small mb-1">NILAI</div>
                                                <div class="rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star{{ $i <= 4 ? '-fill' : '' }} text-warning"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
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
                            <i class="bi bi-tag me-1"></i> Kamar ID: {{ $kamarHomestay->kamar_id }}
                            @if($kamarHomestay->homestay)
                                • <i class="bi bi-house me-1 ms-2"></i> Homestay ID: {{ $kamarHomestay->homestay_id }}
                            @endif
                        </span>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('kamar-homestay.destroy', $kamarHomestay->kamar_id) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Hapus Kamar
                            </button>
                        </form>
                        <a href="{{ route('kamar-homestay.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-list me-1"></i> Daftar Kamar
                        </a>
                        <a href="{{ route('homestay.show', $kamarHomestay->homestay_id) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-house me-1"></i> Ke Homestay
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

        .rating i {
            font-size: 1.2rem;
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
        // Copy to clipboard functionality
        function copyToClipboard(text, elementId) {
            navigator.clipboard.writeText(text).then(() => {
                const element = document.getElementById(elementId);
                if (element) {
                    const original = element.innerHTML;
                    element.innerHTML = '<i class="bi bi-check"></i> Tersalin!';
                    setTimeout(() => {
                        element.innerHTML = original;
                    }, 2000);
                }
            });
        }

        // Share via WhatsApp
        function shareViaWhatsApp() {
            const text = `Check out this room: ${encodeURIComponent("{{ $kamarHomestay->nama_kamar }}")}\n` +
                `Price: Rp ${encodeURIComponent("{{ number_format($kamarHomestay->harga, 0, ',', '.') }}")}/night\n` +
                `Capacity: ${encodeURIComponent("{{ $kamarHomestay->kapasitas }}")} people\n` +
                `Homestay: ${encodeURIComponent("{{ $kamarHomestay->homestay->nama ?? 'N/A' }}")}`;

            const url = `https://wa.me/?text=${text}`;
            window.open(url, '_blank');
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Click to copy Kamar ID
            const kamarIdElement = document.querySelector('.text-muted small');
            if (kamarIdElement) {
                kamarIdElement.style.cursor = 'pointer';
                kamarIdElement.title = 'Klik untuk menyalin ID Kamar';
                kamarIdElement.addEventListener('click', function () {
                    copyToClipboard("{{ $kamarHomestay->kamar_id }}", 'kamar-id');
                });
            }
        });
    </script>
@endsection