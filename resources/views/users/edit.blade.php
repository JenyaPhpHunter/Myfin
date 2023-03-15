@extends('layouts.main')

@section('content')
    <h1>Редагування користувача</h1>

    {{--    @error('title')--}}
    {{--    <div class="alert alert-danger">Title - обязательное поле</div>--}}
    {{--    @enderror--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('users.store') }}">
        @csrf
        <label for="name">Ім'я</label>
        <br>
        <input id="name" name="name" value="{{$user->name}}">
        <br><br>

        <label for="email" @readonly(true)>E-mail</label>
        <br>
        <input id="email" name="email" value="{{$user->email}}">
        <br><br>

        <label for="password">Пароль</label>
        <br>
        <input id="password" name="password" value="{{$user->password}}">
        <br><br>

        <label for="account_id">Рахунок</label>
        <br>
        <input id="account_id" name="account_id" value="{{$user->account_id}}">
        <br><br>

        <label for="role_id">Роль</label>
        <br>
        <input id="role_id" name="role_id" value="{{$user->role_id}}">
        <br><br>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('users.index')}}">Повернутися до списку користувачів</a>

    </form>
@endsection



