<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home',['info'=>request()]);
});
Route::get('/register', function () {
    return view('register',['info'=>request()]);
});
Route::get('/login', function () {
    return view('login',['info'=>request()]);
});

// Route::post(s'register',[AuthController::class,'register']); // to register a user

