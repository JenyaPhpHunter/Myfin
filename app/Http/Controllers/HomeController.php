<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function main()
    {
        $tables = [
            'Користувачі' => 'users',
            'Категорії' => 'categories',
            'Ролі' => 'roles',
            'Рахунки' => 'accounts',
            'Валюта' => 'currencies',
            'Транзакції' => 'transactions',
        ];

        return view('main',['tables' => $tables]);
    }
}
