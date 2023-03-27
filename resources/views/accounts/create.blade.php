@extends('layouts.main')

@section('content')
    @php
        $user = session('user');
    @endphp
    <h1>Додавання рахунку</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('accounts.store') }}">
        @csrf
        <label for="name">Назва</label>
        <br>
        <input id="name" name="name">
        <br><br>

        <label for="balance">Баланс рахунку</label>
        <br>
        <input id="balance" name="balance">
        <br><br>

        <label for="currency_id">Валюта</label>
        <br>
        <select id="currency_id" name="currency_id">
            @if ($defaultCurrencyId)
                <option value="{{ $defaultCurrencyId }}" selected>{{ $defaultCurrencyName }}</option>
            @endif

            @foreach($currencies as $id => $name)
                @if ($id != $defaultCurrencyId)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endif
            @endforeach
        </select>
        <br><br>

        <label for="user_id">Користувач</label>
        <br>
        <input id="user_id" name="user_id"
               @if($auth_user->name) placeholder="{{$auth_user->name}}"
               @else placeholder="{{$auth_user->email}}"
               @endif
               readonly>
        <input type="hidden" name="user_id" value="{{$auth_user->id}}">
        <br><br>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('accounts.index')}}">Вернуться в список рахунків</a>

    </form>

@endsection
