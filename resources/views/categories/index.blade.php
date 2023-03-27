  @extends('layouts.main')

  @section('content')
      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
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
                @if($user->role_id == 1)
                    <a href="{{ route('categories.edit',['category' => $category->id])}}">Редагувати категорію</a>
                @endif
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

