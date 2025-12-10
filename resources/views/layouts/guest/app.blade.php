<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <title>Hawaa Creative Travelling Template</title>
    @include('layouts.guest.css')
</head>

<body class="color-scheme">
    @include('layouts.guest.header')

    @yield('content')

    @include('layouts.guest.footer')

    @include('layouts.guest.js')
</body>

</html>