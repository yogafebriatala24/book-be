<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.category.index');
});

Route::get('/categories', [CategoryController::class, "index"]);
Route::post('/categories', [CategoryController::class, "store"]);
Route::delete('/categories/{id}', [CategoryController::class, "destroy"]);
Route::get('/categories/{id}/edit', [CategoryController::class, "edit"]) -> name('edit');
Route::put('/categories/{id}', [CategoryController::class, "update"]) -> name('update');
Route::get('/books', [BookController::class, "index"]);
Route::post('/books', [BookController::class, "store"]);
Route::delete('/books/{title}', [BookController::class, "destroy"]);
Route::get('/books/{id}', [BookController::class, "edit"]) -> name('edit');
Route::put('/books/{id}', [BookController::class, "update"]) -> name('update');