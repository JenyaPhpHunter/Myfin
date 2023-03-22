  @extends('layouts.main')

  @section('content')

      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
      @php
          $name = 'Список валют:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
          <a href="{{ route('currencies.create') }}">Створити валюту</a>
<div>
    <ul>
        @foreach($currencies as $currency)
            <div class="currensy">
                <h2><a href="{{route('currencies.show', ['currency' => $currency->id])}}">{{$currency->id .'. '. $currency->name}}</a></h2>
                                <p>Символ: {{ $currency->symbol }}</p>
{{--                @if($user->image)--}}
{{--                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="200">--}}
{{--                @else--}}
{{--                    <p>No photo available</p>--}}
{{--                @endif--}}
                <a href="{{ route('currencies.edit',['currency' => $currency->id])}}">Редагувати валюту</a>
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

