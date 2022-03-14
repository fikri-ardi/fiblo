<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') ." | Dashboard - ". $title ?? '' }}</title>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    {{-- Bootstrap icons --}}
    <link rel="stylesheet" href="/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    {{-- CSS feather icons --}}
    <link rel="stylesheet" href="/css/feathericon.min.css">

    {{-- Trix Editor --}}
    <link rel="stylesheet" href="/css/trix.css">
    <script src="/js/trix.js"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none
        }
    </style>
</head>

<body class="antialiased">
    <x-_notif></x-_notif>
    <x-dashboard._header></x-dashboard._header>

    <div class="container-fluid">
        <div class="row">
            <x-sidebar></x-sidebar>

            {{ $slot }}

        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="/js/feather.min.js"></script>

    <script src="/js/dashboard.js"></script>

    <script src="/js/image-previewer.js"></script>
</body>

</html>