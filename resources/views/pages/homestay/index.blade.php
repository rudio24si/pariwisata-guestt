@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="featured-tour mt-100 mb-100">
            <div class="container">
                <div class="section-headings headings-width text-center mb-5">
                    <h2 class="heading text-50" data-aos="fade-up">Homestay</h2>
                    <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Informasi lengkap homestay</div>
                    <a href="{{ route('homestay.create') }}" class="btn btn-primary mt-4" data-aos="fade-up"
                        data-aos-delay="50">Tambah Homestay</a>

                    <div class="mt-4 row justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-10">
                            <form action="{{ route('homestay.index') }}" method="GET">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <select name="sort" class="form-select border-primary h-100"
                                            onchange="this.form.submit()">
                                            <option value="">-- Urutkan Harga --</option>
                                            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>
                                                Harga Termurah</option>
                                            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>
                                                Harga Tertinggi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group h-100">
                                            <input type="text" name="search" class="form-control border-primary"
                                                placeholder="Cari nama homestay..." value="{{ request('search') }}">
                                            @if(request('search') || request('sort'))
                                                <a href="{{ route('homestay.index') }}"
                                                    class="btn btn-outline-danger d-flex align-items-center">
                                                    <i class="bi bi-x-circle"></i>
                                                </a>
                                            @endif
                                            <button class="btn btn-primary px-4" type="submit">
                                                <i class="bi bi-search me-1"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" data-aos="fade-up" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="section-content tab-contents" data-aos="fade-up" data-aos-delay="150">
                    <div class="tab-item group active">
                        <div class="row grid-gap">
                            @forelse ($homestays as $h)
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="product-card product-card-2 hover-on-image">
                                        <div class="image">
                                            @if($h->media->count() > 0)
                                                <img src="{{ asset('images/' . $h->media->first()->file_name) }}" width="734"
                                                    height="534" loading="lazy" alt="Product Image">
                                            @else
                                                <img src="{{ asset('assets/img/product/1.jpg') }}" width="734" height="534"
                                                    loading="lazy" alt="Product Image">
                                            @endif
                                            <div class="card-time-country">
                                                <div class="person-time-item text text-14">
                                                    <i class="bi bi-house-door me-1"></i>
                                                    @php
                                                        $fasilitas = $h->fasilitas_json;
                                                        if (is_string($fasilitas)) {
                                                            $fasilitas = json_decode($fasilitas, true);
                                                        }
                                                    @endphp
                                                    {{ is_array($fasilitas) ? implode(', ', $fasilitas) : 'Tidak ada fasilitas' }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <a href="{{ route('homestay.show', $h->homestay_id) }}"
                                                class="product-title no-underline">
                                                <h2 class="heading text-24">{{ $h->nama }}</h2>
                                            </a>
                                            <div class="price-booking-wrap">
                                                <div class="card-price">
                                                    <div class="price-text text text-12">Mulai Dari:</div>
                                                    <div class="price-regular-compare">
                                                        <div class="regular-price heading text-24 text-sky">
                                                            Rp{{ number_format($h->harga_per_malam, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('homestay.show', $h->homestay_id) }}"
                                                        class="btn btn-info btn-sm px-2" title="Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('homestay.edit', $h->homestay_id) }}"
                                                        class="btn btn-warning btn-sm px-2" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('homestay.destroy', $h->homestay_id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm px-2" title="Hapus"
                                                            onclick="return confirm('Hapus {{ addslashes($h->nama) }}?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center mt-5">
                                    <div class="alert alert-info py-5">
                                        <i class="bi bi-info-circle fs-2 d-block mb-3"></i>
                                        Data homestay tidak ditemukan dengan kriteria tersebut.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            {{ $homestays->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection