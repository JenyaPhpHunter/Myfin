  @extends('layouts.main')

  @section('content')
      @php
          $name = 'Список категорій:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
          <a href="{{ route('categories.create') }}">Створити категорію</a>
<div>
    <ul>
        @foreach($categories as $category)
            <div class="user">
                <h2><a href="{{route('categories.show', ['category' => $category->id])}}">{{$category->name}}</a></h2>

                <a href="{{ route('categories.edit',['category' => $category->id])}}">Редагувати категорію</a>
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

