<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\enrollLeagueController;
use App\Http\Controllers\enrollTournController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\startCcontroller;
use App\Http\Controllers\startController;
use App\Http\Controllers\TournamentController;
use App\Models\Games;
use App\Models\Leagues;
use App\Models\Posts;
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

// Route::get('/', function () {
//     $check= new  CheckController();
//     $check->checkInfo();


//     return view('home',['post1'=>User::find(1)->posts,'post2'=>User::find(2)->posts,'post3'=>User::find(3)->posts,'myposts'=>auth()->user()?->posts]);

// });
// Route::get('/', function () {

//     return view('welcome');

// });
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

// Route::get('/league/myleagues', function () {
//     $joined=new AuthController();
//     $created=Leagues::where('organizer_id',Auth::user()->id)->get();
//     return view('league.myleagues',['joined'=>$joined->leagues(auth()->user()->id),'created'=>$created]);
// });

// // Route::get('/league/tops', function () {
// //     return view('league.topLeagues',['info'=>request()]);
// // });

// Route::get('/league/create', function () {
//     $league=new Leagues();
//     $foredit=false;

//     if(request()->session()->has('response')){
//         $league=session('response')[0]->original['league'];
//         $foredit=true;
//     }
    
//     return view('league.createLeague',['info'=>request(),'league'=>$league,'foredit'=>$foredit]);
// });
// Route::get('/league/{id}', function ( $id) {
//     $num=(int)$id;
//     $check=new CheckController();
//     $check->checkLeague($id);
//     return view('league.leaguePage',['league'=>Leagues::find($num)]);
// });


// Route::get('/register', function () {
//     return view('register',['info'=>request()]);
// });
// Route::get('/login', function () {
//     return view('login',['info'=>request()]);
// });
// Route::get('/tournament/create', function () {
//     $tourn=new Tournaments();
//     $foredit=false;
//     if(request()->session()->has('response')){
//         $tourn=session('response')[0]->original['tournament'];
//         $foredit=true;
//     }
    
//     return view('tournament.createTourn',['info'=>request(),'tourn'=>$tourn,'foredit'=>$foredit]);
// });
// Route::get('/tournament/tops', function () {
//     return view('tournament.topTourns',['info'=>request()]);
// });

// Route::get('/tournament/mytourns', function () {
//     $joined=new AuthController();
//     $created=Tournaments::where('organizer_id',Auth::user()->id)->get();
//     return view('tournament.myTourns',['joined'=>$joined->tournaments(auth()->user()->id),'created'=>$created]);
// });
// Route::get('/tournament/{id}', function ($id) {
//     $num=(int)$id;
//     $check=new CheckController();
//     $check->checkTourn($num);
    
//     return view('tournament.tournamentPage',['tourn'=>Tournaments::find($num)]);
// });

 
// Route::get('/games/tops', function () {
//     return view('games.topGames',['info'=>request()]);
// });
// Route::get('/games/mine', function () {
//     return view('games.myGames',['info'=>request()]);
// });


// Route::get('/dashboard/users', function(){
//     $_SESSION['selected']='users';
//     return view('dashboards.usersDash',['info'=>request()]);
// });
// Route::get('/dashboard/tourns', function(){
//     $_SESSION['selected']='tourns';
//     return view('dashboards.tournDash',['info'=>request()]);
// });
// Route::get('/dashboard/leagues', function(){
//     $_SESSION['selected']='leagues'; 
//     return view('dashboards.leagueDash',['info'=>request()]);
// });
// Route::get('/dashboard/games', function(){
//     $_SESSION['selected']='games';
//     return view('dashboards.gameDash',['info'=>request()]);
// });



// Route::get('/user/{id}', function($id){

//     return view('components.userPage',['info'=>request(),'user'=>User::find($id),'opt'=>"tourn"]);
// });
// Route::get('/user/{id}/league', function($id){

   
//     return view('components.userPage',['info'=>request(),'user'=>User::find($id),'opt'=>"league"]);
// });
// Route::get('/user/{id}/game', function($id){

   
//     return view('components.userPage',['info'=>request(),'user'=>User::find($id),'opt'=>"game"]);
// });

