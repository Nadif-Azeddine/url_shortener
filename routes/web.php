<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/st'.'{short_url}',[\App\Http\Controllers\UrlController::class, 'redirect'])->name('redirect');

Route::middleware('auth')->group(function () {
    Route::get('/squahr_code_shortener',[\App\Http\Controllers\UrlController::class, 'index'])->name('home');
    Route::post('/squahr_code_shortener/generate',[\App\Http\Controllers\UrlController::class, 'generate'])->name('generate');
    Route::post('/squahr_code_shortener/get_stats',[\App\Http\Controllers\UrlController::class, 'getStats'])->name('get_stats');
    Route::post('/squahr_code_shortener/delete_url',[\App\Http\Controllers\UrlController::class, 'deleteUrl'])->name('delete_url');
    Route::post('/squahr_code_shortener/filter',[\App\Http\Controllers\UrlController::class, 'filter'])->name('filter');

});
