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

//Route::get('/', function () {
//    return view('welcome');
//});

//untuk Core

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/admin', function () {
    return view('admin');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/home', function () {
    return view('menu');
});



Route::get('/default', function () {
    return view('layout.default');
});

Route::get('/menu', function () {
    return view('layout.menu');
});
/////////////




// // patokan
// Route::get('/Login', [AuthController::class], 'login');
// Route::get('/Register', [AuthController::class], 'register');
// Route::get('/Home', [HomeController::class], 'home');
//Route::methodnya('/link/{parameter}',[namaclass::class],'function');
// Route::get('/umum/{cmd}', [UmumController::class, 'run']);
//Route::post('/umum/{cmd}', [UmumController::class, 'run']);
