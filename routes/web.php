<?php

use App\Http\Controllers\UserareaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// регистрация и аутентификация пользователей
//Route::get('/register', 'UserController@showRegistrationForm')->name('register');
//Route::post('/register', 'UserController@register');
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('/login', 'Auth\LoginController@login');
//Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//Route::get('/email/verify', 'Auth\EmailVerificationController@show')->name('verification.notice');
//Route::get('/email/verify/{id}/{hash}', 'Auth\EmailVerificationController@verify')->name('verification.verify');
//Route::post('/email/resend', 'Auth\EmailVerificationController@resend')->name('verification.resend');

// защищенные маршруты, доступные только авторизованным пользователям
//Route::middleware('auth')->group(function () {
//    // маршруты для авторизованных пользователей
//});
//
//// маршруты для гостей
//Route::middleware('guest')->group(function () {
//    // маршруты для гостей
//});

// главная страница
//Route::get('/', function () {
//    return view('main');
//});

Route::get('/', [HomeController::class,'main'])->name('main');

Route::resources([
    'users' => UserController::class,
    'accounts' => AccountController::class,
    'categories' => CategoryController::class,
    'currencies' => CurrencyController::class,
    'roles' => RoleController::class,
    'transactions' => TransactionController::class,
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/userarea', [UserareaController::class,'show'])->middleware(['auth'])->name('userarea');

Route::post('/set-default-currency', [UserareaController::class, 'setDefaultCurrency'])->name('set-default-currency');

require __DIR__.'/auth.php';

