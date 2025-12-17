@extends('layouts.guest.app')

@section('content')
    <!-- Main -->
    <main>
        <!-- Destinasi Wisata -->
        <div class="featured-tour mt-100">
            <div class="container mb-5">
                <div class="section-headings headings-width text-center">
                    <h2 class="heading text-50" data-aos="fade-up">Destinasi Wisata</h2>
                    <div class="text text-18" data-aos="fade-up" data-aos-delay="50">Informasi lengkap destinasi wisata</div>
                    
                    <div class="mt-4 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <form method="GET" action="{{ route('destinasi-wisata.index') }}">
                            <div class="row justify-content-center g-2">
                                <div class="col-md-3">
                                    <select name="sort" class="form-select border-primary shadow-none" onchange="this.form.submit()">
                                        <option value="">Urutkan Harga</option>
                                        <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                                        <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Harga Tertinggi</option>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control border-primary shadow-none" 
                                            value="{{ request('search') }}" placeholder="Cari nama destinasi...">
                                        
                                        {{-- Tombol Reset --}}
                                        @if(request('search') || request('sort'))
                                            <a href="{{ route('destinasi-wisata.index') }}" class="btn btn-outline-danger">
                                                <i class="bi bi-x-lg"></i>
                                            </a>
                                        @endif

                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <a href="{{ route('destinasi-wisata.create') }}" class="btn btn-primary mt-3" data-aos="fade-up">Tambah Destinasi Wisata</a>
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
                                    @if($d->media->count() > 0)
                                        <img src="{{ asset('images/' . $d->media->first()->file_name) }}" 
                                            class="card-img-top" 
                                            alt="{{ $d->nama }}"
                                            style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('images/default-thumbnail.jpg') }}" 
                                            class="card-img-top" 
                                            alt="No Image available"
                                            style="height: 200px; object-fit: cover;">
                                    @endif
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
                                                                d="M11.4485 4.58548C11.3733 4.35305 11.1672 4.18797 10.9233 4.16599L7.6103 3.86517L6.30026 0.798893C6.20367 0.574174 5.98368 0.428711 5.73925 0.428711C5.49483 0.428711 5.27484 0.574174 5.17825 0.799418L3.86821 3.86517L0.554701 4.16599C0.311242 4.1885 0.105615 4.35305 0.0300369 4.58548C-0.0455407 4.8179 0.0242569 5.07283 0.208428 5.23354L2.71265 7.42975L1.97421 10.6826C1.92018 10.9217 2.01301 11.169 2.21145 11.3124C2.31812 11.3895 2.44292 11.4287 2.56876 11.4287C2.67727 11.4287 2.88149 11.3994 2.88149 11.3416L5.73925 9.63368L8.59597 11.3416C8.80501 11.4674 9.06852 11.4559 9.26653 11.3124C9.46506 11.1685 9.55781 10.9212 9.50377 10.6826L8.76534 7.42975L11.2696 5.23397C11.4537 5.07283 11.524 4.81834 11.4485 4.58548Z"
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
                                                    <button type="submit" class="btn btn-danger btn-sm px-2" title="Hapus"
                                                        onclick="return confirm('Hapus {{ addslashes($d->nama) }}?')">
                                                        <i class="bi bi-trash"></i>
                                                        <span class="visually-hidden">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <hr class="my-3">
                                        <div class="existing-reviews mt-3">
                                            <label class="text-12 fw-bold text-uppercase text-muted d-block mb-2">Ulasan
                                                Pengunjung:</label>
                                            @forelse($d->ulasan as $u)
                                                <div class="review-item border-bottom pb-2 mb-2"
                                                    id="review-container-{{ $u->ulasan_id }}">

                                                    <div id="display-mode-{{ $u->ulasan_id }}">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="stars text-warning" style="font-size: 10px;">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <i class="bi bi-star{{ $i <= $u->rating ? '-fill' : '' }}"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <small class="text-muted" style="font-size: 10px;">
                                                                    {{ \Carbon\Carbon::parse($u->waktu)->diffForHumans() }}
                                                                </small>
                                                                <button type="button" onclick="toggleEdit('{{ $u->ulasan_id }}')"
                                                                    class="btn btn-link p-0 text-warning" style="font-size: 12px;">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </button>
                                                                <form action="{{ route('ulasan-wisata.destroy', $u->ulasan_id) }}"
                                                                    method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-link p-0 text-danger"
                                                                        style="font-size: 12px;">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-13 text-dark mt-1">{{ $u->komentar }}</p>
                                                    </div>

                                                    <div id="edit-mode-{{ $u->ulasan_id }}" style="display: none;">
                                                        <form action="{{ route('ulasan-wisata.update', $u->ulasan_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-2">
                                                                <select name="rating"
                                                                    class="form-select form-select-sm border-warning text-warning"
                                                                    style="width: auto; font-size: 11px;">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        <option value="{{ $i }}" {{ $u->rating == $i ? 'selected' : '' }}>
                                                                            {{ $i }} Bintang</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" name="komentar" class="form-control"
                                                                    value="{{ $u->komentar }}">
                                                                <button type="submit" class="btn btn-success"><i
                                                                        class="bi bi-check-lg"></i></button>
                                                                <button type="button" onclick="toggleEdit('{{ $u->ulasan_id }}')"
                                                                    class="btn btn-secondary"><i class="bi bi-x"></i></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted text-13 fst-italic">Belum ada ulasan untuk tempat ini.</p>
                                            @endforelse
                                        </div>
                                        <hr>
                                        <form action="{{ route('ulasan-wisata.store') }}" method="POST" class="review-form">
                                            @csrf
                                            <input type="hidden" name="destinasi_id" value="{{ $d->destinasi_id }}">
                                            <div class="mb-2">
                                                <div class="star-rating d-flex flex-row-reverse justify-content-end gap-1">
                                                    <input type="radio" name="rating" value="5" id="5-{{$d->destinasi_id}}"
                                                        class="d-none"><label for="5-{{$d->destinasi_id}}"
                                                        class="bi bi-star cursor-pointer text-warning"></label>
                                                    <input type="radio" name="rating" value="4" id="4-{{$d->destinasi_id}}"
                                                        class="d-none"><label for="4-{{$d->destinasi_id}}"
                                                        class="bi bi-star cursor-pointer text-warning"></label>
                                                    <input type="radio" name="rating" value="3" id="3-{{$d->destinasi_id}}"
                                                        class="d-none"><label for="3-{{$d->destinasi_id}}"
                                                        class="bi bi-star cursor-pointer text-warning"></label>
                                                    <input type="radio" name="rating" value="2" id="2-{{$d->destinasi_id}}"
                                                        class="d-none"><label for="2-{{$d->destinasi_id}}"
                                                        class="bi bi-star cursor-pointer text-warning"></label>
                                                    <input type="radio" name="rating" value="1" id="1-{{$d->destinasi_id}}"
                                                        class="d-none"><label for="1-{{$d->destinasi_id}}"
                                                        class="bi bi-star cursor-pointer text-warning"></label>
                                                    <small class="text-muted me-2">Rating:</small>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-sm mb-2">
                                                <input type="text" name="komentar" class="form-control"
                                                    placeholder="Tulis komentar...">
                                                <button class="btn btn-primary" type="submit">Kirim</button>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <small class="text-muted" style="font-size: 11px;">
                                                    <i class="bi bi-clock"></i> {{ date('H:i') }} WIB
                                                </small>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                            <div class="pagination-wrapper">
                                {{ $destinasi->links() }}
                            </div>
                        </div>    
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

    <style>
        /* CSS untuk efek bintang saat dipilih/hover */
        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input:checked~label {
            content: "\f588";
            /* star-fill */
            font-family: "bootstrap-icons";
        }

        .star-rating label::before {
            content: "\f586";
            /* star outline */
            font-family: "bootstrap-icons";
            font-size: 1.1rem;
        }

        .star-rating input:checked~label::before {
            content: "\f588";
            /* star-fill */
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>

    <style>
        .pagination-wrapper nav div:first-child {
        display: none !important; /* Sembunyikan navigasi mobile bawaan */
        }

        .pagination-wrapper nav div:last-child {
            display: flex !important;
            flex-direction: column-reverse !important; /* Balik urutan: Info di bawah, Angka di atas */
            align-items: center !important;
            gap: 15px;
        }

        /* Mempercantik angka pagination */
        .pagination-wrapper .relative.inline-flex.items-center {
            border-radius: 8px !important;
            margin: 0 2px;
        }

        .pagination-wrapper p.text-sm {
            color: #6c757d !important;
            font-size: 14px !important;
        }
    </style>

    <script>
        function toggleEdit(id) {
            const displayDiv = document.getElementById(`display-mode-${id}`);
            const editDiv = document.getElementById(`edit-mode-${id}`);
            
            if (displayDiv.style.display === "none") {
                displayDiv.style.display = "block";
                editDiv.style.display = "none";
            } else {
                displayDiv.style.display = "none";
                editDiv.style.display = "block";
            }
        }
    </script>
@endsection