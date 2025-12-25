@extends('layouts.guest.app')

@section('content')
  <main>
    <div class="container-fluid p-0">
      <div class="row g-0 vh-100">
        <div class="col-lg-7 d-none d-lg-block relative">
          <div class="h-100 w-100"
            style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
            <div class="d-flex flex-column h-100 justify-content-center px-5 text-white">
              <div data-aos="fade-right">
                <h1 class="display-3 fw-bold mb-3">Jelajahi Keindahan <br> Nusantara.</h1>
                <p class="fs-4 mb-4 opacity-75">Temukan homestay impian dan nikmati pengalaman menginap yang autentik
                  bersama masyarakat lokal.</p>
                <div class="d-flex gap-4 mt-2">
                  <div class="text-center">
                    <h3 class="fw-bold mb-0">500+</h3>
                    <small class="opacity-75">Destinasi</small>
                  </div>
                  <div class="vr"></div>
                  <div class="text-center">
                    <h3 class="fw-bold mb-0">1.2k+</h3>
                    <small class="opacity-75">Homestay</small>
                  </div>
                  <div class="vr"></div>
                  <div class="text-center">
                    <h3 class="fw-bold mb-0">4.9/5</h3>
                    <small class="opacity-75">Rating</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5 d-flex align-items-center justify-content-center bg-white px-4">
          <div class="login-card w-100" style="max-width: 450px;" data-aos="fade-left">
            <div class="mb-5">
              <a href="/" class="text-decoration-none text-muted small fw-bold">
                <i class="fas fa-arrow-left me-2"></i> KEMBALI KE BERANDA
              </a>
            </div>

            <div class="heading text-36 mb-2">Selamat Datang!</div>
            <p class="text-muted mb-4 text-16">
              Belum punya akun? <a href="{{route('register')}}" class="text-sky no-underline fw-bold">Daftar sekarang</a>
            </p>

            <form action="{{ route('login.post') }}" method="post" class="login-form">
              @csrf

              {{-- Alert Section --}}
              @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" style="background:#e6ffed; color:#085f2a">
                  <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
              @endif

              @if($errors->any() && !$errors->has('name') && !$errors->has('password'))
                <div class="alert alert-danger border-0 shadow-sm mb-4" style="background:#ffecec; color:#8a1f11">
                  <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
                </div>
              @endif

              {{-- Input Fields --}}
              <div class="mb-4">
                <label for="email" class="form-label fw-bold text-14">Email pengguna</label>
                <div class="input-group-custom">
                  <i class="fas fa-user icon"></i>
                  <input type="email" id="email" name="email" class="custom-input" placeholder="Masukkan email"
                    value="{{ old('email') }}">
                </div>
                @if($errors->has('email'))
                  <div class="text text-14 mt-1 text-danger">Email wajib diisi</div>
                @endif
              </div>

              <div class="mb-4">
                <label for="password" class="form-label fw-bold text-14">Kata Sandi</label>
                <div class="input-group-custom">
                  <i class="fas fa-lock icon"></i>
                  <input type="password" id="password" name="password" class="custom-input" placeholder="••••••••">
                </div>
                @if($errors->has('password'))
                  <div class="text text-14 mt-1 text-danger">Kata sandi wajib diisi</div>
                @endif
              </div>

              <button type="submit" class="button button--primary w-100 py-3 shadow-sm rounded-3">
                <i class="fas fa-sign-in-alt me-2"></i> Masuk Sekarang
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <style>
    /* Hilangkan margin/padding bawaan container-fluid */
    .container-fluid.p-0 {
      overflow: hidden;
    }

    /* Styling Input Group Custom */
    .input-group-custom {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-group-custom .icon {
      position: absolute;
      left: 15px;
      color: #adb5bd;
      transition: color 0.3s;
    }

    .custom-input {
      width: 100%;
      padding: 12px 12px 12px 45px;
      border: 2px solid #f1f3f5;
      border-radius: 10px;
      font-size: 15px;
      outline: none;
      transition: all 0.3s ease;
    }

    .custom-input:focus {
      border-color: #3498db;
      /* Sesuaikan dengan warna primer pariwisata Anda */
      box-shadow: 0 0 10px rgba(52, 152, 219, 0.1);
    }

    .custom-input:focus+.icon {
      color: #3498db;
    }

    /* Efek tombol */
    .button--primary {
      background-color: #3498db;
      border: none;
      color: white;
      font-weight: 600;
      transition: transform 0.2s, background-color 0.2s;
    }

    .button--primary:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
    }

    /* Penyesuaian layout split */
    .vh-100 {
      min-height: 100vh;
    }

    .vr {
      width: 1px;
      background-color: rgba(255, 255, 255, 0.3);
    }
  </style>
@endsection