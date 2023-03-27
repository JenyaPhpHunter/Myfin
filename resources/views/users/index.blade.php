  @extends('layouts.main')

  @section('content')
      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
      @php
          $name = 'Список користувачів:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
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
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

