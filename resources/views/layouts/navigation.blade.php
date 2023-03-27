<nav>
    <ul>
        <li><a href="/">Главная</a></li>
        <li><a href="/about">О нас</a></li>
        @if(Auth::check())
            <li><a href="/dashboard">Панель управления</a></li>
            <li><a href="{{ route('logout') }}">Выход</a></li>
        @else
            <li><a href="{{ route('login') }}">Вход</a></li>
            <li><a href="{{ route('register') }}">Регистрация</a></li>
        @endif
    </ul>
</nav>
