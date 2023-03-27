@extends('layouts.app')

@section('content')
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" style="font-size: 20px; color: red;">Вийти</button>
    </form>
    <br><br><br>
        @if(!$default_currency)
        <form id="currency-form" method="post" action="{{ route('set-default-currency') }}">
            @csrf
            <label for="currency">Виберіть валюту за замовчуванням:</label>
            <select name="currency" id="currency">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                @endforeach
            </select>
            <button type="submit">Зберегти</button>
        @else
            <form id="currency-form" method="post" action="{{ route('set-default-currency') }}">
            @csrf
            <label for="currency">Виберіть валюту за замовчуванням:</label>
            <select name="currency" id="currency">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ $currency->id == $default_currency->id ? 'selected' : '' }}>{{ $currency->name }}</option>
                @endforeach
            </select>
            <button type="submit">Зберегти</button>
            </form>
        @endif
        <br><br><br>
    @if($auth_user->default_currency_id)
        <a href="{{route('main')}}">Повернутися на головну сторінку</a>
        <br><br>
        Ваша валюта за замовчуванням: {{ $default_currency->name }}
    <br>
    @endif
    <h1>@if($auth_user->name){{$auth_user->name}},@endif це Ваш особистий кабінет</h1>
    <div>
        @if($auth_user->name)
            Ім'я: <b>{{$auth_user->name}}</b>
            <br>
        @endif
        E-MAIL: {{$auth_user->email}}
        <br>
        <hr>
    </div>
    <div>
        Дата реєстрації {{$auth_user->email_verified_at}}
    </div>
    <hr>
    @php
        $totalBalance = 0;
    @endphp
    @if($auth_user->default_currency_id)
    <br><br>
    <a href="{{ route('accounts.create') }}">Створити рахунок</a>
    @endif
    @foreach($accounts as $account)
        <h2>Рахунок: <a href="{{route('accounts.show', ['account' => $account->id])}}">{{$account->name}}</a></h2>
        <p>Сума: {{ $account->balance }}</p>
            <p>Валюта: {{ $account->currency->name }}</p>
        <p>Дата та час створення рахунку: {{ $account->created_at }}</p>
        <p>Дата та час оновлення рахунку: {{ $account->updated_at }}</p>
        @php
            $totalBalance += $account->balance;
        @endphp
        <hr>
    @endforeach
    <hr>
    <p>Загальна сума на рахунку: {{ $totalBalance }}</p>
    <hr>
    @if($auth_user->default_currency_id)
    <a href="{{ route('users.edit',['user' => $auth_user->id])}}">Редагувати користувача</a>
    @endif
@endsection

