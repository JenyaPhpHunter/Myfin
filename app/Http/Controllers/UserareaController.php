<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserareaController
{
    public function show()
    {
        $auth_user = Auth::user();
        $accounts = Account::query()->where('user_id',$auth_user->id)->orderBy('id')->get();
        $currencies = Currency::all();
        $default_currency = Currency::query()->where('id',$auth_user->default_currency_id)->first();
        return view('userarea',[
            'auth_user' => $auth_user,
            'accounts' => $accounts,
            'currencies' => $currencies,
            'default_currency' => $default_currency,
        ]);
    }

    public function setDefaultCurrency(Request $request)
    {
        $currencyId = $request->input('currency');
        $auth_user = Auth::user();
        $auth_user->default_currency_id = $currencyId;
        $auth_user->save();

        return redirect()->route('userarea');
    }
}
