@extends('layouts.main')

@section('content')
    <h1>Валюта № {{$currency->id}}</h1>
    <div>
        Назва: <b>{{$currency->name}}</b>
        <br>
        Символ: <b>{{$currency->symbol}}</b>
        <hr>
    </div>
    <br>
    <a href="{{route('currencies.index')}}">Повернутися у список валют</a>
    @if($user->role_id == 1)
        <form id="delete-form-show" method="post">
            @csrf
            @method('delete')
            <a href="{{ route('currencies.destroy', ['currency' => $currency->id]) }}" onclick="document.getElementById('delete-form-show').submit(); return false;">Видалити</a>
        </form>
    @endif
@endsection

