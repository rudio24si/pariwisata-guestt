@extends('layouts.guest.app')

@section('content')
  <!-- Main -->
  <main>
    <!-- Page Banner -->
    <div class="page-banner overlay">
      <picture class="media media-bg">
        <img src="assets/img/banner/page-banner.jpg" width="1920" height="620" loading="eager" alt="Page Banner Image">
      </picture>
      <div class="page-banner-content">
        <div class="container text-center">
          <h1 class="heading text-60 fw-700" data-aos="fade-up">
            Log In
          </h1>
          <ul class="breadcrumb list-unstyled" data-aos="fade-up" data-aos-delay="100">
            <li>
              <a href="index.html" class="text text-18 no-underline" aria-label="Home Page">
                Home
              </a>
            </li>
            <li>
              <div class="svg-wrapper icon-12">
                <svg viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M7.08929 5.40903C7.24552 5.5653 7.33328 5.77723 7.33328 5.9982C7.33328 6.21917 7.24552 6.43109 7.08929 6.58736L2.37512 11.3015C2.29825 11.3811 2.2063 11.4446 2.10463 11.4883C2.00296 11.532 1.89361 11.5549 1.78296 11.5559C1.67231 11.5569 1.56258 11.5358 1.46016 11.4939C1.35775 11.452 1.2647 11.3901 1.18646 11.3119C1.10822 11.2336 1.04634 11.1406 1.00444 11.0382C0.962537 10.9357 0.941453 10.826 0.942414 10.7154C0.943376 10.6047 0.966364 10.4954 1.01004 10.3937C1.05371 10.292 1.1172 10.2001 1.19679 10.1232L5.32179 5.9982L1.19679 1.8732C1.04499 1.71603 0.960996 1.50553 0.962894 1.28703C0.964793 1.06853 1.05243 0.859522 1.20694 0.705015C1.36145 0.550508 1.57046 0.462868 1.78896 0.460969C2.00745 0.45907 2.21795 0.543066 2.37512 0.694864L7.08929 5.40903Z"
                    fill="currentColor" />
                </svg>
              </div>
            </li>
            <li>
              <a role="link" aria-disabled="true" class="text text-18 no-underline active">
                Log In
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Log In Page -->
    <div class="login-page mt-100">
      <div class="container">
        <div class="booking-login custom-shadow radius12" data-aos="fade-up">
          <div class="heading text-36">Login here.</div>
          <div class="text text-16">
            New here? <a href="{{route('register')}}" class="text text-16 no-underline text-sky">Create an account</a>
          </div>
          <form action="{{ route('login.post') }}" method="post" class="login-form">
            @csrf

            {{-- Global success / error messages --}}
            @if(session('success'))
              <div class="alert alert-success"
                style="margin-bottom:12px;padding:10px;border-radius:6px;background:#e6ffed;color:#085f2a">
                {{ session('success') }}</div>
            @endif

            @if($errors->any() && !$errors->has('name') && !$errors->has('password'))
              <div class="alert alert-danger"
                style="margin-bottom:12px;padding:10px;border-radius:6px;background:#ffecec;color:#8a1f11">
                {{ $errors->first() }}</div>
            @endif

            <div class="field">
              <label for="name" class="visually-hidden">Username</label>
              <input type="text" id="name" name="name" placeholder="Username" value="{{ old('name') }}">
              @if($errors->has('name'))
                <div class="text text-14" style="color:#b00020;margin-top:6px">{{ $errors->first('name') }}</div>
              @endif
            </div>
            <div class="field">
              <label for="password" class="visually-hidden">Password</label>
              <input type="password" id="password" name="password" placeholder="Password">
              @if($errors->has('password'))
                <div class="text text-14" style="color:#b00020;margin-top:6px">{{ $errors->first('password') }}</div>
              @endif
            </div>
            <div class="forget-password-wrap">
              <label for="eiffel-tower" class="checkbox-label">
                <input type="checkbox" id="eiffel-tower" name="Eiffel Tower">
                <span class="custom-checkbox"></span>
                <span class="text text-16">Remember me?</span>
              </label>
              <a href="reset-password.html" class="forget-pass-button no-underline text text-16 text-sky">Forget
                Password?</a>
            </div>
            <button type="submit" class="button button--primary">Login</button>
          </form>
          <div class="divider-or">
            <span></span>
            <div class="text text-16">Or</div>
            <span></span>
          </div>
          <div class="booking-with-accounts">
            <a href="#" class="single-account no-underline hover-on-card hover-on-bg" aria-label="social icon">
              <svg viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M24.833 12.0733C24.833 5.40546 19.4604 0 12.833 0C6.20563 0 0.833008 5.40536 0.833008 12.0733C0.833008 18.0994 5.22126 23.0943 10.958 24V15.5633H7.91113V12.0733H10.958V9.41343C10.958 6.38755 12.7496 4.71615 15.4905 4.71615C16.8035 4.71615 18.1768 4.95195 18.1768 4.95195V7.92313H16.6636C15.1728 7.92313 14.708 8.85381 14.708 9.80864V12.0733H18.0361L17.5041 15.5633H14.708V24C20.4448 23.0943 24.833 18.0995 24.833 12.0733Z"
                  fill="#1877F2" />
              </svg>
            </a>
            <a href="#" class="single-account no-underline hover-on-card hover-on-bg" aria-label="social icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M21.8055 10.0415H21V10H12V14H17.6515C16.827 16.3285 14.6115 18 12 18C8.6865 18 6 15.3135 6 12C6 8.6865 8.6865 6 12 6C13.5295 6 14.921 6.577 15.9805 7.5195L18.809 4.691C17.023 3.0265 14.634 2 12 2C6.4775 2 2 6.4775 2 12C2 17.5225 6.4775 22 12 22C17.5225 22 22 17.5225 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                  fill="#FFC107" />
                <path
                  d="M3.15234 7.3455L6.43784 9.755C7.32684 7.554 9.47984 6 11.9993 6C13.5288 6 14.9203 6.577 15.9798 7.5195L18.8083 4.691C17.0223 3.0265 14.6333 2 11.9993 2C8.15834 2 4.82734 4.1685 3.15234 7.3455Z"
                  fill="#FF3D00" />
                <path
                  d="M11.9999 21.9999C14.5829 21.9999 16.9299 21.0114 18.7044 19.4039L15.6094 16.7849C14.5717 17.574 13.3036 18.0009 11.9999 17.9999C9.39891 17.9999 7.19041 16.3414 6.35841 14.0269L3.09741 16.5394C4.75241 19.7779 8.11341 21.9999 11.9999 21.9999Z"
                  fill="#4CAF50" />
                <path
                  d="M21.8055 10.0415H21V10H12V14H17.6515C17.2571 15.1082 16.5467 16.0766 15.608 16.7855L15.6095 16.7845L18.7045 19.4035C18.4855 19.6025 22 17 22 12C22 11.3295 21.931 10.675 21.8055 10.0415Z"
                  fill="#1976D2" />
              </svg>
            </a>
            <a href="#" class="single-account no-underline hover-on-card hover-on-bg" aria-label="social icon">
              <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M17.6832 12.5555C17.6738 10.957 18.398 9.75234 19.8605 8.86406C19.0426 7.69219 17.8051 7.04766 16.1738 6.92344C14.6293 6.80156 12.9395 7.82344 12.3207 7.82344C11.6668 7.82344 10.1715 6.96563 8.99492 6.96563C6.5668 7.00313 3.98633 8.90156 3.98633 12.7641C3.98633 13.9055 4.19492 15.0844 4.61211 16.2984C5.16992 17.8969 7.18086 21.8133 9.27852 21.75C10.3754 21.7242 11.1512 20.9719 12.5785 20.9719C13.9637 20.9719 14.6809 21.75 15.9043 21.75C18.0207 21.7195 19.8395 18.1594 20.3691 16.5563C17.5309 15.218 17.6832 12.6375 17.6832 12.5555ZM15.2199 5.40703C16.4082 3.99609 16.3004 2.71172 16.2652 2.25C15.2152 2.31094 14.0012 2.96484 13.3098 3.76875C12.548 4.63125 12.1004 5.69766 12.1965 6.9C13.3309 6.98672 14.3668 6.40313 15.2199 5.40703Z"
                  fill="black" />
              </svg>
            </a>
          </div>
          <button type="submit" class="button button--secondary">Continue with email</button>
        </div>
      </div>
    </div>

    <!-- Newsletter -->
    <div class="subscribe-2 mt-100">
      <div class="container">
        <div class="subscribe-wrap radius20" data-aos="fade-up">
          <div class="row align-items-center">
            <div class="col-lg-6 col-12">
              <div class="image">
                <img src="assets/img/subscribe/1.jpg" width="992" height="885" loading="lazy" alt="Subscribe Image">
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="content">
                <div class="subheading text-18" data-aos="fade-up" data-aos-delay="50">Join Our Newsletter</div>
                <h2 class="heading text-30" data-aos="fade-up" data-aos-delay="100">Unlock exclusive deals — prices drop
                  as soon as you subscribe!</h2>
                <form action="#" class="form subscribe-form" data-aos="fade-up" data-aos-delay="150">
                  <div class="field">
                    <label for="SubscribeForm-email" class="visually-hidden">
                      Your E-mail
                    </label>
                    <div class="input-wrap">
                      <input id="SubscribeForm-email" class="text text-16" type="text" placeholder="Your email"
                        name="email" required>
                      <div class="form-button">
                        <button type="submit" class="button button--primary" aria-label="Subscribe">
                          Subscribe
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="text text-16" data-aos="fade-up" data-aos-delay="200">Your email is safe with us — no spam,
                  just useful travel insights.</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection