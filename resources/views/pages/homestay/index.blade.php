@extends('layouts.guest.app')

@section('content')
    <!-- Main -->
    <main>
        <!-- Featured Tour -->
        <div class="featured-tour mt-100 mb-100">
            <new-tab class="d-block">
                <div class="container">
                    <div class="section-headings headings-width text-center">
                        <h2 class="heading text-50" data-aos="fade-up">Homestay</h2>
                        <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Informasi lengkap homestay</div>
                        <a href="{{ route('homestay.create') }}" class="btn btn-primary mt-3" data-aos="fade-up"
                            data-aos-delay="50">Tambah Homestay</a>
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
                                @foreach ($homestays as $h)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="product-card product-card-2 hover-on-image">
                                            <div class="image">
                                                <img src="assets/img/product/1.jpg" width="734" height="534"
                                                    loading="lazy" alt="Product Image">
                                                <div class="card-time-country">
                                                    <div class="person-time-item text text-14">
                                                        <svg width="14" height="20" viewBox="0 0 14 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.9383 9.40178V5.87087C11.9383 5.03169 11.2511 4.33856 10.4118 4.33856H10.2217V4.0992C10.2217 3.50045 9.73629 3.01506 9.13755 3.01506C8.5388 3.01506 8.0534 3.50045 8.0534 4.0992V4.33856H4.07821V4.0992C4.07821 3.49214 3.58607 3 2.97901 3C2.37195 3 1.87981 3.49214 1.87981 4.0992V4.33856H1.71553C0.87631 4.33856 0.193359 5.03169 0.193359 5.87087V13.9786C0.193359 14.8178 0.87631 15.5113 1.71553 15.5113H6.4916C6.88058 15.9765 7.36678 16.351 7.916 16.6082C8.46522 16.8654 9.06412 16.9991 9.67058 17C11.9503 17 13.8073 15.1426 13.8073 12.8628C13.8074 11.4179 13.0525 10.1412 11.9383 9.40178ZM8.6557 4.0992C8.65107 3.8369 8.85991 3.62049 9.12222 3.61585C9.12643 3.61579 9.13065 3.61576 9.13487 3.61579C9.39964 3.61299 9.61659 3.82537 9.61939 4.09017C9.61942 4.09318 9.61942 4.09619 9.61939 4.0992V5.27212H8.6557V4.0992ZM2.48211 4.0992C2.48497 3.82934 2.70607 3.6129 2.97593 3.61576C2.9764 3.61576 2.97686 3.61577 2.97732 3.61579C3.24818 3.61579 3.47591 3.82838 3.47591 4.0992V5.27212H2.48211V4.0992ZM0.795661 5.87087C0.795661 5.36376 1.20842 4.94086 1.71553 4.94086H1.87981V5.5858C1.87981 5.7521 2.0187 5.87443 2.18502 5.87443H3.76968C3.93597 5.87443 4.07821 5.7521 4.07821 5.5858V4.94086H8.0534V5.5858C8.0523 5.62405 8.05903 5.66211 8.07317 5.69766C8.08732 5.7332 8.10858 5.76548 8.13566 5.79251C8.16273 5.81954 8.19505 5.84075 8.23062 5.85484C8.26619 5.86893 8.30427 5.87559 8.34251 5.87443H9.92716C9.96569 5.87571 10.0041 5.86916 10.04 5.85519C10.0759 5.84121 10.1086 5.8201 10.1362 5.79312C10.1637 5.76614 10.1855 5.73386 10.2002 5.69822C10.2149 5.66259 10.2222 5.62435 10.2217 5.5858V4.94086H10.4118C10.9223 4.94601 11.334 5.36033 11.3359 5.87087V6.83811H0.795661V5.87087ZM1.71553 14.909C1.20842 14.909 0.795661 14.4857 0.795661 13.9786V7.44041H11.3359V9.07428C10.8117 8.84412 10.2454 8.72538 9.67287 8.7256C7.39316 8.7256 5.53725 10.5857 5.53725 12.8655C5.5361 13.5817 5.72124 14.2859 6.07448 14.909H1.71553ZM9.67058 16.3923C7.71979 16.3923 6.13835 14.8109 6.13835 12.8601C6.13835 10.9093 7.71979 9.32788 9.67058 9.32788C11.6214 9.32788 13.2028 10.9093 13.2028 12.8601C13.2006 14.81 11.6205 16.3901 9.67058 16.3923Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M11.0896 12.8612H9.77027V11.0492C9.77027 10.8829 9.63545 10.748 9.46912 10.748C9.30279 10.748 9.16797 10.8829 9.16797 11.0492V13.1621C9.16923 13.2426 9.20213 13.3193 9.25955 13.3757C9.31697 13.4321 9.39429 13.4637 9.47478 13.4635H11.0896C11.2559 13.4635 11.3908 13.3287 11.3908 13.1624C11.3908 12.996 11.2559 12.8612 11.0896 12.8612Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                        @php
                                                            $fasilitas = $h->fasilitas_json;
                                                            echo implode(', ', $fasilitas ?? []);
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <a href="booking-details.html" class="product-title no-underline"
                                                    aria-label="product card">
                                                    <h2 class="heading text-24">{{ $h->nama }}</h2>
                                                </a>
                                                <div class="price-booking-wrap">
                                                    <div class="card-price">
                                                        <div class="price-text text text-12">Mulai Dari:</div>
                                                        <div class="price-regular-compare">
                                                            @php
                                                                $formattedHarga = number_format(
                                                                    $h->harga_per_malam,
                                                                    0,
                                                                    ',',
                                                                    '.',
                                                                );
                                                            @endphp
                                                            <div class="regular-price heading text-24 text-sky">
                                                                Rp{{ $formattedHarga }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ route('homestay.show', $h->homestay_id) }}"
                                                            class="btn btn-info btn-sm px-2" title="Detail">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="visually-hidden">Detail</span>
                                                        </a>

                                                        <a href="{{ route('homestay.edit', $h->homestay_id) }}"
                                                            class="btn btn-warning btn-sm px-2" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                            <span class="visually-hidden">Edit</span>
                                                        </a>

                                                        <form action="{{ route('homestay.destroy', $h->homestay_id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm px-2"
                                                                title="Hapus"
                                                                onclick="return confirm('Hapus {{ addslashes($h->nama) }}?')">
                                                                <i class="bi bi-trash"></i>
                                                                <span class="visually-hidden">Hapus</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </new-tab>
        </div>
    </main>
@endsection
