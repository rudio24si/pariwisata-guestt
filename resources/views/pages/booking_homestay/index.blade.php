@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="featured-tour mt-100 mb-100">
            <div class="container">
                <div class="section-headings section-headings-horizontal mb-4">
                    <div class="section-headings-left">
                        <h2 class="heading text-50" data-aos="fade-up">Booking</h2>
                        <div class="text text-18" data-aos="fade-up" data-aos-delay="50">
                            Booking saya
                        </div>
                    </div>
                </div>

                {{-- Daftar Booking --}}
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse($bookings as $booking)
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0" data-aos="fade-up">
                                {{-- Foto Kamar --}}
                                <div class="position-relative">
                                    @if($booking->kamar && $booking->kamar->media->count() > 0)
                                        <img src="{{ asset('images/' . $booking->kamar->media->first()->file_name) }}"
                                            class="card-img-top" alt="{{ $booking->kamar->nama_kamar }}"
                                            style="height: 200px; object-fit: cover;">
                                     @else
                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                            style="height: 200px;">
                                            <span class="text-muted">Tanpa Foto</span>
                                        </div>
                                    @endif

                                    {{-- Badge Status --}}
                                    <div class="top-0 end-0 m-2">
                                        @php
                                            $statusColors = [
                                                'confirmed' => 'success',
                                                'cancelled' => 'danger',
                                                'pending' => 'warning',
                                            ];
                                            $color = $statusColors[$booking->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge rounded-pill bg-{{ $color }}">
                                            {{ strtoupper($booking->status) }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Card Body --}}
                                <div class="card-body">
                                    <h5 class="card-title fw-bold text-primary mb-3">
                                        {{ $booking->kamar->nama_kamar ?? 'Nama Kamar Tidak Ditemukan' }}
                                    </h5>

                                    {{-- Total Harga --}}
                                    <div class="mb-3">
                                        <small class="text-muted d-block">Total Pembayaran:</small>
                                        <span class="fs-5 fw-bold text-dark">
                                            Rp {{ number_format($booking->total, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    {{-- Tanggal Check-in --}}
                                    <div class="mb-3 d-flex">
                                        <div class="col">
                                            <small class="text-muted d-block mb-1">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                Tanggal Check-in
                                            </small>
                                            <span class="text-dark">
                                                {{ \Carbon\Carbon::parse($booking->checkin)->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                        <div class="col">
                                            <small class="text-muted d-block mb-1">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                Tanggal Check-Out
                                            </small>
                                            <span class="text-dark">
                                                {{ \Carbon\Carbon::parse($booking->checkout)->translatedFormat('d F Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card Footer --}}
                                <div class="card-footer bg-white border-top pb-3">
                                    {{-- Baris 1: Tombol Detail (Full Width) --}}
                                    <div class="d-grid mb-2">
                                        <a href="{{ route('booking-homestay.show', $booking->booking_id) }}"
                                            class="btn btn-outline-primary">
                                            <i class="bi bi-eye me-2"></i>Lihat Detail
                                        </a>
                                    </div>

                                    {{-- Baris 2: Tombol Edit dan Hapus (Berdampingan) --}}
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="d-grid">
                                                <a href="{{ route('booking-homestay.edit', $booking->booking_id) }}"
                                                    class="btn btn-outline-warning">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('booking-homestay.destroy', $booking->booking_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="bi bi-trash me-2"></i>Hapus
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12" data-aos="fade-up">
                            <div class="alert alert-info text-center py-4">
                                <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                                <h5 class="mb-2">Belum ada booking</h5>
                                <p class="mb-0">Anda belum melakukan booking kamar.</p>
                                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                                    Booking Kamar Sekarang
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($bookings->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection


@push('styles')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .card-img-top {
            border-radius: 8px 8px 0 0;
        }

        .alert-info {
            border-radius: 12px;
            border: none;
            background-color: #f8f9fa;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 3px;
            border: 1px solid #dee2e6;
        }

        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
@endpush