@extends('layouts.main')

@section('content')

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" style="font-size: 20px; color: red;">Вийти</button>
    </form>

    <h1>Редагування користувача</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
        @csrf
        @method('put')
        <label for="name">Ім'я</label>
        <br>
        <input id="name" name="name" value="{{$user->name}}">
        <br><br>

        <label for="email">E-mail</label>
        <br>
        <input id="email" name="email" value="{{$user->email}}" readonly>
        <br><br>

        <label for="password">Пароль</label>
        <br>
        <input id="password" name="password" value="">
        <br><br>

        @if($user->role_id == 1)
        <label for="role">Роль</label>
        <br>
        <select id="role" name="role">
            @foreach($roles as $id => $name)
                <option value="{{ $id }}" {{ $user->role_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        @else
            <label for="role">Роль</label>
            <br>
            <input id="role" name="role" placeholder="{{$user->role->name}}" readonly>
            <input type="hidden" name="role" value="{{$user->role->id}}">
        @endif
        <br><br>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        @if($user->role_id == 1)
        <a href="{{route('users.index')}}">Повернутися до списку користувачів</a>
            <br><br><br>
        @endif
        <a href="{{route('main')}}">Повернутися на головну</a>
    </form>
@endsection



