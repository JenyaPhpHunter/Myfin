@extends('layouts.main')

@section('content')
    @php
    $user = session('user');
    @endphp
    <h1> Рахунок  № {{$account->id}}</h1>
    <div>
        Назва: <b>{{$account->name}}</b>
        <br>
        Баланс рахунку: {{$account->balance}}
        <br>
        Валюта: {{$account->currency->name}}
        <br>
        @if($account->user->name)
            <p>Користувач: {{ $account->user->name }}</p>
        @else
            <p>Користувач: {{ $account->user->email }}</p>
        @endif
        <hr>
    </div>
    <div>
        Дата створення рахунку {{$account->created_at}}
    </div>
    <hr>
    <br>
    <a href="{{route('accounts.index')}}">Повернутися у список рахунків</a>
    <form id="delete-form-show" method="post">
        @csrf
        @method('delete')
        <a href="{{ route('accounts.destroy', ['account' => $account->id]) }}" onclick="document.getElementById('delete-form-show').submit(); return false;">Видалити</a>
    </form>
@endsection

