<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();
        if ($auth_user){
            $accounts = Account::query()->where('user_id',$auth_user->id)->get();
        } else {
            $accounts = Account::query()->orderBy('id', 'desc')->get();
        }
        $currencies = Currency::all();


        return view('accounts.index',[
            "accounts" => $accounts,
            "currencies" => $currencies,
            "user" => $auth_user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth_user = Auth::user();
        $currencies = Currency::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $defaultCurrency = Currency::query()->where('id', $auth_user->default_currency_id)->first();
        $defaultCurrencyId = $defaultCurrency->id;
        $defaultCurrencyName = $defaultCurrency->name;

        return view('accounts.create', [
            "currencies" => $currencies,
            "users" => $users,
            "auth_user" => $auth_user,
            "defaultCurrencyId" => $defaultCurrencyId,
            "defaultCurrencyName" => $defaultCurrencyName,
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
            'name' => 'required|unique:users|max:15',
            'balance' => 'required',
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
        $account = Account::query()->with('currency')->with('user')->where('id',$id)->first();
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
        $auth_user = Auth::user();
        $account = Account::query()->with('user')->where('id',$id)->first();
        if(!$account){
            throw new \Exception('User not found');
        }
        $currencies = Currency::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        return view('accounts.edit', [
            'account' => $account,
            "currencies" => $currencies,
            "users" => $users,
            "auth_user" => $auth_user
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
            'name' => 'required|max:15',
            'balance' => 'required',
            'currency_id' => 'required',
            'user_id' => 'required',
        ]);

        $account = Account::query()->where('id',$id)->first();
        $account->name = $request->post('name');
        $account->balance = $request->post('balance');
        $account->currency_id = $request->post('currency_id');
        $account->user_id = $request->post('user_id');
        $account->updated_at = date("Y-m-d H:i:s");

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
        $transaction = Transaction::query()->where('account_id',$id)->first();
        if ($transaction) {
            return redirect()->route('accounts.index')->with('error', 'Ошибка удаления счета. По этому счету уже осуществлялась транзакция');
        } else {
            Account::query()->where('id', $id)->delete();
            return redirect()->route('accounts.index')->with('success', 'Счет успешно удален!');
        }
    }
}
