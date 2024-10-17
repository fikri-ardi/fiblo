<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('font/bootstrap-icons.css') }}">
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <link
            href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"
            rel="stylesheet">
        <title>{{ config('app.name') }}</title>
        {{ $style ?? null }}
    </head>
    
    <body class="antialiased">
        <livewire:navbar />
        <x-_notif></x-_notif>
    
        <div class="container main-container mb-5 flex flex-col pt-24 min-h-screen">
            {{ $slot }}
        </div>
    
        <x-_footer></x-_footer>
        {{ $script ?? null }}
    </body>
</html>
