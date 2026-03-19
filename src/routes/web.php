<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// /products/register と /products/search を {id} より先に定義（ルート競合防止）
Route::get('/products',                   [ProductController::class, 'index']);
Route::get('/products/register',          [ProductController::class, 'create']);
Route::post('/products/register',         [ProductController::class, 'store']);
Route::get('/products/search',            [ProductController::class, 'search']);
Route::get('/products/detail/{id}',       [ProductController::class, 'show']);
Route::get('/products/{id}/update',       [ProductController::class, 'edit']);
Route::patch('/products/{id}/update',     [ProductController::class, 'update']);
Route::delete('/products/{id}/delete',    [ProductController::class, 'destroy']);
