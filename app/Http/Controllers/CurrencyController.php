<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::query()->orderBy('id')->get();
        return view('currencies.index',[
            "currencies" => $currencies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currencies.create');
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
            'name' => 'required|unique:currencies|max:35',
            'symbol' => 'required|unique:currencies|max:35',
        ]);

        $currency = new Currency();
        $currency->name = $request->post('name');
        $currency->symbol = $request->post('symbol');

        $currency->save();

        return redirect(route('currencies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency= Currency::query()->where('id',$id)->first();
        return view('currencies.show',[
            'currency' => $currency,
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
        $currency =Currency::query()->where('id',$id)->first();
        if(!$currency){
            throw new \Exception('Currency not found');
        }
        return view('currencies.edit', ['currency' => $currency]);
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
        // TODO
        $validated = $request->validate([
            'name' => 'required|max:35',
            'symbol' => 'required|max:35',
        ]);

        $currency = Currency::query()->where('id',$id)->first();
        $currency->name = $request->post('name');
        $currency->symbol = $request->post('symbol');

        $currency->save();

        return redirect( route('currencies.show', ['currency' => $id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::query()->where('id',$id)->delete();
        return redirect( route('currencies.index'));
    }
}
