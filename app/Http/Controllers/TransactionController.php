<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::query()->orderBy('id', 'desc')->get();
        return view('transactions.index',[
            "transactions" => $transactions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        $accounts = Account::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $types_transactions = ['дохід' , 'витрати'];
        return view('transactions.create',[
            "categories" => $categories,
            "accounts" => $accounts,
            "users" => $users,
            'types_transactions' => $types_transactions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'my_datetime' => 'required',
            'amount' => 'required',
            'type_transaction' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = $request->post('user_id');
        $transaction->account_id = $request->post('account_id');
        $transaction->amount = $request->post('amount');
        $transaction->type_transaction = $request->post('type_transaction');
        $transaction->category_id = $request->post('category_id');
        $transaction->created_at =  $request->post('my_datetime');

        $transaction->save();

        return redirect(route('transactions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::query()->with('user')
            ->where('id',$id)->first();
        return view('transactions.show',[
            'transaction' => $transaction,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::pluck('name', 'id');
        $accounts = Account::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $types_transactions = ['дохід' , 'витрати'];
        $transaction = Transaction::query()->with('user')->with('category')->where('id',$id)->first();
        if(!$transaction){
            throw new \Exception('User not found');
        }
        return view('transactions.edit', [
            'transaction' => $transaction,
            "categories" => $categories,
            "accounts" => $accounts,
            "users" => $users,
            'types_transactions' => $types_transactions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'account_id' => 'required',
            'my_datetime' => 'required',
            'amount' => 'required',
            'type_transaction' => 'required',
        ]);

        $transaction = Transaction::query()->where('id',$id)->first();
        $transaction->user_id = $request->post('user_id');
        $transaction->account_id = $request->post('account_id');
        $transaction->amount = $request->post('amount');
        $transaction->type_transaction = $request->post('type_transaction');
        $transaction->category_id = $request->post('category_id');
        $transaction->created_at =  $request->post('my_datetime');

        $transaction->save();

        return redirect( route('transactions.show', ['transaction' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::query()->where('id',$id)->delete();
        return redirect( route('transactions.index'));
    }
}
