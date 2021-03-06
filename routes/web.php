<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//CRUD routes for an admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/posts', \App\Http\Livewire\Posts::class)->name('posts');
        Route::get('/categories', \App\Http\Livewire\Categories::class)->name('categories');
    });
});
