@extends('layouts.guest.app')

@section('content')
    <main>
        <section class="hero-slider vh-100 w-100">
            <div id="heroCarousel" class="carousel slide carousel-fade h-100" data-bs-ride="carousel">
                <div class="carousel-inner h-100">
                    {{-- Slide 1 --}}
                    <div class="carousel-item active h-100">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                            class="d-block w-100 h-100" style="object-fit: cover;" alt="Slider 1">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-25 rounded shadow-sm p-4"
                            style="bottom: 20%;">
                            <h1 class="display-3 fw-bold text-white">Selamat Datang</h1>
                            <p class="fs-4 text-white">Temukan kenyamanan menginap terbaik untuk perjalanan Anda.</p>
                        </div>
                    </div>
                    {{-- Slide 2 --}}
                    <div class="carousel-item h-100">
                        <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                            class="d-block w-100 h-100" style="object-fit: cover;" alt="Slider 2">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-25 rounded shadow-sm p-4"
                            style="bottom: 20%;">
                            <h1 class="display-3 fw-bold text-white">Kamar Eksklusif</h1>
                            <p class="fs-4 text-white">Fasilitas lengkap dengan pemandangan yang memukau.</p>
                        </div>
                    </div>
                </div>
                {{-- Navigasi Slider --}}
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

        <div class="featured-tour mt-100 mb-100">
            <div class="container">
                <div class="section-headings section-headings-horizontal mb-4">
                    <div class="section-headings-left">
                        <h2 class="heading text-50" data-aos="fade-up">Booking Kamar</h2>
                        <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Pilih tipe kamar yang sesuai dengan
                            kebutuhan Anda</div>
                    </div>

                    <div class="section-headings-right col-lg-7" data-aos="fade-up" data-aos-delay="100">
                        <form action="{{ url()->current() }}" method="GET" class="row g-2">
                            <div class="col-md-5">
                                <select name="sort" class="form-select border-primary py-2" onchange="this.form.submit()">
                                    <option value="">-- Urutkan Harga --</option>
                                    <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah
                                    </option>
                                    <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control border-primary"
                                        placeholder="Cari nama kamar..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                    @if(request('search') || request('sort'))
                                        <a href="{{ url()->current() }}" class="btn btn-outline-danger">Reset</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tab-contents section-content">
                    <div class="tab-item group active">
                        <div class="row grid-gap">
                            @forelse ($kamars as $k)
                                <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up">
                                    <div class="product-card radius16 hover-on-image">
                                        <div class="image">
                                            @if($k->media->count() > 0)
                                                <img src="{{ asset('images/' . $k->media->first()->file_name) }}" width="734"
                                                    height="534" style="object-fit: cover;" loading="lazy" alt="Product Image">
                                            @else
                                                <img src="{{ asset('assets/img/product/1.jpg') }}" width="734" height="534"
                                                    style="object-fit: cover;" loading="lazy" alt="Product Image">
                                            @endif
                                            <div class="badge text text-16 fw-500">Kamar Tersedia</div>
                                        </div>
                                        <div class="content">
                                            <a href="#" class="no-underline product-title">
                                                <h2 class="heading text-24">{{ $k->nama_kamar }}</h2>
                                            </a>
                                            <ul class="card-person-time list-unstyled">
                                                <li class="person-time-item text text-16">
                                                    <i class="bi bi-info-circle me-2"></i>
                                                    @php
                                                        $fasilitas = $k->fasilitas_json;
                                                        if (is_string($fasilitas)) {
                                                            $fasilitas = json_decode($fasilitas, true);
                                                        }
                                                    @endphp
                                                    {{ is_array($fasilitas) ? implode(', ', $fasilitas) : 'Fasilitas standar' }}
                                                </li>
                                                <li class="person-time-item text text-16">
                                                    <i class="bi bi-people me-2"></i>
                                                    {{ $k->kapasitas }} Orang
                                                </li>
                                            </ul>
                                            <div class="price-booking-wrap">
                                                <div class="card-price">
                                                    <span
                                                        class="heading text-24">Rp{{ number_format($k->harga, 0, ',', '.') }}</span>
                                                </div>
                                                <a href="{{ route('booking-homestay.create', ['kamar_id' => $k->kamar_id]) }}"
                                                    class="button button--primary button--slim">Pesan Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <h3 class="text-muted">Kamar tidak ditemukan...</h3>
                                    <a href="{{ url()->current() }}" class="btn btn-link">Lihat semua kamar</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                        {{ $kamars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection