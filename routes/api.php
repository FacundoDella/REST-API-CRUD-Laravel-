<?php

use App\Http\Controllers\api\estudianteController;
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

Route::get('/estudiantes', [estudianteController::class, 'index']);

Route::get('/estudiantes/{id}', [estudianteController::class, 'show']);


Route::post('/estudiantes', [estudianteController::class, 'store']);

Route::put('/estudiantes/{id}', [estudianteController::class, 'update']);

Route::patch('/estudiantes/{id}', [estudianteController::class, 'updatePartial']);

Route::delete('/estudiantes/{id}',  [estudianteController::class, 'destroy']);
