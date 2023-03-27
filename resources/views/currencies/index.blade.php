  @extends('layouts.main')

  @section('content')

      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
      @php
          $name = 'Список валют:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
      @if($user->role_id == 1)
          <a href="{{ route('currencies.create') }}">Створити валюту</a>
      @endif
<div>
    <ul>
        @foreach($currencies as $currency)
            <div class="currensy">
                <h2><a href="{{route('currencies.show', ['currency' => $currency->id])}}">{{$currency->id .'. '. $currency->name}}</a></h2>
                                <p>Символ: {{ $currency->symbol }}</p>
                @if($user->role_id == 1)
                    <a href="{{ route('currencies.edit',['currency' => $currency->id])}}">Редагувати валюту</a>
                @endif
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

