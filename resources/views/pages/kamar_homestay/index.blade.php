@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="popular-destination mt-100 mb-100">
            <div class="container">
                <div class="section-headings section-headings-horizontal mb-5">
                    <div class="section-headings-left" data-aos="fade-up">
                        <h2 class="heading text-50">Kamar Homestay</h2>
                        <div class="text text-18">Informasi lengkap kamar homestay</div>
                    </div>
                    <div class="section-headings-right d-flex flex-column align-items-end gap-3">
                        <a href="{{ route('kamar-homestay.create') }}" class="button button--primary d-none d-md-flex"
                            aria-label="Button" data-aos="fade-up" data-aos-delay="50">
                            Tambah Kamar Homestay
                        </a>
                    </div>
                </div>

                <div class="row mb-5 justify-content-center" data-aos="fade-up">
                    <div class="col-lg-10">
                        <form action="{{ route('kamar-homestay.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select name="sort" class="form-select border-primary py-2"
                                        onchange="this.form.submit()">
                                        <option value="">-- Urutkan Harga --</option>
                                        <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga
                                            Termurah</option>
                                        <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga
                                            Tertinggi</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control border-primary py-2"
                                            placeholder="Cari nama kamar..." value="{{ request('search') }}">
                                        @if(request('search') || request('sort'))
                                            <a href="{{ route('kamar-homestay.index') }}"
                                                class="btn btn-outline-danger d-flex align-items-center">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        @endif
                                        <button class="btn btn-primary px-4" type="submit">
                                            <i class="bi bi-search me-2"></i>Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" data-aos="fade-up" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="section-content">
                    <div class="row grid-gap">
                        @forelse ($kamars as $kamar)
                            <div class="col-md-4 col-12" data-aos="fade-up">
                                <div class="popular-item-wrap popular-item-vertical border-wrapper radius16 hover-on-image">
                                    <div class="popular-item">
                                        <div class="image">
                                            @if($kamar->media->count() > 0)
                                                <img src="{{ asset('images/' . $kamar->media->first()->file_name) }}" width="734"
                                                    height="534" loading="lazy" alt="Product Image">
                                            @else
                                                <div
                                                    style="width:100%; height:200px; background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <div class="destination-info">
                                                <h2 class="heading text-24">{{ $kamar->nama_kamar }}</h2>
                                                <div class="text text-16">{{ $kamar->homestay->nama ?? 'N/A' }}</div>
                                                <div class="text text-14 text-muted mt-1">
                                                    <i class="bi bi-people me-1"></i>{{ $kamar->kapasitas }} orang •
                                                    <strong>Rp {{ number_format($kamar->harga, 0, ',', '.') }}/malam</strong>
                                                </div>
                                            </div>

                                            <div class="d-flex gap-1 mt-3">
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
                                                    <button type="submit" onclick="return confirm('Hapus kamar ini?')"
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
                        @empty
                            <div class="col-12 text-center py-5">
                                <div class="alert alert-info py-4">
                                    <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
                                    Kamar tidak ditemukan dengan kriteria tersebut.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        {{ $kamars->links() }}
                    </div>

                    <a href="{{ route('kamar-homestay.index') }}" class="button button--primary d-md-none d-flex mt-4"
                        aria-label="Button">
                        View All
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection