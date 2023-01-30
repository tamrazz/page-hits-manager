<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PageController;
use App\Http\Controllers\Api\v1\PageHitController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/pages/{id}/hit', [PageHitController::class, 'add']);
Route::post('/pages/addHit', [PageHitController::class, 'add']);

Route::get('/pages/{id}/hits', [PageHitController::class, 'getHits']);
Route::get('/pages/{id}/hitsByParams', [PageHitController::class, 'getHitsByParams']);

Route::get('/pages/hits', [PageHitController::class, 'list']);

Route::apiResource('pages', PageController::class);
