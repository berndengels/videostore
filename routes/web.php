<?php

//use Illuminate\Support\Facades\Route;
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
// startseite
Route::get('/', function () {
    return vie('start');
});
Auth::routes();

// wenn eine route aufgerufen wird, die nicht definiert wurde
Route::fallback(function () {
    return "<h1>Die Route gibts nicht bei mir!</h1>";
});
