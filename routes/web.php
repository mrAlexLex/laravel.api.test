<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pages\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
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


Route::name('tickets.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])
        ->middleware('auth')
        ->name('tickets');
    Route::get('/{ticket_id}', [IndexController::class, 'detail'])
        ->middleware('auth')
        ->where(['ticket_id' => '[0-9]+'])
        ->name('detail');

    Route::get('/create', function () {
        return view('ticket/create');
    })
        ->middleware('auth')
        ->name('create');
    Route::post('/create', [IndexController::class, 'create']);

    Route::get('/update/{ticket_id}', function ($id) {
        $response = Http::withHeaders([
            'x-api-key' => Auth::user()->auth_token
        ])->get('http://127.0.0.1:8001/api/v1/tickets/' . $id)->json();

        return view('ticket/create', [
            'ticket' => $response['success'] ? $response['data'] : null
        ]);
    })
        ->middleware('auth')
        ->where(['ticket_id' => '[0-9]+'])
        ->name('update');
    Route::post('/update/{ticket_id}', [IndexController::class, 'update']);

    Route::get('/delete/{ticket_id}', [IndexController::class, 'delete'])
        ->middleware('auth')
        ->where(['ticket_id' => '[0-9]+'])
        ->name('delete');

    //Auth
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



