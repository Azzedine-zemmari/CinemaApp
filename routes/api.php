<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Auth\UserProvider;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/updateProfile/{id}',[UserController::class,'update']);
    Route::delete('/deleteProfile/{id}',[UserController::class,'deleteUser']);
    Route::post('/createFilm',[FilmController::class,'addFilm']);
    Route::post('/updateFilm/{id}',[FilmController::class,'updateFilm']);
    Route::delete('/deleteFilm/{id}',[FilmController::class,'deleteFilm']);
    Route::post('/filmtosession',[SessionController::class,'AddFilmTs']);
    Route::post('/reservation/{sessionId}/{seatId}',[ReservationController::class,'reserveAseat']);
    Route::post('/createSeat/{salleId}/{numOfSeats}',[SeatController::class,'createseats']);
});
Route::get('/sessions/{type}',[SessionController::class,'filterByType']);
Route::get('/films',[SessionController::class,'showAll']);
Route::post('/configureSalle',[SalleController::class,'configureSalle']);


Route::middleware('auth:api')->get('/protected-route', function(Request $request) {
    return response()->json(['message' => 'This route is protected']);
});