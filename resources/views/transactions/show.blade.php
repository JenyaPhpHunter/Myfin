@extends('layouts.main')

@section('content')
    <h1>Транзакція № {{$transaction->id}}</h1>
    <div>
        Користувач: <b>{{$transaction->user->name}}</b>
        <br>
        Рахунок: {{$transaction->account->name}}
        <br>
        Сума: {{$transaction->amount}}
        <br>
        Тип транзакції: {{$transaction->type_transaction}}
        <br>
        @if($transaction->type_transaction == 'витрати')
            Категорія: {{$transaction->category->name}}
        @endif
        <br>
        Дата та час транзакції: {{$transaction->created_at}}
        <br>
        <hr>
    </div>
    <hr>
    <br>
    <a href="{{route('transactions.index')}}">Повернутися у список транзакцій</a>
    <form id="delete-form-show" method="post">
        @csrf
        @method('delete')
        <a href="{{ route('transactions.destroy', ['transaction' => $transaction->id]) }}" onclick="document.getElementById('delete-form-show').submit(); return false;">Видалити</a>
    </form>
@endsection

