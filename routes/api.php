<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::apiResource('/clients', ClientController::class)->only(['index', 'store','show']);
});

Route::prefix('v1')->group(function () {
    Route::post('articles', [ArticleController::class, 'store']);  
    Route::get('articles/{id}', [ArticleController::class, 'show']); 
    Route::get('articles', [ArticleController::class, 'showAll']);  
    Route::put('articles/{id}', [ArticleController::class, 'update']);  
    Route::delete('articles/{id}', [ArticleController::class, 'destroy']);  
    Route::put('articles/{id}/restore', [ArticleController::class, 'restore']);  
    Route::post('articles/stock', [ArticleController::class, 'updateStock']);  
});
