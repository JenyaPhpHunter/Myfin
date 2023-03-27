<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function main()
    {
        $user = Auth::user();
//        $user = session()->get('user');
        if($user){
            $user = User::query()->with('role')
                ->where('id',$user->id)->first();
            if($user->role_id == 3){
                $tables = [
                    'Категорії' => 'categories',
                    'Рахунки' => 'accounts',
                    'Валюта' => 'currencies',
                    'Транзакції' => 'transactions',
                ];
            }
            elseif($user->role_id == 2){
                $tables = [
                    'Категорії' => 'categories',
                    'Ролі' => 'roles',
                    'Рахунки' => 'accounts',
                    'Валюта' => 'currencies',
                    'Транзакції' => 'transactions',
                ];
            }
            elseif($user->role_id == 1){
                $tables = [
                    'Користувачі' => 'users',
                    'Категорії' => 'categories',
                    'Ролі' => 'roles',
                    'Рахунки' => 'accounts',
                    'Валюта' => 'currencies',
                    'Транзакції' => 'transactions',
                ];
            } else {
                $tables = ['Категорії' => 'categories'];
            }
        } else {
            $tables = [];
        }

        return view('main',[
            'tables' => $tables,
            "user" => $user,
            "user->role_id" => 4
        ]);
    }
}
