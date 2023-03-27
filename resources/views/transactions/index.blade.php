  @extends('layouts.main')

  @section('content')
      <a href="{{route('main')}}">Повернутися на головну сторінку</a>
      <br>
          Загальний баланс по всім Вашим рахункам = {{ $sum_balance }} (нажаль не враховуючи валюту)
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
                @if($transaction->user->name)
                <p>Користувач: {{ $transaction->user->name }}</p>
                @else
                <p>Користувач: {{ $transaction->user->email }}</p>
                @endif
                <p>Рахунок: {{ $transaction->account->name }}</p>
                <p>Сума: {{ $transaction->amount }}</p>
                <p>Тип транзакції: {{ $transaction->type_transaction }}</p>
                @if($transaction->type_transaction == 2)
                    <p>Категорія: {{ $transaction->category->name }}</p>
                @endif
                <p>Дата та час транзакції: {{ $transaction->created_at }}</p>

                <a href="{{ route('transactions.edit',['transaction' => $transaction->id])}}">Редагувати транзакцію</a>
                <hr>
            </div>
        @endforeach
    </ul>
</div>
  @endsection

