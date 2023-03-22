@extends('layouts.main')

@section('content')
    <h1>Редагування категорії</h1>

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

    <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">
        @csrf
        @method('put')
        <label for="name">Назва</label>
        <br>
        <input id="name" name="name" value="{{$category->name}}">
        <br><br>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('categories.index')}}">Повернутися до списку категорій</a>

    </form>
@endsection



