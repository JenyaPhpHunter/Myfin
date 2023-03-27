<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myfin main page</title>
    @if (session('verified'))
        <div class="alert alert-success">
            {{ session('verified') }}
        </div>
    @endif
    @if(!$user || $user->role_id == 4)
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">{{ __('Пароль') }}</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ __('Введіть правильний логін і пароль або ваш аккаунт не підтверджено') }}
            </div>
        @endif
        <br>
        <div>
            <a href="{{ route('register') }}">Зареєструватися</a>
        </div>
        <br>
        <div>
            <button type="submit">
                {{ __('Увійти') }}
            </button>
        </div>
        <br>
    </form>

        Публичная часть включает главную страницу с общей информацией о сервисе и ссылки на регистрацию и авторизацию.
        <br><br>
    @else
    <br>
        <a href="{{ route('userarea') }}">Мій кабінет</a>
        <br><br><br>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="font-size: 20px; color: red;">Вийти</button>
        </form>
        <br><br><br>
    @endif
    @if($tables)
    @foreach($tables as $name => $table)
        <a href="{{ route($table.'.index') }}">{{ $name }}</a>
        <br><br>
        <hr>
    @endforeach
    @endif
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
