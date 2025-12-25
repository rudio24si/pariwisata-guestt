@extends('layouts.guest.app')

@section('content')
  <main>
    <div class="container-fluid p-0">
      <div class="row g-0 vh-100">
        <div class="col-lg-7 d-none d-lg-block relative">
          <div class="h-100 w-100"
            style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
            <div class="d-flex flex-column h-100 justify-content-center px-5 text-white">
              <div data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-3">Mulai Petualanganmu <br> Sekarang.</h1>
                <p class="fs-5 mb-5 opacity-75">Dapatkan akses eksklusif ke berbagai homestay pilihan dan <br> kelola
                  reservasi perjalananmu dengan lebih mudah.</p>

                <div class="d-flex flex-column gap-4">
                  <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                      style="width: 50px; height: 50px;">
                      <i class="fas fa-home"></i>
                    </div>
                    <div>
                      <h6 class="mb-0 fw-bold">Pilihan Homestay Terbaik</h6>
                      <small class="opacity-75">Rasakan kenyamanan rumah di destinasi pilihan.</small>
                    </div>
                  </div>
                  <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 d-flex align-items-center justify-content-center"
                      style="width: 50px; height: 50px;">
                      <i class="fas fa-tags"></i>
                    </div>
                    <div>
                      <h6 class="mb-0 fw-bold">Harga Spesial Member</h6>
                      <small class="opacity-75">Dapatkan diskon khusus untuk pendaftaran pertama.</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-5 d-flex align-items-center justify-content-center bg-white px-4 py-5 overflow-auto">
          <div class="login-card w-100" style="max-width: 450px;" data-aos="fade-left">

            <div class="mb-5">
              <a href="/" class="text-decoration-none text-muted small fw-bold">
                <i class="fas fa-arrow-left me-2"></i> KEMBALI KE BERANDA
              </a>
            </div>

            <div class="heading text-36 mb-2">Buat Akun Baru</div>
            <p class="text-muted mb-4 text-16">
              Sudah punya akun? <a href="{{route('login')}}" class="text-sky no-underline fw-bold">Masuk di sini</a>
            </p>

            <form method="POST" action="{{route('register.post')}}" class="login-form">
              @csrf

              <div class="mb-3">
                <label for="name" class="form-label fw-bold text-14 text-dark">Nama Pengguna</label>
                <div class="input-group-custom">
                  <i class="fas fa-user icon"></i>
                  <input type="text" id="name" name="name" class="custom-input @error('name') is-invalid @enderror"
                    placeholder="Username" value="{{ old('name') }}">
                </div>
                @error('name')
                  <div class="text-14 mt-1 text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="email" class="form-label fw-bold text-14 text-dark">Alamat Email</label>
                <div class="input-group-custom">
                  <i class="fas fa-envelope icon"></i>
                  <input type="email" id="email" name="email" class="custom-input @error('email') is-invalid @enderror"
                    placeholder="email@contoh.com" value="{{ old('email') }}">
                </div>
                @error('email')
                  <div class="text-14 mt-1 text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label fw-bold text-14 text-dark">Kata Sandi</label>
                <div class="input-group-custom">
                  <i class="fas fa-lock icon"></i>
                  <input type="password" id="password" name="password"
                    class="custom-input @error('password') is-invalid @enderror" placeholder="••••••••">
                </div>
                @error('password')
                  <div class="text-14 mt-1 text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-bold text-14 text-dark">Konfirmasi Kata
                  Sandi</label>
                <div class="input-group-custom">
                  <i class="fas fa-check-double icon"></i>
                  <input type="password" id="password_confirmation" name="password_confirmation" class="custom-input"
                    placeholder="••••••••">
                </div>
              </div>
              <button type="submit" class="button button--primary w-100 py-3 shadow-sm rounded-3">
                <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <style>
    /* Gunakan gaya yang sama dengan login agar konsisten */
    .input-group-custom {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-group-custom .icon {
      position: absolute;
      left: 15px;
      color: #adb5bd;
    }

    .custom-input {
      width: 100%;
      padding: 12px 12px 12px 45px;
      border: 2px solid #f1f3f5;
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.3s ease;
    }

    .custom-input:focus {
      border-color: #3498db;
      box-shadow: 0 0 10px rgba(52, 152, 219, 0.1);
      outline: none;
    }

    .button--primary {
      background-color: #3498db;
      border: none;
      color: white;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .button--primary:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
    }

    .vh-100 {
      min-height: 100vh;
    }
  </style>
@endsection