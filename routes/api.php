<?php

use App\Events\Hello;
use App\Http\Controllers\acheiveController;
use App\Http\Controllers\acheivement;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\authData;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\enrollLeagueController;
use App\Http\Controllers\enrollTournController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\getData;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TournamentController;
use App\Models\Comment;
use App\Models\Follower;
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
Route::get('/broadcast',function(){
    broadcast(new Hello());
}); //To let a user get the acheivement
Route::get('user/{userId}/getFollowers',[FollowerController::class,'getUserFollower']); //To let a user get the acheivement
Route::get('user/{userId}/getFollowed',[FollowerController::class,'getUserFollowed']); //To let a user get the acheivement
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
        Route::post('post/{id}/edit/','update'); // to update the info of a post 
        Route::delete('post/{id}/delete','delete'); // to delete a post 
        Route::get('post/{id}/user','user'); // to get the user of a post 
        Route::put('post/{id}/user/{userId}/like','postLike'); // to get the user of a post 
        Route::post('post/{id}/sharedBy/{userId}','share'); // to get the user of a post  
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


    
    Route::post('user/{userId}/commentOn/post/{postId}',[CommentController::class, 'create']);// to enroll a user in a specific tournament 
    Route::delete('delete/comment/{commentID}',[CommentController::class, 'delete']);// to enroll a user in a specific tournament 
    Route::get('get/comment/{commentId}',[CommentController::class, 'show']);// to enroll a user in a specific tournament 
    Route::put('update/comment/{commentId}',[CommentController::class, 'update']);// to enroll a user in a specific tournament 
    
    Route::post('user/{userId}/like/post/{postId}',[LikeController::class, 'create']);// to enroll a user in a specific tournament 
    Route::delete('user/{userId}/unlike/post/{postId}',[LikeController::class, 'delete']);// to enroll a user in a specific tournament 
    
    Route::post('enroll/user/{userId}/tournament/{tournId}',[enrollTournController::class, 'enroll']);// to enroll a user in a specific tournament 
    Route::delete('kick/user/{userId}/tournament/{tournId}',[enrollTournController::class, 'kick']);// to kick a user from a specific tournament
    
    Route::post('enroll/user/{userId}/league/{leagueId}',[enrollLeagueController::class, 'enroll']);// to enroll a user in a specific league 
    Route::delete('kick/user/{userId}/league/{leagueId}',[enrollLeagueController::class, 'kick']);// to kick a user from a specific league
    Route::post('league/{id}/simulate',[LeagueController::class,'simulate_games']);// to show a tournament

    Route::controller(GameController::class)->group(function () {
        Route::post('game/{tournOrLeagueId}/create','create'); // to create a game  (should competetionType be Tournament or League)
        Route::get('game/{id}/edit','edit'); // // to get the info of a game to be updated
        Route::put('game/{id}/edit/{tournOrLeagueId}','update'); // to update the info of a game 
        Route::delete('game/{id}/delete','delete'); // to delete a game
        Route::put('game/{gameId}/member/{userId}/winner','setWinner'); // to save that a user won a game
        Route::get('game/{gameId}/winner','getWinner'); // to get the user that won a specific game
    });
    Route::delete('user/{id}/delete',[AuthController::class,'delete']); // to get the acheivements of a specific user

    Route::controller(FollowerController::class)->group(function () {
        Route::post('user/{followerId}/follow/{followedId}','request'); // to create an acheivement
        Route::delete('user/{followerId}/cancelFollowingOf/{followedId}','cancelFollowing'); // to get the acheivement info for edit
        Route::put('user/{followedId}/accept/requestOf/{followerId}','acceptReq');// to update the info of an acheivement
        Route::put('user/{followedId}/deny/requestOf/{followerId}','denyReq');// to delete an acheivement       
        Route::get('user/{userId}/getFollowingReqguest','getUserFollowingRequests'); //To let a user get the acheivement
        Route::get('user/{followerId}/isFollowing/{followedId}','isFollowing'); //To let a user get the acheivement
        Route::get('user/{followerId}/isFollowRequest/{followedId}','followRequested'); //To let a user get the acheivement
    });
  
   


});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(ChatController::class)->group(function () {
    Route::get("chats/between/{ownerId}/{withUserId}","getChats");
    Route::post('user/{userId}/send/To/{receiverId}','send'); // to create an acheivement
    Route::get('user/{userId}/contacts','getContact'); // to create an acheivement
});
Route::get('post/{postId}/comments',[PostController::class, 'getComments']);// to enroll a user in a specific tournament 

