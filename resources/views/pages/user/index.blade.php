@extends('layouts.guest.app')

@section('content')
    <main>
        <div class="popular-destination mt-100">
            <div class="container vh-100">
                <div class="section-headings headings-width text-center">
                    <h2 class="heading text-50" data-aos="fade-up">Daftar User</h2>
                    {{-- Sesuaikan route create jika ada --}}
                    <a href="{{ route('user.create') }}" class="btn btn-primary mt-3" data-aos="fade-up">Tambah User</a>
                </div>

                <div class="section-content" data-aos="fade-up">
                    <destination-slider class="destination-slider">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach($users as $user)
                                    <div class="swiper-slide">
                                        {{-- Sesuaikan route show jika ada, contoh: route('users.show', $user->id) --}}
                                        <a href="{{route('user.show',$user->id)}}" class="destination-slide no-underline" aria-label="user profile">
                                            <div class="image-shape image-pill">
                                                <img src="{{ asset('assets/img/destination/sm-1.jpg') }}" width="336"
                                                    height="474" loading="lazy" alt="User Image">
                                            </div>
                                            <div class="title heading text-20">{{ $user->name }}</div>
                                            <div class="number text text-16">{{ $user->email }}</div>
                                        </a>

                                        {{-- TOMBOL AKSI --}}
                                        <div class="action-buttons mt-3 d-flex gap-2 justify-content-center">
                                            <a href="{{ route('user.edit',$user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('user.destroy',$user->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Hapus user ini?')">
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
                                        <polyline points="160 208 80 128 160 48" fill="none" stroke="currentColor"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="16" />
                                    </svg>
                                </div>
                            </div>
                            <div class="swiper-button-next">
                                <div class="svg-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
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