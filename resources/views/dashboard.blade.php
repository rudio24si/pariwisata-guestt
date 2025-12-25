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
                        {{ $kamars->links('pagination::bootstrap-5') }}
                    </div>

                    <!-- Kartu Identitas Pengembang -->
                    <div class="developer-card mt-5 mb-5" data-aos="fade-up">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div
                                        class="col-md-4 bg-light d-flex align-items-center justify-content-center py-5 py-md-0">
                                        <div class="profile-img-wrapper">
                                            <img src="{{asset('assets/img/profile.jpg')}}" alt="Foto Pengembang"
                                                class="rounded-circle border border-5 border-primary shadow-sm profile-img">
                                        </div>
                                    </div>

                                    <div class="col-md-8 p-4 p-lg-5">
                                        <div class="mb-4">
                                            <span
                                                class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 fw-medium">Identitas
                                                Pengembang</span>
                                            <h2 class="fw-bold mb-1 text-dark">Rudio Winaldo</h2>
                                            <p class="text-muted fw-medium mb-0">Mahasiswa Sistem Informasi — Politeknik
                                                Caltex Riau</p>
                                        </div>

                                        <div class="row g-3 mb-4">
                                            <div class="col-sm-6">
                                                <div
                                                    class="d-flex align-items-center p-2 rounded-3 bg-light-subtle border border-light">
                                                    <i class="fas fa-id-card text-primary me-3 fs-5"></i>
                                                    <div>
                                                        <small class="text-muted d-block"
                                                            style="font-size: 0.7rem; text-uppercase; letter-spacing: 0.5px;">NIM</small>
                                                        <span class="fw-bold text-dark">2457301128</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div
                                                    class="d-flex align-items-center p-2 rounded-3 bg-light-subtle border border-light">
                                                    <i class="fas fa-calendar-alt text-primary me-3 fs-5"></i>
                                                    <div>
                                                        <small class="text-muted d-block"
                                                            style="font-size: 0.7rem; text-uppercase; letter-spacing: 0.5px;">Generasi</small>
                                                        <span class="fw-bold text-dark">G24</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div
                                                    class="d-flex align-items-center p-2 rounded-3 bg-light-subtle border border-light">
                                                    <i class="fas fa-envelope text-primary me-3 fs-5"></i>
                                                    <div>
                                                        <small class="text-muted d-block"
                                                            style="font-size: 0.7rem; text-uppercase; letter-spacing: 0.5px;">Email
                                                            Mahasiswa</small>
                                                        <span class="fw-bold text-dark">rudio24si@mahasiswa.pcr.ac.id</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="mb-4 opacity-10">

                                        <div class="d-flex w-100 gap-2 mt-4">
                                            <a href="https://wa.me/6285265488368" class="btn-social si-whatsapp"
                                                title="WhatsApp" target="_blank">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>

                                            <a href="https://www.linkedin.com/in/rudio-winaldo-80105139b/"
                                                class="btn-social si-linkedin" title="LinkedIn" target="_blank">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>

                                            <a href="https://github.com/rudio24si" class="btn-social si-github"
                                                title="GitHub" target="_blank">
                                                <i class="fab fa-github"></i>
                                            </a>

                                            <a href="https://www.instagram.com/rudio.wnl?igsh=cG81eXdnZmU5bHJ4"
                                                class="btn-social si-instagram" title="Instagram" target="_blank">
                                                <i class="fab fa-instagram"></i>
                                            </a>

                                            <a href="https://www.youtube.com/@KIDYOO999" class="btn-social si-youtube"
                                                title="YouTube" target="_blank">
                                                <i class="fab fa-youtube"></i>
                                            </a>

                                            <a href="http://googleusercontent.com/spotify.com/4"
                                                class="btn-social si-spotify" title="Spotify" target="_blank">
                                                <i class="fab fa-spotify"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Card & Image Styling */
        .profile-img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .developer-card:hover .profile-img {
            transform: scale(1.05) rotate(2deg);
        }

        /* Info Box Styling */
        .bg-light-subtle {
            background-color: #fcfcfd;
        }

        .ls-1 {
            letter-spacing: 1px;
        }

        /* Social Buttons (Lebih kecil & clean) */
        .btn-social {
            flex: 1;
            /* Membuat tombol melebar mengisi ruang kosong secara merata */
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            /* Bentuk kotak dengan sudut halus (modern) */
            background-color: #f8f9fa;
            color: #555;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid #eee;
        }

        /* Efek Hover tetap sama, namun lebih terlihat karena tombol lebih lebar */
        .btn-social:hover {
            transform: translateY(-5px);
            color: white !important;
            border-color: transparent;
        }

        .si-whatsapp:hover {
            background-color: #25D366;
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
        }

        .si-linkedin:hover {
            background-color: #0077b5;
            box-shadow: 0 5px 15px rgba(0, 119, 181, 0.3);
        }

        .si-github:hover {
            background-color: #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .si-instagram:hover {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
        }

        .si-youtube:hover {
            background-color: #ff0000;
            box-shadow: 0 5px 15px rgba(255, 0, 0, 0.3);
        }

        .si-spotify:hover {
            background-color: #1DB954;
            box-shadow: 0 5px 15px rgba(29, 185, 84, 0.3);
        }

        /* Responsivitas agar tidak terlalu tipis di HP */
        @media (max-width: 576px) {
            .btn-social {
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>
@endsection