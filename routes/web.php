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
use App\Models\User;

Route::get('/', function () {
    return view('home',['post1'=>User::find(1)->posts,'post2'=>User::find(2)->posts,'post3'=>User::find(3)->posts,'myposts'=>auth()->user()?->posts]);

});
Route::get('/register', function () {
    return view('register',['info'=>request()]);
});
Route::get('/login', function () {
    return view('login',['info'=>request()]);
});
Route::get('/tournament/create', function () {
    return view('tournament.createTourn',['info'=>request()]);
});
Route::get('/tournament/mytourns', function () {
    return view('tournament.mytourns',['info'=>request()]);
});
Route::get('/tournament/tops', function () {
    return view('tournament.topTourns',['info'=>request()]);
});

// Route::post(s'register',[AuthController::class,'register']); // to register a user

