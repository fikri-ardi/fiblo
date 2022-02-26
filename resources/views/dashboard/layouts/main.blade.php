<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? env('APP_NAME') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    {{-- CSS feather icons --}}
    <link rel="stylesheet" href="/css/feathericon.min.css">
</head>

<body>

    @include('dashboard.partials.header')

    <div class="container-fluid">
        <div class="row">
            @include('dashboard.partials.nav')

            @yield('content')

        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="/js/feather.min.js"></script>

    <script src="/js/dashboard.js"></script>
</body>

</html>