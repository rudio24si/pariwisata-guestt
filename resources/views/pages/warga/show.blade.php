@extends('layouts.guest.app')

@section('content')
    <div class="container py-5">
        <!-- Header dengan gradient -->
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header text-white py-4" style="background-color: #004d60;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">
                            <i class="bi bi-person-badge me-2"></i>Detail Data Warga
                        </h1>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('warga.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="card-body p-0">
                <div class="row g-0">
                    <!-- Avatar / Profile Picture Side -->
                    <div class="col-md-4 bg-light p-5 text-center border-end">
                        <div class="mb-4">
                            <div class="avatar-circle mx-auto mb-3">
                                @if($warga->jenis_kelamin == 'L')
                                    <i class="bi bi-gender-male text-primary" style="font-size: 5rem;"></i>
                                @else
                                    <i class="bi bi-gender-female text-pink" style="font-size: 5rem;"></i>
                                @endif
                            </div>
                            <h3 class="mb-1">{{ $warga->nama }}</h3>
                        </div>

                        <!-- Quick Actions -->
                        <div class="d-grid gap-2">
                            @if($warga->telp)
                                <a href="tel:{{ $warga->telp }}" class="btn btn-outline-primary">
                                    <i class="bi bi-telephone me-2"></i> Telepon
                                </a>
                            @endif

                            @if($warga->email)
                                <a href="mailto:{{ $warga->email }}" class="btn btn-outline-success">
                                    <i class="bi bi-envelope me-2"></i> Email
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Data Details -->
                    <div class="col-md-8 p-5">
                        <div class="row">
                            <!-- Identitas Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-card-checklist me-2"></i>Identitas
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">No. KTP</span>
                                        <span class="text-muted">{{ $warga->no_ktp }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Nama Lengkap</span>
                                        <span class="text-dark">{{ $warga->nama }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Agama</span>
                                        <span class="text-muted">{{ $warga->agama }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Kelamin</span>
                                        <span class="text-muted">{{ $warga->jenis_kelamin }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Kontak Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-success mb-3 border-bottom pb-2">
                                    <i class="bi bi-telephone me-2"></i>Kontak
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Telepon</span>
                                        <span class="text-muted">
                                            {{ $warga->telp ?: '<span class="text-muted fst-italic">Belum diisi</span>' }}
                                        </span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Email</span>
                                        <span class="text-muted">
                                            {{ $warga->email ?: '<span class="text-muted fst-italic">Belum diisi</span>' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pekerjaan Section -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-warning mb-3 border-bottom pb-2">
                                    <i class="bi bi-briefcase me-2"></i>Pekerjaan
                                </h5>
                                <div class="card bg-light border-0">
                                    <div class="card-body text-center py-4">
                                        <i class="bi bi-briefcase display-6 text-warning mb-3"></i>
                                        <h4 class="mb-0">{{ $warga->pekerjaan }}</h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Tambahan -->
                            <div class="col-lg-6 mb-4">
                                <h5 class="text-info mb-3 border-bottom pb-2">
                                    <i class="bi bi-info-circle me-2"></i>Informasi
                                </h5>
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="bg-info rounded-circle p-3 me-3">
                                                <i class="bi bi-calendar text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Dibuat</small>
                                                <strong>{{ $warga->created_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary rounded-circle p-3 me-3">
                                                <i class="bi bi-arrow-clockwise text-white"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Terakhir Diperbarui</small>
                                                <strong>{{ $warga->updated_at->format('d M Y, H:i') }}</strong>
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
                <div class="d-flex justify-content-between">
                    <div>
                        <span class="text-muted small">ID Warga: {{ $warga->warga_id }}</span>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Hapus Data
                            </button>
                        </form>
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-list me-1"></i> Daftar Warga
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

        .bg-pink {
            background-color: #f783ac;
        }

        .text-pink {
            color: #f783ac;
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
    </style>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Optional: JavaScript for interactivity -->
    <script>
        // Copy to clipboard functionality
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

        // Add click to copy for KTP
        document.addEventListener('DOMContentLoaded', function () {
            const ktpElement = document.querySelector('.list-group-item:first-child .text-muted');
            if (ktpElement) {
                ktpElement.style.cursor = 'pointer';
                ktpElement.title = 'Klik untuk menyalin';
                ktpElement.addEventListener('click', function () {
                    copyToClipboard('{{ $warga->no_ktp }}', 'ktp-copy');
                });
            }
        });
    </script>
@endsection