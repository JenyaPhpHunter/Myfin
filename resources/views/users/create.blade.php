@extends('layouts.main')

@section('content')
    <h1>Додавання користувача</h1>

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
        <input id="name" name="name">
        <br><br>

        <label for="email">E-mail</label>
        <br>
        <input id="email" name="email">
        <br><br>

        <label for="password">Пароль</label>
        <br>
        <input id="password" name="password">
        <br><br>

        <label for="role">Роль</label>
        <br>
        <select id="role" name="role">
            @foreach($roles as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
        <br><br>


        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('users.index')}}">Вернуться в список задач</a>

    </form>

@endsection
