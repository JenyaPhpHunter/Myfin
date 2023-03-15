<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $transactions = Transaction::query()->with('transaction')->orderBy('id', 'desc')->get();
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
        return view('transactions.create');
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
            'amount' => 'required',
            'type_transaction' => 'required',
            'date' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = $request->post('user_id');
        $transaction->amount = $request->post('amount');
        $transaction->type_transaction = $request->post('type');
        $transaction->date = date("Y-m-d H:i:s");

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
        $transaction = Transaction::query()->with('users')
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
        $transaction = Role::query()->with('users')->with('categories')->where('id',$id)->first();
        if(!$transaction){
            throw new \Exception('User not found');
        }
        return view('transactions.edit', ['transaction' => $transaction]);
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
            'amount' => 'required',
            'type_transaction' => 'required',
            'date' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = $request->post('user_id');
        $transaction->amount = $request->post('amount');
        $transaction->type_transaction = $request->post('type');
        $transaction->date = date("Y-m-d H:i:s");

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
