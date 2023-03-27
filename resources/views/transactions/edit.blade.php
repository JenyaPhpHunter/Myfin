@extends('layouts.main')

@section('content')
    <h1>Редагування транзакції</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('transactions.update', ['transaction' => $transaction->id]) }}">
        @csrf
        @method('put')
        <label for="user_id">Користувач</label>
        <br>
        <input id="user_id" name="user_id"
               @if($auth_user->name) placeholder="{{$auth_user->name}}"
               @else placeholder="{{$auth_user->email}}"
               @endif
               readonly>
        <br><br>

        <label for="account_id">Рахунок</label>
        <br>
        <select id="account_id" name="account_id">
            @foreach($accounts as $id => $name)
                <option value="{{ $id }}" {{ $transaction->account_id == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <br><br>

        <input type="datetime-local" name="my_datetime" id="my_datetime" value="{{ $transaction->created_at }}">
        <br><br>
        <script>
            var inputField = document.getElementById('my_datetime');
            inputField.addEventListener('change', function() {
                var value = inputField.value;
                if (!value.match(/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/)) {
                    alert('Будь ласка, введіть коректну дату та час у форматі "yyyy-mm-ddThh:mm"!');
                    inputField.value = '';
                }
            });
        </script>

        <label for="amount">Сума</label>
        <br>
        <input id="amount" name="amount" value="{{$transaction->amount}}">
        <br><br>

        <label for="type_transaction">Тип транзакції</label>
        <br>
        <select id="type_transaction" name="type_transaction">
            @foreach($types_transactions as $id => $name)
                <option value="{{ $id }}" {{ $transaction->type_transaction == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <br><br>

        <div id="category-field" @if($transaction->type_transaction == '1') style="display: none; @endif">
            <label for="category_id">Категорія</label>
            <br>
            <select id="category_id" name="category_id">
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ $transaction->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            <br><br>
        </div>

        <script>
            // отримуємо посилання на елемент select за його ідентифікатором
            var typeTransactionSelect = document.getElementById('type_transaction');
            // отримуємо посилання на елемент div, який містить поле вибору категорії
            var categoryField = document.getElementById('category-field');

            // при зміні значення поля вибору типу транзакції
            typeTransactionSelect.addEventListener('change', function() {
                // перевіряємо, який тип транзакції був вибраний
                if (typeTransactionSelect.value === '2') {
                    // якщо тип транзакції - витрата, то відображаємо поле вибору категорії
                    categoryField.style.display = 'block';
                } else {
                    categoryField.style.display = 'none';
                }
            });
        </script>

        <input type="submit" value="Зберегти">
        <span style="display: inline-block; width: 100px;"></span>
        <a href="{{route('transactions.index')}}">Повернутися до списку транзакцій</a>

    </form>
@endsection



