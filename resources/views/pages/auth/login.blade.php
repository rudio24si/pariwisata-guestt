@extends('layouts.guest.app')

@section('content')
  <!-- Main -->
  <main>
    <div class="login-page mt-100 vh-100">
      <div class="container">
        <div class="booking-login custom-shadow radius12" data-aos="fade-up">
          <div class="heading text-36">Masuk di sini.</div>
          <div class="text text-16">
            Belum punya akun? <a href="{{route('register')}}" class="text text-16 no-underline text-sky">Daftar
              sekarang</a>
          </div>

          <form action="{{ route('login.post') }}" method="post" class="login-form">
            @csrf

            {{-- Pesan sukses / error global --}}
            @if(session('success'))
              <div class="alert alert-success"
                style="margin-bottom:12px;padding:10px;border-radius:6px;background:#e6ffed;color:#085f2a">
                {{ session('success') }}
              </div>
            @endif

            @if($errors->any() && !$errors->has('name') && !$errors->has('password'))
              <div class="alert alert-danger"
                style="margin-bottom:12px;padding:10px;border-radius:6px;background:#ffecec;color:#8a1f11">
                {{ $errors->first() }}
              </div>
            @endif

            <div class="field">
              <label for="name" class="visually-hidden">Nama Pengguna</label>
              <input type="text" id="name" name="name" placeholder="Nama Pengguna / Username" value="{{ old('name') }}">
              @if($errors->has('name'))
                <div class="text text-14" style="color:#b00020;margin-top:6px">
                  {{ $errors->has('name') ? 'Nama pengguna wajib diisi' : '' }}</div>
              @endif
            </div>

            <div class="field">
              <label for="password" class="visually-hidden">Kata Sandi</label>
              <input type="password" id="password" name="password" placeholder="Kata Sandi">
              @if($errors->has('password'))
                <div class="text text-14" style="color:#b00020;margin-top:6px">
                  {{ $errors->has('password') ? 'Kata sandi wajib diisi' : '' }}</div>
              @endif
            </div>

            <div class="forget-password-wrap">
              <label for="remember_me" class="checkbox-label">
                <input type="checkbox" id="remember_me" name="remember">
                <span class="custom-checkbox"></span>
                <span class="text text-16">Ingat saya?</span>
              </label>
              <a href="reset-password.html" class="forget-pass-button no-underline text text-16 text-sky">Lupa Kata
                Sandi?</a>
            </div>

            <button type="submit" class="button button--primary">Masuk</button>
          </form>
        </div>
      </div>
    </div>
  </main>
@endsection