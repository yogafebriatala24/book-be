<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
    return view('pages.auth.login');
});

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register');
Route::post('/logout', function () {
    auth()->logout();
    request()
        ->session()
        ->invalidate();
    request()
        ->session()
        ->regenerateToken();

    return redirect('/books');
})->name('logout');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('auth');
Route::get('/categories/{id}', [CategoryController::class, 'edit'])->name('editcategories')->middleware('auth');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('update')->middleware('auth');
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store'])->middleware('auth');
Route::delete('/books/{title}', [BookController::class, 'destroy'])->middleware('auth');
Route::get('/books/{id}', [BookController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/books/{id}', [BookController::class, 'update'])->name('update')->middleware('auth');