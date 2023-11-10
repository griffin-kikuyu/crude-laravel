<?php

use App\Http\Controllers\StudentsController;
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

Route::get('/students', [StudentsController::class, 'index']);
Route::post('/students', [StudentsController::class, 'store']);
Route::get('/students/{id}', [StudentsController::class, 'show']);
Route::get('/students/{id}/edit', [StudentsController::class, 'edit']);
Route::put('/students/{id}/update', [StudentsController::class, 'update']);
Route::delete('/students/{id}/delete', [StudentsController::class, 'destroy']);

