@extends('layouts.main')

@section('content')
    <h1>Категорія № {{$category->id}}</h1>
    <div>
        Назва: <b>{{$category->name}}</b>
        <br>
        <hr>
    </div>
    <br>
    <a href="{{route('categories.index')}}">Повернутися у список категорій</a>
    @if($user->role_id == 1)
        <form id="delete-form-show" method="post">
            @csrf
            @method('delete')
            <a href="{{ route('categories.destroy', ['category' => $category->id]) }}" onclick="document.getElementById('delete-form-show').submit(); return false;">Видалити</a>
        </form>
    @endif
@endsection

