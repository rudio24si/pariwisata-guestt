<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <title>Pariwisata RUDIO</title>
    @include('layouts.guest.css')
</head>

<body class="color-scheme">
    @include('layouts.guest.header')

    @yield('content')

    @include('layouts.guest.footer')
    <a href="https://wa.me/6285265488368?text=Halo%20Rudio,%20saya%20tertarik%20dengan%20informasi%20pariwisata%20dan%20homestay."
        class="floating-whatsapp" target="_blank" rel="noopener noreferrer">
        <div class="whatsapp-icon">
            <i class="fab fa-whatsapp"></i>
        </div>
        <span class="whatsapp-text">Chat Kami</span>
    </a>
    @include('layouts.guest.js')
</body>

</html>