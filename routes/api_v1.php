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

Route::apiResources([
    'pages' => PageController::class,
]);

Route::get('/pages/getHits/{id}', [PageController::class, 'getHits']);
Route::post('/pageHits/{page_id?}', [PageHitController::class, 'add']);
Route::get('/pageHits', [PageHitController::class, 'list']);
Route::get('/pageHitsByPeriod', [PageHitController::class, 'listByPeriod']);
