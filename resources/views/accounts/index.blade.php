  @extends('layouts.main')

  @section('content')
      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif

      @if (session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
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
                @if($account->user->name)
                    <p>Користувач: {{ $account->user->name }}</p>
                @else
                    <p>Користувач: {{ $account->user->email }}</p>
                @endif
                    <a href="{{ route('accounts.edit',['account' => $account->id])}}">Редагувати рахунок</a>
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

