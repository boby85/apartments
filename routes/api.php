<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ApartmentController;

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
Route::get('/apartments', [ApartmentController::class, 'index']);
Route::put('/apartment', [ApartmentController::class, 'store']);
Route::patch('/apartment/{id}', [ApartmentController::class, 'update']);
Route::delete('/apartment/{id}', [ApartmentController::class, 'destroy']);
Route::get('/apartments/search', [ApartmentController::class, 'search']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::put('/category', [CategoryController::class, 'store']);
Route::patch('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

Route::post('/create_user', [AuthController::class, 'createUser']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/apartment/{id}/rate_apartment', [ApartmentController::class, 'rateApartment']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
