<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="/icon/fiblo.png" type="image/x-icon">

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="/css/app.css">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

    {{-- Bootstrap icons --}}
    <link rel="stylesheet" href="/font/bootstrap-icons.css">

    <title>{{ $title ?? env('APP_NAME') }}</title>
</head>

<body class="antialiased">
    <x-navbar></x-navbar>
    <x-notif></x-notif>

    <div class="container main-container mt-2 mb-5" style="padding-top: 100px">
        {{ $slot }}
    </div>

    <script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script src="/js/image-previewer.js"></script>
</body>

</html>