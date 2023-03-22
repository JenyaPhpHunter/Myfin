  @extends('layouts.main')

  @section('content')
      @php
          $name = 'Список транзакцій:';
      @endphp
    <h1>{{$name}}</h1>
<br><br>
          <a href="{{ route('transactions.create') }}">Створити транзакцію</a>
<div>
    <ul>
        @foreach($transactions as $transaction)
            <div class="transaction">
                <h2><a href="{{route('transactions.show', ['transaction' => $transaction->id])}}">{{$transaction->id}}</a></h2>
                <p>Користувач: {{ $transaction->user->name }}</p>
                <p>Рахунок: {{ $transaction->account->name }}</p>
                <p>Сума: {{ $transaction->amount }}</p>
                <p>Тип транзакції: {{ $transaction->type_transaction }}</p>
                @if($transaction->type_transaction == 'витрати')
                    <p>Категорія: {{ $transaction->category->name }}</p>
                @endif
                <p>Дата та час транзакції: {{ $transaction->created_at }}</p>
                {{--                @if($user->image)--}}
{{--                    <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" width="200">--}}
{{--                @else--}}
{{--                    <p>No photo available</p>--}}
{{--                @endif--}}
                <a href="{{ route('transactions.edit',['transaction' => $transaction->id])}}">Редагувати транзакцію</a>

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

