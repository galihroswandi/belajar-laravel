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


// !ROUTE_PARAMETER
Route::get('/hello/{name}', function ($name) {
    return "Hello my name is $name";
});

Route::get('/hello/{name}/ages/{age}', function ($name, $age) {
    return "Hello my name is $name and my age is $age";
});

// !ROUTE_PARAMETER WITH REGEX
Route::get('/category/{id}', function ($id) {
    return "Category : $id";
})->where('id', '[0-9]+');

// !ROUTE_PARAMETER OPTIONAL
Route::get('/users/{user?}', function ($user = '404') {
    return "User $user";
});

// !ROUTE_PARAMETER CONFLICT
// ===> laravel akan mengambil yang pertama kali didefinisikan dari atas ke bawah
Route::get('/conflict/jhondoe', function () {
    return "User Conflict Jhondoe 123";
});

Route::get('/conflict/{name}', function ($name) {
    return "User Conflict $name";
});