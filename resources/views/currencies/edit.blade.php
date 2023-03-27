@extends('layouts.main')

@section('content')
    <h1>Редагування валюти</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('currencies.update', ['currency' => $currency->id]) }}">
        @csrf
        @method('put')
        <label for="name">Назва</label>
        <br>
        <input id="name" name="name" value="{{$currency->name}}">
        <br><br>

        <label for="symbol">Символ</label>
        <br>
        <input id="symbol" name="symbol" value="{{$currency->symbol}}">
        <br><br>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('currencies.index')}}">Повернутися до списку валют</a>

    </form>
@endsection



