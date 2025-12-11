@extends('layouts.guest.app')

@section('content')
    <!-- Main -->
    <main>
        <!-- Destinasi Wisata -->
        <div class="featured-tour mt-100">
            <div class="container mb-5">
                <div class="section-headings headings-width text-center">
                    <h2 class="heading text-50" data-aos="fade-up">Destinasi Wisata</h2>
                    <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Inforasi lengkap destinasi wisata</div>
                    <a href="{{ route('destinasi-wisata.create') }}" class="btn btn-primary mt-3" data-aos="fade-up"
                        data-aos-delay="50">Tambah Destinasi Wisata</a>
                </div>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3" data-aos="fade-up" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="section-content">
                    <div class="row grid-gap">
                        @foreach($destinasi as $d)
                            <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up">
                                <div class="product-card product-card-3 radius16 hover-on-image">
                                    <div class="image">
                                        <img src="assets/img/product/6.jpg" width="734" height="446" loading="lazy"
                                            alt="Product Image">
                                        <toggle-btn>
                                            <button type="button" class="wishlist-icon toogle-btn text-sky svg-wrapper"
                                                aria-label="Wishlist button">
                                                <svg viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.0705 9.36168L11.4136 15.0186C10.6326 15.7996 9.36623 15.7996 8.58519 15.0186L2.92833 9.36168C0.975712 7.40908 0.975712 4.24326 2.92833 2.29064C4.88095 0.338014 8.04678 0.338014 9.9994 2.29064C11.952 0.338014 15.1178 0.338014 17.0705 2.29064C19.0231 4.24326 19.0231 7.40908 17.0705 9.36168Z"
                                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </toggle-btn>
                                    </div>
                                    <div class="content">
                                        <a href="booking-details.html" class="no-underline product-title"
                                            aria-label="Product title">
                                            <h2 class="heading text-24">{{ $d->nama }}</h2>
                                        </a>
                                        <div class="text text-16">{{$d->deskripsi}}</div>
                                        <div class="price-booking-wrap">
                                            <div class="card-review-price">
                                                <div class="review text text-14">
                                                    <svg class="icon-12" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_58_3674)">
                                                            <path
                                                                d="M11.4485 4.58548C11.3733 4.35305 11.1672 4.18797 10.9233 4.16599L7.6103 3.86517L6.30026 0.798893C6.20367 0.574174 5.98368 0.428711 5.73925 0.428711C5.49483 0.428711 5.27484 0.574174 5.17825 0.799418L3.86821 3.86517L0.554701 4.16599C0.311242 4.1885 0.105615 4.35305 0.0300369 4.58548C-0.0455407 4.8179 0.0242569 5.07283 0.208428 5.23354L2.71265 7.42975L1.97421 10.6826C1.92018 10.9217 2.01301 11.169 2.21145 11.3124C2.31812 11.3895 2.44292 11.4287 2.56876 11.4287C2.67727 11.4287 2.7849 11.3994 2.88149 11.3416L5.73925 9.63368L8.59597 11.3416C8.80501 11.4674 9.06852 11.4559 9.26653 11.3124C9.46506 11.1685 9.55781 10.9212 9.50377 10.6826L8.76534 7.42975L11.2696 5.23397C11.4537 5.07283 11.524 4.81834 11.4485 4.58548Z"
                                                                fill="currentColor" />
                                                        </g>
                                                        <defs>
                                                            <clipPath>
                                                                <rect width="12" height="12" fill="currentColor" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <strong>4.96</strong> (672 reviews)
                                                </div>
                                                <div class="card-price">
                                                    @php
                                                        $formattedTiket = number_format($d->tiket, 0, ',', '.');
                                                    @endphp

                                                    <span class="heading text-24">Rp{{ $formattedTiket }}</span>
                                                    <span class="text text-16">/ person</span>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('destinasi-wisata.show', $d->destinasi_id) }}"
                                                class="btn btn-info btn-sm px-2" title="Detail">
                                                    <i class="bi bi-eye"></i>
                                                    <span class="visually-hidden">Detail</span>
                                                </a>
                                                
                                                <a href="{{ route('destinasi-wisata.edit', $d->destinasi_id) }}"
                                                class="btn btn-warning btn-sm px-2" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                    <span class="visually-hidden">Edit</span>
                                                </a>
                                                
                                                <form action="{{ route('destinasi-wisata.destroy', $d->destinasi_id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm px-2" 
                                                            title="Hapus"
                                                            onclick="return confirm('Hapus {{ addslashes($d->nama) }}?')">
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
                <div class="section-bottom-button" data-aos="fade-up" data-aos-delay="150">
                    <a href="destination-list.html" class="button button--primary" aria-label="view all package">View
                        All Package
                        <div class="svg-wrapper icon-24">
                            <svg viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.157 12.7106L4.5 18.3676L3.086 16.9536L8.036 12.0036L3.086 7.05365L4.5 5.63965L10.157 11.2966C10.3445 11.4842 10.4498 11.7385 10.4498 12.0036C10.4498 12.2688 10.3445 12.5231 10.157 12.7106Z"
                                    fill="currentColor" />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection