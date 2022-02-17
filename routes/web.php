<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::view('/', 'index');

Route::name('tickets.')->group(function () {
    Route::view('/tickets', 'ticket/index')
        ->middleware('auth')
        ->name('tickets');

    Route::get('/login', function () {
        if (Auth::check()) {
            return redirect((route('tickets')));
        }
        return view('auth/login');
    })
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/registration', function () {
        if (Auth::check()) {
            return redirect((route('tickets')));
        }
        return view('auth/registration');
    })
        ->name('registration');
    Route::post('/registration', [AuthController::class, 'save']);

});
//Route::get('/', [IndexController::class, 'index']);
//Route::get('/create', [IndexController::class, 'create']);
//Route::get('/update', [IndexController::class, 'update']);
//Route::get('/delete', [IndexController::class, 'delete']);

