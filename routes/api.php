<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\DataController;

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

Route::get('data_region', [DataController::class, 'dataByRegion']);
Route::get('data_cities', [DataController::class, 'dataByCity']);
Route::get('data_countries', [DataController::class, 'dataByCountry']);
Route::get('data_topics', [DataController::class, 'dataByTopics']);
Route::get('data_end_year', [DataController::class, 'dataByEndYear']);
Route::get('data_relevance', [DataController::class, 'dataByRelevance']);
Route::get('data_likelihood', [DataController::class, 'dataByLikelihood']);
Route::get('data_intensity', [DataController::class, 'dataByIntensity']);
