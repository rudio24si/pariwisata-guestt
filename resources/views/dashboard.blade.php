@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="featured-tour mt-100 mb-100">
            <div class="container">
                <div class="section-headings section-headings-horizontal mb-4">
                    <div class="section-headings-left">
                        <h2 class="heading text-50" data-aos="fade-up">Booking</h2>
                        <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Booking kamar sekarang</div>
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
                                                    height="534" loading="lazy" alt="Product Image">
                                            @else
                                                <img src="{{ asset('assets/img/product/1.jpg') }}" width="734" height="534"
                                                    loading="lazy" alt="Product Image">
                                            @endif
                                            <div class="badge text text-16 fw-500">Top Rated</div>
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
                                                    class="button button--primary button--slim">Book Now</a>
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