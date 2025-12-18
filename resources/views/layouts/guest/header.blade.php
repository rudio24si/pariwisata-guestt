<!-- Header -->
<sticky-header data-sticky-type="always">
    <header class="header-1">
        <div class="container">
            <div class="header-grid">
                <a class="header-logo" href="/" aria-label="Hawaa">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Hawaa Logo" width="212" height="52"
                        class="rounded-circle"> </a>
                <drawer-menu>
                    <nav class="header-nav drawer-menu">
                        <div class="drawer-menu-top">
                            <div class="d-lg-none header-nav-headings">
                                <a class="header-logo" href="/" aria-label="Hawaa">
                                    <img src="{{ asset('assets/img/logo.png') }}" alt="Hawaa Logo" width="336"
                                        height="52" loading="lazy">
                                </a>
                                <drawer-opener class="svg-wrapper menu-close" data-drawer=".drawer-menu">
                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.00386 9.41816C7.61333 9.02763 7.61334 8.39447 8.00386 8.00395C8.39438 7.61342 9.02755 7.61342 9.41807 8.00395L12.0057 10.5916L14.5907 8.00657C14.9813 7.61605 15.6144 7.61605 16.0049 8.00657C16.3955 8.3971 16.3955 9.03026 16.0049 9.42079L13.4199 12.0058L16.0039 14.5897C16.3944 14.9803 16.3944 15.6134 16.0039 16.0039C15.6133 16.3945 14.9802 16.3945 14.5896 16.0039L12.0057 13.42L9.42097 16.0048C9.03045 16.3953 8.39728 16.3953 8.00676 16.0048C7.61624 15.6142 7.61624 14.9811 8.00676 14.5905L10.5915 12.0058L8.00386 9.41816Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM3.00683 12C3.00683 16.9668 7.03321 20.9932 12 20.9932C16.9668 20.9932 20.9932 16.9668 20.9932 12C20.9932 7.03321 16.9668 3.00683 12 3.00683C7.03321 3.00683 3.00683 7.03321 3.00683 12Z"
                                            fill="currentColor" />
                                    </svg>
                                </drawer-opener>
                            </div>
                            <ul class="header-menu list-unstyled">
                                <li class="nav-item">
                                    <a class="menu-link menu-link-main menu-accrodion" href="/">
                                        Home
                                        <div class="svg-wrapper">
                                            <svg viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 1L6 6L1 1" stroke="currentColor" stroke-opacity="0.7"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="menu-absolute header-submenu submenu-color radius4">
                                        <ul class="list-unstyled">
                                            {{-- Menu User & Warga hanya untuk Super Admin dan Mitra --}}
                                            @if(Auth::check() && in_array(Auth::user()->role, ['Super Admin', 'Mitra']))
                                                <li class="nav-item">
                                                    <a class="menu-link" href="{{route('user.index')}}">User</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="menu-link" href="{{route('warga.index')}}">Warga</a>
                                                </li>
                                            @endif

                                            {{-- Menu di bawah ini muncul untuk semua role yang login --}}
                                            <li class="nav-item">
                                                <a class="menu-link"
                                                    href="{{route('destinasi-wisata.index')}}">Destinasi Wisata</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="menu-link" href="{{route('homestay.index')}}">Homestay</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="menu-link" href="{{route('kamar-homestay.index')}}">Kamar
                                                    Homestay</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="menu-link menu-link-main" href="{{route('tentang')}}">
                                        Tentang
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </drawer-menu>
                <div class="header-actions d-flex align-items-center">
                    @if(Auth::check())
                        <div class="user-dropdown">
                            <button class="dropdown-toggle">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                        class="rounded-circle me-2" style="width: 24px; height: 24px; object-fit: cover;">
                                @else
                                    <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                @endif
                                <span>{{ Auth::user()->name }}</span>
                            </button>

                            <div class="dropdown-menu">
                                <a href="{{ route('user.edit', Auth::user()->id) }}"
                                    class="dropdown-item border-bottom mb-2 pb-2">Edit Profile</a>
                                <a href="{{ route('booking-homestay.index', Auth::user()->id) }}"
                                    class="dropdown-item border-bottom mb-2 pb-2">Booking Saya</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('identitas') }}" class="btn-login text-light">Identitas pengembang</a>
                        <a href="{{ route('login') }}" class="btn-login text-light">
                            <svg class="icon-20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Masuk
                        </a>
                    @endif
                    <drawer-opener class="svg-wrapper menu-open d-lg-none" data-drawer=".drawer-menu">
                        <svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="26" cy="26" r="25.5" fill="white" stroke="currentColor" />
                            <path
                                d="M32.5 18.2857C32.5 17.5757 31.9179 17 31.2 17H14.3C13.5821 17 13 17.5757 13 18.2857C13 18.9958 13.5821 19.5714 14.3 19.5714H31.2C31.9179 19.5714 32.5 18.9957 32.5 18.2857ZM14.3 24.7143H37.7C38.4179 24.7143 39 25.29 39 26C39 26.7101 38.4179 27.2857 37.7 27.2857H14.3C13.5821 27.2857 13 26.7101 13 26C13 25.29 13.5821 24.7143 14.3 24.7143ZM14.3 32.4286H26C26.7179 32.4286 27.3 33.0042 27.3 33.7143C27.3 34.4243 26.7179 35 26 35H14.3C13.5821 35 13 34.4243 13 33.7143C13 33.0042 13.5821 32.4286 14.3 32.4286Z"
                                fill="currentColor" />
                        </svg>
                    </drawer-opener>
                </div>
            </div>
        </div>
    </header>
</sticky-header>