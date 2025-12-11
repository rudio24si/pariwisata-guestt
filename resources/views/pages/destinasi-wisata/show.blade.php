@extends('layouts.guest.app')

@section('content')
    <div class="container py-5">
        <!-- Header -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header text-white py-4" style="background-color: #004d60;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">
                            <i class="bi bi-geo-alt me-2"></i>Detail Destinasi Wisata
                        </h1>
                        <p class="mb-0 opacity-75">Informasi lengkap tempat wisata</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('destinasi-wisata.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('destinasi-wisata.edit', $destinasi->destinasi_id) }}"
                            class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Image/Icon Side -->
                    <div class="col-md-4 bg-light p-5 text-center border-end">
                        <div class="mb-4">
                            <div class="destination-icon mx-auto mb-3">
                                <i class="bi bi-geo-fill" style="color: #004d60; font-size: 5rem;"></i>
                            </div>
                            <h3 class="mb-1">{{ $destinasi->nama }}</h3>

                            <!-- Quick Actions -->
                            <div class="d-grid gap-2 mt-4">
                                @if($destinasi->kontak)
                                    <a href="tel:{{ $destinasi->kontak }}" class="btn btn-outline-primary">
                                        <i class="bi bi-telephone me-2"></i> Telepon
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $destinasi->kontak) }}"
                                        target="_blank" class="btn btn-outline-success">
                                        <i class="bi bi-whatsapp me-2"></i> WhatsApp
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Details Side -->
                    <div class="col-md-8 p-5">
                        <!-- Deskripsi -->
                        @if($destinasi->deskripsi)
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-card-text me-2"></i>Deskripsi
                                </h5>
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <p class="mb-0">{{ $destinasi->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Alamat -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-success mb-3">
                                    <i class="bi bi-geo me-2"></i>Alamat
                                </h5>
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <p class="mb-1">{{ $destinasi->alamat }}</p>
                                        @if($destinasi->rt && $destinasi->rw)
                                            <p class="mb-0 text-muted">
                                                RT {{ $destinasi->rt }} / RW {{ $destinasi->rw }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Jam Operasional -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-warning mb-3">
                                    <i class="bi bi-clock me-2"></i>Jam Operasional
                                </h5>
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        @if($destinasi->jam_buka && $destinasi->jam_tutup)
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="bg-warning rounded-circle p-3 me-3">
                                                    <i class="bi bi-sun text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Buka</small>
                                                    <strong>{{ date('H:i', strtotime($destinasi->jam_buka)) }}</strong>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary rounded-circle p-3 me-3">
                                                    <i class="bi bi-moon text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Tutup</small>
                                                    <strong>{{ date('H:i', strtotime($destinasi->jam_tutup)) }}</strong>
                                                </div>
                                            </div>
                                        @else
                                            <p class="text-muted mb-0">Tidak tersedia informasi jam operasional</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <!-- Kontak -->
                            @if($destinasi->kontak)
                                <div class="col-lg-6 mb-4">
                                    <h5 class="text-info mb-3">
                                        <i class="bi bi-telephone me-2"></i>Kontak
                                    </h5>
                                    <div class="card bg-light border-0 h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-info rounded-circle p-3 me-3">
                                                    <i class="bi bi-telephone text-white"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Telepon/WhatsApp</small>
                                                    <strong>{{ $destinasi->kontak }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Informasi Tambahan -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-secondary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Informasi
                                </h5>
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-primary rounded-circle p-3 me-3">
                                                <i class="bi bi-calendar-plus text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Dibuat</small>
                                                <strong>{{ $destinasi->created_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success rounded-circle p-3 me-3">
                                                <i class="bi bi-arrow-clockwise text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Terakhir Diperbarui</small>
                                                <strong>{{ $destinasi->updated_at->format('d M Y, H:i') }}</strong>
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
                            <i class="bi bi-hash me-1"></i>ID: {{ $destinasi->destinasi_id }}
                        </span>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('destinasi-wisata.destroy', $destinasi->destinasi_id) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                        <a href="{{ route('destinasi-wisata.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-list me-1"></i> Daftar Destinasi
                        </a>
                        <button onclick="window.print()" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-printer me-1"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <style>
        .destination-icon {
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

        .card {
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            border-radius: 12px 12px 0 0 !important;
        }

        .btn-outline-primary:hover,
        .btn-outline-success:hover {
            transform: translateY(-2px);
            transition: all 0.3s;
        }

        .rounded-circle {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Print Styles */
        @media print {

            .btn-group,
            .card-footer .btn {
                display: none !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>

    <!-- JavaScript untuk WhatsApp -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Format nomor WhatsApp
            const waLinks = document.querySelectorAll('a[href^="https://wa.me/"]');
            waLinks.forEach(link => {
                const href = link.getAttribute('href');
                const cleanNumber = href.replace('https://wa.me/', '');
                if (!cleanNumber.startsWith('62') && cleanNumber.startsWith('0')) {
                    const newNumber = '62' + cleanNumber.substring(1);
                    link.setAttribute('href', `https://wa.me/${newNumber}`);
                }
            });

            // Copy kontak ke clipboard
            const kontakElement = document.querySelector('.card-body strong');
            if (kontakElement && kontakElement.textContent.trim()) {
                kontakElement.style.cursor = 'pointer';
                kontakElement.title = 'Klik untuk menyalin';
                kontakElement.addEventListener('click', function () {
                    const text = this.textContent;
                    navigator.clipboard.writeText(text).then(() => {
                        const original = this.innerHTML;
                        this.innerHTML = '<i class="bi bi-check text-success"></i> Tersalin!';
                        setTimeout(() => {
                            this.innerHTML = original;
                        }, 2000);
                    });
                });
            }
        });
    </script>
@endsection