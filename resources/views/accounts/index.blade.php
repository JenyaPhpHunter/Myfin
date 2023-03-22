  @extends('layouts.main')

  @section('content')
      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
      @php
          $name = 'Список рахунків:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
          <a href="{{ route('accounts.create') }}">Створити рахунок</a>
<div>
    <ul>
        @foreach($accounts as $account)
            <div class="account">
                <h2><a href="{{route('accounts.show', ['account' => $account->id])}}">{{$account->name}}</a></h2>
                <p>Баланс рахунку: {{ $account->balance }}</p>
                <p>Валюта: {{ $account->currency->name }}</p>
                <p>Користувач: {{ $account->user->name }}</p>
{{--                @if($user->image)--}}
{{--                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="200">--}}
{{--                @else--}}
{{--                    <p>No photo available</p>--}}
{{--                @endif--}}
                <a href="{{ route('accounts.edit',['account' => $account->id])}}">Редагувати рахунок</a>
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

