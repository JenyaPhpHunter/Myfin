@extends('layouts.main')

@section('content')
    <h1>Користувач № {{$user->id}}</h1>
    <div>
        Ім'я: <b>{{$user->name}}</b>
        <br>
        E-MAIL: {{$user->email}}
        <br>
        Повноваження: {{$user->role->name}}
        <br>
        <hr>
    </div>
    <div>
        Дата реєстрації {{$user->created_at}}
    </div>
    <hr>
    <a href="{{ route('users.edit',['user' => $user->id])}}">Редагувати користувача</a>
    <br><br><br>
    @if($user->role_id == 1)
        <a href="{{route('users.index')}}">Повернутися до списку користувачів</a>
        <br><br><br>
    @endif
    <form id="delete-form-show" method="post">
        @csrf
        @method('delete')
        <a href="{{ route('users.destroy', ['user' => $user->id]) }}" onclick="document.getElementById('delete-form-show').submit(); return false;">Видалити</a>
    </form>
    <br><br>
    <a href="{{route('main')}}">Повернутися на головну</a>
@endsection

