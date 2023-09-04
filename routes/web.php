<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
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
})->name('show.name');

Route::get('/hello/{name}/ages/{age}', function ($name, $age) {
    return "Hello my name is $name and my age is $age";
})->name("show.name.age");

// !ROUTE_PARAMETER WITH REGEX
Route::get('/category/{id}', function ($id) {
    return "Category : $id";
})->where('id', '[0-9]+')->name('category');

// !ROUTE_PARAMETER OPTIONAL
Route::get('/users/{user?}', function ($user = '404') {
    return "User $user";
})->name('users.name');

// !ROUTE_PARAMETER CONFLICT
// ===> laravel akan mengambil yang pertama kali didefinisikan dari atas ke bawah
Route::get('/conflict/jhondoe', function () {
    return "User Conflict Jhondoe 123";
});

Route::get('/conflict/{name}', function ($name) {
    return "User Conflict $name";
});

// !ROUTE_NAMED
Route::get('/nama/{nama}', function ($nama) {
    $link = route('show.name', ['name' => $nama]);
    return "Link to see : $link";
});

Route::get('/kategori/{id}', function ($id) {
    return redirect()->route('category', ["id" => $id]);
});


Route::get('/controller/hello', [HelloController::class, 'hello']);

Route::get('/controller/hello/request', [HelloController::class, 'helloRequest']);
Route::get('/controller/hello/{name}', [HelloController::class, 'helloName']);

Route::get('/controller/input', [InputController::class, 'hello']);
Route::post('/controller/input', [InputController::class, 'hello']);

Route::post('/controller/nestedInput', [InputController::class, 'nestedInput']);
Route::post('/controller/getAllInput', [InputController::class, 'getAllInput']);

Route::post('/controller/getAllInputWhereName', [InputController::class, 'getAllInputWhereName']);
Route::get('/controller/getQueryParam', [InputController::class, 'getQueryParam']);

Route::get('/controller/getAllQueryParam', [InputController::class, 'getAllQueryParam']);
Route::post('/controller/inputType', [InputController::class, 'inputType']);

Route::post('/controller/inputOnly', [InputController::class, 'inputOnly']);
Route::post('/controller/inputExcept', [InputController::class, 'inputExcept']);

Route::post('/controller/inputMerge', [InputController::class, "inputMerge"]);
Route::post('/file/upload', [FileController::class, 'uploadFile']);

Route::get('/cek/response', [ResponseController::class, 'res']);
Route::get('/cek/response-header', [ResponseController::class, 'resHeader']);

Route::get('/response/type/view', [ResponseController::class, 'resView']);
Route::get('/response/type/json', [ResponseController::class, 'resJson']);

Route::get('/response/type/file', [ResponseController::class, 'resFile']);
Route::get('/response/type/download', [ResponseController::class, 'resDownload']);

Route::get('/response/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/response/cookie/get', [CookieController::class, 'getCookie']);