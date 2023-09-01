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

Route::get('/testing', function () {
    return "Hello Jhon Doe For Testing...";
});


Route::redirect('/test', '/testing');

Route::fallback(function () {
    return '404 Not Found';
});


Route::view('/hello', 'hello', ['name' => 'Jhon Doe']);

Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Jhon Doe']);
});

// !NESTED
Route::view('/hello-world', 'hello.world', ["name" => "Jhon Doe"]);