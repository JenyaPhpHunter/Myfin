<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
echo "<pre>";
        print_r();
        echo "</pre>";
die();
        if (Auth::attempt($credentials)) {
            if (Auth::user()->email_verified_at == null) {
                Auth::logout();
                return redirect('/login')->withErrors(['email' => 'Вы еще не подтвердили свою электронную почту.']);
            }

            return redirect()->intended('/');
        }

        return redirect('/login')->withErrors(['email' => 'Неправильный адрес электронной почты или пароль.']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
