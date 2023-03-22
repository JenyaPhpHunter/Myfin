  @extends('layouts.main')

  @section('content')

      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
      @php
          $name = 'Список ролей:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
          <a href="{{ route('roles.create') }}">Створити роль</a>
<div>
    <ul>
        @foreach($roles as $role)
            <div class="role">
                <h2><a href="{{route('roles.show', ['role' => $role->id])}}">{{$role->id .'. '. $role->name}}</a></h2>

                {{--                <p>Роль: {{ $role->users->name }}</p>--}}
{{--                @if($user->image)--}}
{{--                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="200">--}}
{{--                @else--}}
{{--                    <p>No photo available</p>--}}
{{--                @endif--}}
                <a href="{{ route('roles.edit',['role' => $role->id])}}">Редагувати роль</a>
{{--                <br><br><br>--}}
{{--                <form id="delete-form{{ $role->id }}" method="post">--}}
{{--                    @csrf--}}
{{--                    @method('delete')--}}
{{--                    <a href="{{ route('roles.destroy', ['role' => $role->id]) }}" onclick="document.getElementById('delete-form{{ $role->id }}').submit(); return false;">Видалити</a>--}}
{{--                </form>--}}
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

