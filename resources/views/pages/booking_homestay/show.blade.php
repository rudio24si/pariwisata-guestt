@extends('layouts.guest.app')

@section('content')
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Header Section --}}
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
                    <div class="mb-3 mb-md-0">
                        <h1 class="fw-bold mb-2">Detail Booking</h1>
                        <p class="text-muted mb-0">
                            <i class="bi bi-ticket-perforated me-1"></i>
                            ID Booking: <span class="fw-semibold">#{{ $booking->booking_id }}</span>
                        </p>
                    </div>

                    {{-- Status Badge --}}
                    @php
                        $statusConfig = [
                            'pending' => ['color' => 'warning', 'icon' => 'clock'],
                            'confirmed' => ['color' => 'primary', 'icon' => 'check-circle'],
                            'checked_in' => ['color' => 'info', 'icon' => 'door-open'],
                            'checked_out' => ['color' => 'success', 'icon' => 'box-arrow-right'],
                            'cancelled' => ['color' => 'danger', 'icon' => 'x-circle']
                        ];
                        $config = $statusConfig[$booking->status] ?? ['color' => 'secondary', 'icon' => 'question-circle'];
                    @endphp
                    <span class="badge bg-{{ $config['color'] }} fs-6 px-4 py-2 d-inline-flex align-items-center">
                        <i class="bi bi-{{ $config['icon'] }} me-2"></i>
                        {{ strtoupper(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>

                {{-- Main Content --}}
                <div class="row g-4">
                    {{-- Left Column --}}
                    <div class="col-md-7">
                        {{-- Guest & Room Information Card --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="card-title fw-bold mb-0">
                                    <i class="bi bi-person-badge me-2"></i>
                                    Informasi Tamu & Kamar
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <small class="text-muted d-block mb-1">Nama Tamu</small>
                                        <span class="fw-semibold">
                                            {{ $booking->warga?->nama ?? 'Data warga tidak ditemukan' }}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block mb-1">No. KTP</small>
                                        <span>{{ $booking->warga->no_ktp ?? '-' }}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block mb-1">No. Telepon</small>
                                        <span>{{ $booking->warga->no_telepon ?? '-' }}</span>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Homestay</small>
                                        <span class="fw-semibold">{{ $booking->kamar->homestay->nama }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Tipe Kamar</small>
                                        <span>{{ $booking->kamar->nama_kamar }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Proof Card --}}
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom-0 py-3">
                                <h5 class="card-title fw-bold mb-0">
                                    <i class="bi bi-receipt me-2"></i>
                                    Bukti Pembayaran
                                </h5>
                            </div>
                            <div class="card-body">
                                @if($booking->media->count() > 0)
                                    <div class="row g-3">
                                        @foreach($booking->media as $media)
                                            <div class="col-md-6">
                                                <div class="border rounded overflow-hidden position-relative">
                                                    <a href="{{ asset('images/' . $media->file_name) }}" class="glightbox"
                                                        data-gallery="payment-gallery">
                                                        <img src="{{ asset('images/' . $media->file_name) }}"
                                                            class="img-fluid w-100" style="height: 200px; object-fit: cover;"
                                                            alt="Bukti Pembayaran {{ $loop->iteration }}">
                                                    </a>
                                                    <div class="bg-dark bg-opacity-75 text-white p-2 text-center">
                                                        <small>Klik untuk memperbesar</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="bi bi-image text-muted fs-1 d-block mb-3"></i>
                                        <p class="text-muted mb-0">Belum ada bukti pembayaran yang diunggah</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div class="col-md-5">
                        {{-- Stay Duration Card --}}
                        <div class="card border-0 shadow-sm mb-4">
                            <div
                                class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                                <h5 class="card-title fw-bold mb-0">
                                    <i class="bi bi-calendar-range me-2"></i>
                                    Waktu Menginap
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <small class="text-muted d-block mb-1">Check-in</small>
                                        <span class="fw-bold">
                                            {{ \Carbon\Carbon::parse($booking->checkin)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                    <i class="bi bi-arrow-right text-primary fs-4"></i>
                                    <div class="text-end">
                                        <small class="text-muted d-block mb-1">Check-out</small>
                                        <span class="fw-bold">
                                            {{ \Carbon\Carbon::parse($booking->checkout)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Durasi Menginap Sederhana --}}
                                <div class="text-center mt-4 pt-3 border-top">
                                    <div class="d-inline-flex align-items-center bg-light rounded-pill px-4 py-2">
                                        <i class="bi bi-moon-stars text-primary me-2"></i>
                                        <span class="fw-bold fs-5">
                                            {{ \Carbon\Carbon::parse($booking->checkin)->diffInDays($booking->checkout) }}
                                            Malam Menginap
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Payment Details Card --}}
                        <div class="card border-0 shadow-sm mb-4"
                            style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                            <div class="card-body text-white">
                                <h5 class="card-title mb-4">
                                    <i class="bi bi-cash-stack me-2"></i>
                                    Rincian Pembayaran
                                </h5>

                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <small class="text-white-50 d-block mb-1">Harga per Malam</small>
                                        <span>Rp {{ number_format($booking->kamar->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-white-50 d-block mb-1">Metode Pembayaran</small>
                                        <span class="text-capitalize">{{ $booking->metode_bayar }}</span>
                                    </div>
                                </div>

                                <hr class="border-white opacity-25 my-4">

                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <div>
                                        <div class="fs-5 fw-bold">Total Bayar</div>
                                        <small class="text-white-75">Sudah termasuk pajak <br> dan biaya layanan</small>
                                    </div>
                                    <div class="fs-3 fw-bold">
                                        Rp {{ number_format($booking->total, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            {{-- Cetak --}}
                            <button onclick="window.print()" class="btn btn-outline-secondary d-flex align-items-center"
                                title="Cetak Detail Booking">
                                <i class="bi bi-printer fs-5"></i>
                            </button>

                            {{-- Kembali --}}
                            <a href="{{ route('booking-homestay.index') }}"
                                class="btn btn-light border d-flex align-items-center" title="Kembali ke Daftar">
                                <i class="bi bi-arrow-left fs-5"></i>
                            </a>

                            {{-- Edit --}}
                            @if(in_array($booking->status, ['pending', 'confirmed']))
                                <a href="{{ route('booking-homestay.edit', $booking->booking_id) }}"
                                    class="btn btn-outline-primary d-flex align-items-center" title="Edit Data Booking">
                                    <i class="bi bi-pencil-square fs-5"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Print Styles --}}
    <style>
        @media print {

            .no-print,
            .btn,
            .badge,
            .card-header,
            .glightbox,
            .border-top,
            hr {
                display: none !important;
            }

            .card {
                border: 1px solid #dee2e6 !important;
                box-shadow: none !important;
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 1rem !important;
            }

            body {
                font-size: 12pt;
                color: #000;
                background: #fff;
            }

            .text-primary {
                color: #000 !important;
            }

            .bg-primary {
                background-color: #fff !important;
                color: #000 !important;
                border: 1px solid #000 !important;
            }

            .container {
                max-width: 100% !important;
            }

            .row {
                display: block !important;
            }

            .col-md-7,
            .col-md-5 {
                width: 100% !important;
                flex: none !important;
                max-width: 100% !important;
            }

            img {
                max-width: 300px !important;
            }
        }

        .glightbox img {
            cursor: zoom-in;
            transition: transform 0.3s ease;
        }

        .glightbox img:hover {
            transform: scale(1.02);
        }
    </style>
@endsection

@push('scripts')
    @if($booking->media->count() > 0)
        <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const lightbox = GLightbox({
                    selector: '.glightbox',
                    touchNavigation: true,
                    loop: true,
                    zoomable: true,
                    draggable: true
                });
            });
        </script>
    @endif
@endpush

@push('styles')
    @if($booking->media->count() > 0)
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">
    @endif
@endpush