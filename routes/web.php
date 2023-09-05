<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
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

/** !EXCLUDE / JANGAN PAKE MIDDLEWARE csrf */
Route::post('/file/upload', [FileController::class, 'uploadFile'])->withoutMiddleware([VerifyCsrfToken::class]);

Route::get('/cek/response', [ResponseController::class, 'res']);
Route::get('/cek/response-header', [ResponseController::class, 'resHeader']);

Route::prefix('/response/type')->group(function () {
    Route::get('/view', [ResponseController::class, 'resView']);
    Route::get('/json', [ResponseController::class, 'resJson']);
    Route::get('/file', [ResponseController::class, 'resFile']);
    Route::get('/download', [ResponseController::class, 'resDownload']);
});

Route::controller(CookieController::class)->group(function () {
    Route::get('/response/cookie/set', 'createCookie');
    Route::get('/response/cookie/get', 'getCookie');
    Route::get('/response/cookie/clear', 'clearCookie');
});

Route::controller(RedirectController::class)->prefix('/response/redirect')->group(function () {
    Route::get('/from', [RedirectController::class, 'redirectFrom']);
    Route::get('/to', [RedirectController::class, 'redirectTo']);
    Route::get('/name', [RedirectController::class, 'redirectName']);
    Route::get('/name/{name}', [RedirectController::class, 'redirectHello'])->name('hello-response');
    Route::get('/action', [RedirectController::class, 'redirectAction']);
    Route::get('/away', [RedirectController::class, 'redirectAway']);
});

Route::get('/response/middleware/contoh', function () {
    return "Ok";
})->middleware('contoh');
Route::get('/middleware/group', function () {
    return "Ok";
})->middleware('sample');
Route::middleware('exParam')->group(function () {
    Route::get('/middleware/param', function () {
        return "Ok";
    });
    Route::get('/middleware/param/group', function () {
        return "Ok";
    });
});

Route::get('/form', [FormController::class, 'getView']);
Route::post('/form', [FormController::class, 'submitToken']);

Route::get('/session/create', [SessionController::class, 'createSession']);
Route::get('/session/get', [SessionController::class, 'getSession']);

Route::get('/error/sample', function () {
    throw new Error('Error Sample');
});
Route::get('/error/manual', function () {
    report(new Exception('Error Manual'));
    return "Ok";
});
Route::get('/error/validation', function () {
    throw new ValidationException("Error Validation");
});