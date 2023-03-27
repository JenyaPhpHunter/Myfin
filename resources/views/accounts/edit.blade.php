@extends('layouts.main')

@section('content')
    <h1>Редагування рахунку</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('accounts.update', ['account' => $account->id]) }}">
        @csrf
        @method('put')
        <label for="name">Назва</label>
        <br>
        <input id="name" name="name" value={{ $account->name }}>
        <br><br>

        <label for="balance">Баланс рахунку</label>
        <br>
        <input id="balance" name="balance" value={{ $account->balance }}>
        <br><br>

        <label for="currency_id">Валюта</label>
        <br>
        <input id="currency_id" name="currency_id" value="{{ $account->currency->name }}" readonly>
        <br><br>

        <label for="user_id">Користувач</label>
        <br>
        <input id="user_id" name="user_id"
               @if($auth_user->name) placeholder="{{$auth_user->name}}"
               @else placeholder="{{$auth_user->email}}"
               @endif
               readonly>
        <br><br>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('accounts.index')}}">Повернутися в список рахунків</a>

    </form>
@endsection



