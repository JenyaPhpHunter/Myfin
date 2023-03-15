<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакти</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
0673291419 Євгеній
</header>
<main>
    <div class="container">
        <h1>
            @section('header')
                Myfin
            @show
        </h1>
    </div>
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