Route::get("search/user/{name:slug}",[AuthController::class,"search"]);

Route::get('{id}/games',[GameController::class,'user_games']); // to show a league
Route::get('game/all',[GameController::class,'all']); // to get all games

Route::post('register',[AuthController::class,'register']); // to register a user
Route::post('login',[AuthController::class,'login']); // to login a user
Route::post('isAdmin/{userId}',[AuthController::class,'isAdmin']); // to register a user
Route::post('isenroll/user/{userId}/league/{leagueId}',[enrollLeagueController::class, 'isenroll']);// to enroll a user in a specific league 
Route::post('isenroll/user/{userId}/tournament/{tournId}',[enrollTournController::class, 'isenroll']);// to enroll a user in a specific league 
Route::get("user/{id}",[AuthController::class,'getUser']);
Route::get('user/{id}/acheivements',[AuthController::class,'acheivements']); // to get the acheivements of a specific user
Route::get('acheivement/{id}/user',[acheiveController::class,'users']); // to get the users that have a specific acheivement
Route::get('acheive/{id}',[acheiveController::class ,'show']); // to show an acheivement

Route::get('post/{id}',[PostController::class,'show']);// to show a post
Route::get('posts',[PostController::class,'all']);// to get all posts
Route::get('user/{id}/posts',[AuthController::class,'posts']); // to get the posts  of a specific user

Route::get('post/{id}/getLikes',[PostController::class,'getLikes']); // to get the user of a post 

Route::get('tournament/{id}',[TournamentController::class,'show']);// to show a tournament
Route::get('tournament/{id}/games',[TournamentController::class,'games']); // to get the games of a tournament
Route::get('tournament/{id}/members',[TournamentController::class,'members']); // to get the members of a tournament
Route::get('tournament/{tournId}/organizer',[TournamentController::class,'organizer']); // to get the organizer of a  specific tournament
Route::get('user/{id}/tournaments',[AuthController::class,'tournaments']);// to get the tournaments that a user participate in.

Route::post('tournament/{id}/simulate',[TournamentController::class,'simulate_games']);// to show a tournament
// Route::post('tournament/{id}/simulateKnockout',[TournamentController::class,'simulate_games']);// to show a tournament


Route::get('league/{id}',[LeagueController::class,'show']); // to show a league
Route::get('league/{id}/games',[LeagueController::class,'games']); // to get the games of a league
Route::get('league/{id}/members',[LeagueController::class,'members']); // to get the members of a league
Route::get('league/{leagueId}/organizer',[LeagueController::class,'organizer']); // to get the organizer of  a specific league
Route::get('user/{id}/leagues',[AuthController::class,'user_leagues']);// to get the leagues that a user participate in.
Route::get('user/{id}/tourns',[AuthController::class,'user_tourns']);// to get the leagues that a user participate in.


Route::get('user/{id}/winningLeagues',[AuthController::class,'winningLeague']); // to get the leagues  that a user won
Route::get('user/{id}/winningTournaments',[AuthController::class,'winningTourn']); // to get the tournaments  that a user won
Route::get('user/{id}/winningGames',[AuthController::class,'winningGames']); // to get the Games  that a user won


Route::get('game/{id}',[GameController::class,'show']); // to show a league


Route::get('user/{id}/leagues/games',[AuthController::class,'leagueGames']); //to get the games of user in leagues
Route::get('user/{id}/tournaments/games',[AuthController::class,'tournGames']); //to get the games of user in tournaments

Route::get('users/all',[AuthController::class,'all_users']); // to get all users
Route::get('tourns/all',[TournamentController::class,'all_tourn']); // to get all tourns
Route::get('leagues/all',[LeagueController::class,'all_leagues']); // to get all leagues

