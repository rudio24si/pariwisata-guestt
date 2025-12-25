@extends('layouts.guest.app')

@section('content')
    <div class="bg-primary text-white py-5 mb-5"
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="container py-5 text-center">
            <h1 class="display-4 fw-bold">Menghubungkan Anda dengan Alam & Budaya</h1>
            <p class="lead">Temukan pengalaman menginap yang autentik di destinasi wisata terbaik nusantara.</p>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Siapa Kami?</h2>
                <p class="text-muted">
                    Kami adalah platform yang berdedikasi untuk memajukan pariwisata lokal dengan menjembatani wisatawan dan
                    pemilik <strong>homestay</strong> di seluruh penjuru negeri. Kami percaya bahwa perjalanan terbaik bukan
                    hanya tentang destinasi, tapi tentang merasakan kehidupan lokal yang sesungguhnya.
                </p>
                <p class="text-muted">
                    Melalui layanan kami, Anda tidak sekadar memesan tempat tidur; Anda memesan cerita, keramah-tamahan
                    hangat, dan pengalaman yang tidak akan ditemukan di hotel berbintang.
                </p>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=800&q=80"
                    class="img-fluid rounded shadow" alt="Tentang Pariwisata">
            </div>
        </div>

        <hr class="my-5">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
            <p class="text-muted">Keunggulan kami dalam mendampingi perjalanan Anda</p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mb-3">
                        <i class="bi bi-house-heart text-primary fs-1"></i>
                    </div>
                    <h5 class="fw-bold">Homestay Autentik</h5>
                    <p class="text-muted small">Setiap hunian dikurasi untuk memastikan Anda mendapatkan kenyamanan rumah
                        dengan kearifan lokal yang kental.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mb-3">
                        <i class="bi bi-geo-alt text-primary fs-1"></i>
                    </div>
                    <h5 class="fw-bold">Destinasi Tersembunyi</h5>
                    <p class="text-muted small">Kami membawa Anda ke lokasi wisata eksotis yang mungkin belum pernah
                        terjamah oleh peta wisata arus utama.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4">
                    <div class="mb-3">
                        <i class="bi bi-people text-primary fs-1"></i>
                    </div>
                    <h5 class="fw-bold">Dukungan Ekonomi Lokal</h5>
                    <p class="text-muted small">Dengan menginap di homestay, Anda berkontribusi langsung pada perekonomian
                        masyarakat setempat.</p>
                </div>
            </div>
        </div>

        <div class="row mt-5 py-5 bg-light rounded text-center">
            <div class="col-md-6">
                <h3 class="fw-bold text-primary">{{ $totalHomestay }}</h3>
                <p class="text-muted mb-0">Total Homestay Tersedia</p>
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold text-primary">{{ $totalDestinasi }}</h3>
                <p class="text-muted mb-0">Destinasi Wisata Menarik</p>
            </div>
        </div>

        <div class="mt-5 p-5 bg-dark text-white text-center rounded">
            <h2 class="fw-bold">Siap Memulai Petualangan Anda?</h2>
            <p class="mb-4">Temukan kenyamanan menginap yang luar biasa sekarang juga.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5">Jelajahi Sekarang</a>
        </div>
    </div>
@endsection