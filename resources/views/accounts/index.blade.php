  @extends('layouts.main')

  @section('content')
      @php
          $name = 'Список користувачів:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
          <a href="{{ route('users.create') }}">Створити користувача</a>
<div>
    <ul>
        @foreach($users as $user)
            <div class="user">
                <h2><a href="{{route('users.show', ['user' => $user->id])}}">{{$user->name}}</a></h2>
                <p>Email: {{ $user->email }}</p>
                <p>Зареєстрований: {{ $user->created_at }}</p>
                <p>Роль: {{ $user->role->name }}</p>
{{--                @if($user->image)--}}
{{--                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="200">--}}
{{--                @else--}}
{{--                    <p>No photo available</p>--}}
{{--                @endif--}}
                <a href="{{ route('users.edit',['user' => $user->id])}}">Редагувати користувача</a>
                <br><br><br>
{{--                <form id="delete-form-{{ $user->id }}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('delete')--}}
{{--                    <a href="{{ route('users.destroy', ['user' => $user->id]) }}" onclick="document.getElementById('delete-form-{{ $user->id }}').submit(); return false;">Видалити</a>--}}
{{--                </form>--}}
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

