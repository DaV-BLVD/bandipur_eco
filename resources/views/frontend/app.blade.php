<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ env('APP_NAME', 'BandipurEcoHotel') }}</title> --}}
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('frontendimages/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/asap.css') }}">
    {{-- icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite('resources/css/app.css', 'resources/js/app.js') --}}

    @stack('style')

</head>

<body>
    @include('frontend.components.headers')
    <main>@yield('content')</main>
    @include('frontend.components.bookingoverlay')
    <footer>@include('frontend.components.footers')</footer>


    @stack('script')
    {{-- Removed duplicate JavaScript - now handled by asap.js --}}
    <script src='{{ asset('js/asap.js') }}'></script>
</body>

</html>
