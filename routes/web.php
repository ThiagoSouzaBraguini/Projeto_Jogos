<?php

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

use App\Http\Controllers\GameController;

Route::get('/', [GameController::class, 'index']);
Route::get('/games/create', [GameController::class, 'create'])->middleware('auth');
Route::get('/games/{id}', [GameController::class, 'show']);
Route::post('games',[GameController::class,'store']);
Route::delete('/games/{id}', [GameController::class,'destroy'])->middleware('auth');
Route::get('/games/edit/{id}',[GameController::class,'edit'])->middleware('auth');
Route::put('/games/update/{id}',[GameController::class,'update'])->middleware('auth');

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/dashboard',[GameController::class,'dashboard'])->middleware('auth');

Route::post('/games/join/{id}',[GameController::class, 'addList'])->middleware('auth');

Route::delete('/games/leave/{id}',[GameController::class, 'leaveGame'])->middleware('auth');


