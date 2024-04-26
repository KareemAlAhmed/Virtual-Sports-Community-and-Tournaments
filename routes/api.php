<?php

use App\Http\Controllers\acheiveController;
use App\Http\Controllers\acheivement;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\authData;
use App\Http\Controllers\enrollLeagueController;
use App\Http\Controllers\enrollTournController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\getData;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TournamentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Protected route(should user be authenticated)
Route::get('tournament/all',[TournamentController::class,'all_tourn']); // to get the games of a tournament
Route::get('league/all',[LeagueController::class,'all']); // to get the games of a league
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::post('logout',[AuthController::class,'logout']);// to logout a user
    Route::put('userUpdate/{userid}',[AuthController::class,'edit']); // to edit the  user info

    Route::controller(acheiveController::class)->group(function () {
        Route::post('acheive','create'); // to create an acheivement
        Route::get('acheive/{id}/edit','edit'); // to get the acheivement info for edit
        Route::put('acheive/{id}/edit','update');// to update the info of an acheivement
        Route::delete('acheive/{id}/delete','delete');// to delete an acheivement
        Route::post('acheivement/{id}/user/{id2}','getAcheiv'); //To let a user get the acheivement
    });

    Route::controller(PostController::class)->group(function () {
        Route::post('post/user/{id}/','create'); // to create a post
        Route::get('post/{id}/edit','edit'); // to get the info of a post to be updated
        Route::put('post/{id}/edit/','update'); // to update the info of a post 
        Route::delete('post/{id}/delete','delete'); // to delete a post 
        Route::get('post/{id}/user','user'); // to get the user of a post 
    
    });

    Route::controller(TournamentController::class)->group(function () {
        Route::post('tournament/user/{id}','create'); // to create a tournament
        Route::get('tournament/{id}/edit','edit');// to get the info of a tournamnet to be updated
        Route::put('tournament/{id}/edit','update');// to update the info of a tournament 
        Route::delete('tournament/delete/{id}','delete');// to delete a tournament
        Route::put('tournament/{tournId}/member/{userId}/winner','setWinner'); // to save that a user won a tournament
        Route::get('tournament/{tournId}/winner','getWinner'); // to get the user that won a specific tournament
        Route::post('tournament/{id}/createGames','createGames'); // to create  the games of a tournament
        
    });

    Route::controller(LeagueController::class)->group(function () {
        Route::post('league/user/{id}','create'); // to create a league
        Route::get('league/{id}/edit','edit'); // // to get the info of a league to be updated
        Route::put('league/{id}/edit','update'); // to update the info of a league 
        Route::delete('league/delete/{id}','delete'); // to delete a League
        Route::put('league/{leagueId}/member/{userId}/winner','setWinner'); // to save that a user won a league
        Route::get('league/{leagueId}/winner','getWinner'); // to get the user that won a specific League
        Route::post('league/{id}/createGames','createGames'); // to create the games of a league
        
    });


    Route::post('enroll/user/{userId}/tournament/{tournId}',[enrollTournController::class, 'enroll']);// to enroll a user in a specific tournament 
    Route::delete('kick/user/{userId}/tournament/{tournId}',[enrollTournController::class, 'kick']);// to kick a user from a specific tournament
    
    Route::post('enroll/user/{userId}/league/{leagueId}',[enrollLeagueController::class, 'enroll']);// to enroll a user in a specific league 
    Route::delete('kick/user/{userId}/league/{leagueId}',[enrollLeagueController::class, 'kick']);// to kick a user from a specific league


    Route::controller(GameController::class)->group(function () {
        Route::post('game/{tournOrLeagueId}/create','create'); // to create a game  (should competetionType be Tournament or League)
        Route::get('game/{id}/edit','edit'); // // to get the info of a game to be updated
        Route::put('game/{id}/edit/{tournOrLeagueId}','update'); // to update the info of a game 
        Route::delete('game/{id}/delete','delete'); // to delete a game
        Route::put('game/{gameId}/member/{userId}/winner','setWinner'); // to save that a user won a game
        Route::get('game/{gameId}/winner','getWinner'); // to get the user that won a specific game
    });
    Route::delete('user/{id}/delete',[AuthController::class,'delete']); // to get the acheivements of a specific user
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[AuthController::class,'register']); // to register a user
Route::post('login',[AuthController::class,'login']); // to login a user

Route::get("user/{name:slug}",[AuthController::class,'getUser']);
Route::get('user/{id}/acheivements',[AuthController::class,'acheivements']); // to get the acheivements of a specific user
Route::get('acheivement/{id}/user',[acheiveController::class,'users']); // to get the users that have a specific acheivement
Route::get('acheive/{id}',[acheiveController::class ,'show']); // to show an acheivement

Route::get('post/{id}',[PostController::class,'show']);// to show a post
Route::get('posts',[PostController::class,'all']);// to get all posts
Route::get('user/{id}/posts',[AuthController::class,'posts']); // to get the posts  of a specific user

Route::get('tournament/{id}',[TournamentController::class,'show']);// to show a tournament


Route::get('tournament/{id}/games',[TournamentController::class,'games']); // to get the games of a tournament
Route::get('tournament/{id}/members',[TournamentController::class,'members']); // to get the members of a tournament
Route::get('tournament/{tournId}/organizer',[TournamentController::class,'organizer']); // to get the organizer of a  specific tournament
Route::get('user/{id}/winningTournaments',[AuthController::class,'winningTourn']); // to get the tournaments  that a user won
Route::get('user/{id}/tournaments',[AuthController::class,'tournaments']);// to get the tournaments that a user participate in.


Route::get('league/{id}',[LeagueController::class,'show']); // to show a league


Route::get('league/{id}/games',[LeagueController::class,'games']); // to get the games of a league
Route::get('league/{id}/members',[LeagueController::class,'members']); // to get the members of a league
Route::get('league/{leagueId}/organizer',[LeagueController::class,'organizer']); // to get the organizer of  a specific league
Route::get('user/{id}/winningLeagues',[AuthController::class,'winningLeague']); // to get the league  that a user won
Route::get('user/{id}/leagues',[AuthController::class,'leagues']);// to get the leagues that a user participate in.


Route::get('game/all',[GameController::class,'all']); // to show a league
Route::get('game/{id}',[GameController::class,'show']); // to show a league

Route::get('user/{id}/leagues/games',[AuthController::class,'leagueGames']); //to get the games of user in leagues
Route::get('user/{id}/tournaments/games',[AuthController::class,'tournGames']); //to get the games of user in tournaments


