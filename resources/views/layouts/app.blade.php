<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Use this meta tag to force the browser to use https when calling requests --}}
    {{--
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Bootstrap icons --}}
    <link rel="stylesheet" href="{{ asset('font/bootstrap-icons.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"
        rel="stylesheet">

    <title>{{ config('app.name') }}{{ $title ? " | $title" : '' }}</title>
    {{ $style }}
    @livewireStyles
</head>

<body class="antialiased">
    <x-navbar></x-navbar>
    <x-_notif></x-_notif>

    <div class="container main-container mb-5 flex flex-col pt-24 min-h-screen">
        {{ $slot }}
    </div>

    <x-_footer></x-_footer>
    {{ $script ?? null }}
    @livewireScripts
</body>

</html>