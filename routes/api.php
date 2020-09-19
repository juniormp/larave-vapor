<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PrizeController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('artist',  [ArtistController::class, 'createOrUpdate']);

Route::post('prize',  [PrizeController::class, 'createOrUpdate']);
Route::delete('prize/{id}',  [PrizeController::class, 'delete']);
Route::patch('prize/{id}/publish',  [PrizeController::class, 'publish']);
Route::get('artist/{id}/prizes',  [PrizeController::class, 'listPrizesByArtist']);
