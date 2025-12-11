@extends('layouts.guest.app')

@section('content')
    <!-- Main -->
    <main>
        <!-- Popular Destination -->
        <div class="popular-destination mt-100 vh-100">
            <div class="container">
                <div class="section-headings section-headings-horizontal">
                    <div class="section-headings-left" data-aos="fade-up">
                        <h2 class="heading text-50">
                            Kamar Homestay
                        </h2>
                        <div class="text text-18">Informasi lengkap kamar homestay</div>
                    </div>
                    <a href="{{ route('kamar-homestay.create') }}" class="button button--primary d-none d-md-flex"
                        aria-label="Button" data-aos="fade-up" data-aos-delay="50">
                        Tambah Kamar Homestay
                    </a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" data-aos="fade-up" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="section-content">
                    <div class="row grid-gap">
                        @foreach ($kamars as $kamar)
                            <div class="col-md-4 col-12" data-aos="fade-up">
                                <div class="popular-item-wrap popular-item-vertical border-wrapper radius16 hover-on-image">
                                    <div class="popular-item">
                                        <div class="image radius16">
                                            <!-- Gambar kamar -->
                                            <div
                                                style="width:100%; height:200px; background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                <!-- Placeholder image atau gambar real -->
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="destination-info">
                                                <h2 class="heading text-24">{{ $kamar->nama_kamar }}</h2>
                                                <div class="text text-16">{{ $kamar->homestay->nama }}</div>
                                                <div class="text text-14 text-muted mt-1">
                                                    <i class="bi bi-people me-1"></i>{{ $kamar->kapasitas }} orang •
                                                    Rp {{ number_format($kamar->harga, 0, ',', '.') }}/malam
                                                </div>
                                            </div>

                                            <!-- Tombol Action -->
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('kamar-homestay.show', $kamar->kamar_id) }}"
                                                    class="button button--secondary button--icon" title="Lihat">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                                </a>

                                                <a href="{{ route('kamar-homestay.edit', $kamar->kamar_id) }}"
                                                    class="button button--secondary button--icon" title="Edit">
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('kamar-homestay.destroy', $kamar->kamar_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus?')"
                                                        class="button button--secondary button--icon" title="Hapus">
                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor">
                                                            <path d="M3 6h18" />
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="destination.html" class="button button--primary d-md-none d-flex" aria-label="Button"
                        data-aos="fade-up" data-aos-delay="50">
                        View All
                        <div class="svg-wrapper icon-18">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none" />
                                <polyline points="96 48 176 128 96 208" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection