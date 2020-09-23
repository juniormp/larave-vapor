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


Route::post('artists',  [ArtistController::class, 'create']);
Route::put('artists',  [ArtistController::class, 'update']);
Route::get('artists/{id}/metrics',  [ArtistController::class, 'listMetrics']);
Route::get('artists/{id}/prizes',  [PrizeController::class, 'listPrizesByArtist']);

Route::post('prizes',  [PrizeController::class, 'create']);
Route::put('prizes',  [PrizeController::class, 'update']);
Route::delete('prizes/{id}',  [PrizeController::class, 'delete']);
Route::patch('prizes/{id}/publish',  [PrizeController::class, 'publish']);


