<?php

use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/tickets')->group(function (){
    Route::get('/', [TicketController::class, 'get']);
    Route::get('/{ticket_id}', [TicketController::class, 'detail'])->where(['ticket_id' => '[0-9+]']);
    Route::post('/', [TicketController::class, 'createTicket']);
    Route::delete('/{ticket_id}', [TicketController::class, 'delete'])->where(['ticket_id' => '[0-9+]']);
    Route::put('/{ticket_id}', [TicketController::class, 'updateTicket'])->where(['ticket_id' => '[0-9+]']);
});


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
