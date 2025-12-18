@extends('layouts.guest.app')

@section('content')
  <!-- Main -->
  <main>
    <div class="login-page vh-100 mt-100 mb-100">
      <div class="container">
        <div class="booking-login custom-shadow radius12" data-aos="fade-up">
          <div class="heading text-36">Buat akun baru</div>
          <div class="text text-16">
            Sudah punya akun? <a href="{{route('login')}}" class="text text-16 no-underline text-sky">Masuk</a>
          </div>

          <form method="POST" action="{{route('register.post')}}" class="login-form">
            @csrf

            <div class="field">
              <label for="name" class="visually-hidden">Nama Pengguna</label>
              <input type="text" id="name" name="name" placeholder="Nama Pengguna" value="{{ old('name') }}">
              @if($errors->has('name'))
                <div class="text text-14" style="color:#b00020; margin-top: 5px;">{{ $errors->first('name') }}</div>
              @endif
            </div>

            <div class="field">
              <label for="email" class="visually-hidden">Alamat Email</label>
              <input type="email" id="email" name="email" placeholder="Alamat Email" value="{{ old('email') }}">
              @if($errors->has('email'))
                <div class="text text-14" style="color:#b00020; margin-top: 5px;">{{ $errors->first('email') }}</div>
              @endif
            </div>

            <div class="field">
              <label for="password" class="visually-hidden">Kata Sandi</label>
              <input type="password" id="password" name="password" placeholder="Kata Sandi">
              @if($errors->has('password'))
                <div class="text text-14" style="color:#b00020; margin-top: 5px;">{{ $errors->first('password') }}</div>
              @endif
            </div>

            <div class="field">
              <label for="password_confirmation" class="visually-hidden">Konfirmasi Kata Sandi</label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Konfirmasi Kata Sandi">
            </div>

            <div class="forget-password-wrap">
              <label for="keep_signed" class="checkbox-label">
                <input type="checkbox" id="keep_signed" name="remember">
                <span class="custom-checkbox"></span>
                <span class="text text-16">Tetap masuk otomatis?</span>
              </label>
            </div>

            <button type="submit" class="button button--primary">Daftar Sekarang</button>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection