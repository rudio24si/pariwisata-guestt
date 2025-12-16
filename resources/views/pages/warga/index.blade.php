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

                    <div class="mt-4" data-aos="fade-up">
                        <form method="GET" action="{{ route('warga.index') }}">
                            <div class="row justify-content-center g-2">
                                <div class="col-md-2">
                                    <select name="jenis_kelamin" class="form-select border-primary shadow-none"
                                        onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control border-primary shadow-none"
                                            value="{{ request('search') }}" placeholder="Search">

                                        {{-- Tombol Clear (Hanya muncul jika ada search/filter) --}}
                                        @if(request('search') || request('jenis_kelamin'))
                                            <a href="{{ route('warga.index') }}" class="btn btn-outline-danger"
                                                title="Clear Search">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        @endif

                                        <button type="submit" class="input-group-text btn btn-primary">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="section-content" data-aos="fade-up">
                    <destination-slider class="destination-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <!-- ISI DATA WARGA DI BAAWAHH INII -->
                                @foreach($warga as $w)
                                    <div class="swiper-slide">
                                        <a href="{{route('warga.show', $w->warga_id)}}" class="destination-slide no-underline"
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
                    </destination-slider>
                    <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                        <div class="pagination-wrapper">
                            {{ $warga->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection