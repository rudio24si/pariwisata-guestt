@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="popular-destination mt-100">
            <div class="container vh-100">
                <div class="section-headings headings-width text-center">
                    <h2 class="heading text-50" data-aos="fade-up">Daftar User</h2>

                    <div class="mt-3" data-aos="fade-up">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
                    </div>

                    <div class="row justify-content-center mt-3" data-aos="fade-up">
                        <div class="col-md-5 col-lg-4">
                            <form action="{{ route('user.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control shadow-none border-primary"
                                        id="exampleInputIconRight" value="{{ request('search') }}"
                                        placeholder="Cari Nama atau Email..." aria-label="Search">
                                    <button type="submit" class="input-group-text btn btn-primary" id="basic-addon2">
                                        <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" width="20">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                            @if(request('search'))
                                <div class="mt-2">
                                    <a href="{{ route('user.index') }}" class="text-muted small text-decoration-none">
                                        <i class="bi bi-arrow-clockwise"></i> Reset Pencarian
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="section-content mt-5" data-aos="fade-up">
                    <destination-slider class="destination-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @forelse($users as $user)
                                    <div class="swiper-slide">
                                        <a href="{{route('user.show', $user->id)}}" class="destination-slide no-underline"
                                            aria-label="user profile">
                                            <div class="image-shape image-pill">
                                                <img src="{{ asset('assets/img/destination/sm-1.jpg') }}" width="336"
                                                    height="474" loading="lazy" alt="User Image">
                                            </div>
                                            <div class="title heading text-20">{{ $user->name }}</div>
                                            <div class="number text text-16">{{ $user->email }}</div>
                                        </a>

                                        <div class="action-buttons mt-3 d-flex gap-2 justify-content-center">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Hapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <p class="text-muted italic">User tidak ditemukan.</p>
                                        <a href="{{ route('user.index') }}" class="btn btn-link">Lihat semua user</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Navigasi Swiper --}}
                        <div class="swiper-nav-inner">
                        </div>
                    </destination-slider>
                    <div class="d-flex justify-content-center mt-5">
                        <div class="d-flex flex-column align-items-center">
                            <div>
                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection