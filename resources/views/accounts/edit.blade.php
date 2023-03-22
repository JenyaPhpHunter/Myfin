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
        <select id="currency_id" name="currency_id">
            @foreach($currencies as $id => $name)
                <option value="{{ $id }}" {{ $account->currency_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <br><br>

        <label for="user_id">Користувач</label>
        <br>
        <select id="user_id" name="user_id">
            @foreach($users as $id => $name)
                <option value="{{ $id }}" {{ $account->user_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <br><br>
{{--        <label for="curency_id">Валюта</label>--}}
{{--        <br>--}}
{{--        <input id="curency_id" name="curency_id" value={{ $account->curency_id }}>--}}
{{--        <br><br>--}}

{{--        <label for="user_id" @readonly(true)>Користувач</label>--}}
{{--        <br>--}}
{{--        <input id="user_id" name="user_id" value={{ $account->user_id }}>--}}
{{--        <br><br>--}}

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('accounts.index')}}">Вернуться в список задач</a>

    </form>
@endsection



