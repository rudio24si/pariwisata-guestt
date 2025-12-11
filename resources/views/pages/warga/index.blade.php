@extends('layouts.guest.app')

@section('content')
    <!-- Main -->
    <main>
        <!-- Popular Destination -->
        <div class="popular-destination mt-100">
            <div class="container vh-100">
                <div class="section-headings headings-width text-center">
                    <h2 class="heading text-50" data-aos="fade-up">Warga</h2>
                    <a href="{{ route('warga.create') }}" class="btn btn-primary mt-3" data-aos="fade-up">Tambah Warga</a>
                </div>
                <div class="section-content" data-aos="fade-up">
                    <destination-slider class="destination-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <!-- ISI DATA WARGA DI BAAWAHH INII -->
                                @foreach($warga as $w)
                                    <div class="swiper-slide">
                                        <a href="{{route('warga.show',$w->warga_id)}}" class="destination-slide no-underline"
                                            aria-label="popular destination">
                                            <div class="image-shape image-pill">
                                                <img src="assets/img/destination/sm-1.jpg" width="336" height="474"
                                                    loading="lazy" alt="Small Image">
                                            </div>
                                            <div class="title heading text-20">{{$w->nama}}</div>
                                            <div class="number text text-16">{{$w->telp}}</div>
                                        </a>

                                        {{-- TOMBOL AKSI ICON ONLY --}}
                                        <div class="action-buttons mt-3 d-flex gap-2 justify-content-center">
                                            <a href="{{ route('warga.edit', $w->warga_id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('warga.destroy', $w->warga_id) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="swiper-nav-inner">
                            <div class="swiper-button-prev">
                                <div class="svg-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <polyline points="160 208 80 128 160 48" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    </svg>
                                </div>
                            </div>
                            <div class="swiper-button-next">
                                <div class="svg-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <rect width="256" height="256" fill="none" />
                                        <polyline points="96 48 176 128 96 208" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </destination-slider>
                </div>
            </div>
        </div>
    </main>
@endsection