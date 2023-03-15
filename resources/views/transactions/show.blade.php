@extends('layouts.main')

@section('content')
    <h1>Користувач № {{$user->id}}</h1>
    <div>
        Ім'я: <b>{{$user->name}}</b>
        <br>
        E-MAIL: {{$user->email}}
        <br>
        Баланс: {{$user->balance}}
        <br>
        <hr>
    </div>
    <div>
        Дата реєстрації {{$user->created_at}}
    </div>
    <hr>
    <br>
    <a href="{{route('users.index')}}">Повернутися у список користувіачів</a>
    <br><br><br>
    <form id="delete-form-show" method="post">
        @csrf
        @method('delete')
        <a href="{{ route('users.destroy', ['user' => $user->id]) }}" onclick="document.getElementById('delete-form-show').submit(); return false;">Видалити</a>
    </form>
@endsection

