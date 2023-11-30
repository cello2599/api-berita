<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//make middleware
Route::middleware(['auth:sanctum'])->group(function () {

    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/berita', [App\Http\Controllers\BeritaController::class, 'store']);
    Route::put('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'update']);

});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index']);
Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index']);
Route::get('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'show']);
Route::get('/berita/kategori/{id}', [App\Http\Controllers\BeritaController::class, 'showByKategori']);
