<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::query()->with('transaction')->orderBy('id', 'desc')->get();
        return view('accounts.index',[
            "accounts" => $accounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accounts.create');
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
            'name' => 'required|unique:users|max:15',
            'balance' => 'balance',
            'currency_id' => 'required',
            'user_id' => 'required',
        ]);

        $account = new Account();
        $account->name = $request->post('name');
        $account->balance = $request->post('balance');
        $account->currency_id = $request->post('currency_id');
        $account->user_id = $request->post('user_id');
        $account->created_at = date("Y-m-d H:i:s");

        $account->save();

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::query()->with('user')->with('transaction')
            ->where('id',$id)->first();
        return view('accounts.show',[
            'account' => $account,
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
        $account = Account::query()->with('user')->where('id',$id)->first();
        if(!$account){
            throw new \Exception('User not found');
        }
        return view('accounts.edit', ['account' => $account]);
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
            'name' => 'required|unique:users|max:15',
            'balance' => 'balance',
            'currency_id' => 'required',
            'user_id' => 'required',
        ]);

        $account = new Account();
        $account->name = $request->post('name');
        $account->balance = $request->post('balance');
        $account->currency_id = $request->post('currency_id');
        $account->user_id = $request->post('user_id');
        $account->created_at = date("Y-m-d H:i:s");

        $account->save();

        return redirect( route('accounts.show', ['account' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::query()->where('id',$id)->delete();
        return redirect( route('accounts.index'));
    }
}
