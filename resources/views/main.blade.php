<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myfin main page</title>
{{--    <style>--}}
{{--        body {--}}
{{--            color: black;--}}
{{--        }--}}
{{--        .is-invalid {--}}
{{--            border-color: red;--}}
{{--        }--}}
{{--    </style>--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
{{--    @stack('styles')--}}
</head>
<body>
<header>

</header>

<main>
    <div class="container">
        <h1>
            @section('header')
                Myfin
            @show
        </h1>
        <div class="content">
            @yield('content')
        </div>
    </div>
    @stack('scripts')
</main>

<footer>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </nav>
    &copy; {{ date('Y') }} MyFin
</footer>
</body>
</html>
