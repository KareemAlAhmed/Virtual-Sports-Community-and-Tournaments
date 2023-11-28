<?php

use App\Http\Controllers\AuthController;
use App\Models\Tournaments;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
    $tourn=new Tournaments();
    $foredit=false;
    if(request()->session()->has('response')){
        $tourn=session('response')[0]->original['tournament'];
        $foredit=true;
    }
    
    return view('tournament.createTourn',['info'=>request(),'tourn'=>$tourn,'foredit'=>$foredit]);
});
Route::get('/tournament/mytourns', function () {
    return view('tournament.mytourns',['info'=>request()]);
});
Route::get('/tournament/tops', function () {
    return view('tournament.topTourns',['info'=>request()]);
});
Route::get('/tournament/mytourns', function () {
    $joined=new AuthController();
    $created=Tournaments::where('organizer_id',Auth::user()->id)->get();
    return view('tournament.myTourns',['joined'=>$joined->tournaments(auth()->user()->id),'created'=>$created]);
});
Route::get('/tournament/{id}', function ( $id) {
    $num=(int)$id;

    return view('components.tournamentPage',['tourn'=>Tournaments::find($num)]);
});

Route::get('/games/tops', function () {
    return view('games.topGames',['info'=>request()]);
});
Route::get('/games/mine', function () {
    return view('games.myGames',['info'=>request()]);
});

// Route::post(s'register',[AuthController::class,'register']); // to register a user

