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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('questions', \App\Http\Controllers\QuestionController::class);
    Route::resource('notes', \App\Http\Controllers\NoteController::class);
    Route::resource('links', \App\Http\Controllers\LinkController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/api/questions', [\App\Http\Controllers\Api\QuestionController::class, 'index']);
    Route::get('/api/links', [\App\Http\Controllers\Api\LinkController::class, 'index']);
});
