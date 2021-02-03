<?php

use App\Http\Controllers\AuthorController;

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

// startseite
Route::get('/', function() {
    return view('start', );
});

Route::get('authors', [AuthorController::class, 'index'])->name('authors');
Route::get('authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

// wenn eine route aufgerufen wird, die nicht definiert wurde
Route::fallback(function() {
    $message = '<h1>Diese Route gibt\'s nicht bei mir!</h1>';
    // compact-Funktion: statt array Variablennamen als String benutzen
    return view('errors.message', compact('message'));
});
