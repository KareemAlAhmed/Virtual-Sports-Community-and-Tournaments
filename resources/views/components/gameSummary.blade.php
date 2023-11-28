@props(['tournGame'])

@php
use App\Models\User;
use App\Models\Tournaments;
$user1=User::where('name',$tournGame['firstUserName'])->get();
$user1=$user1[0];

$user2=User::where('name',$tournGame['secondUserName'])->get();
$user2=$user2[0];

$oldDate =  $tournGame['date'] . " " . $tournGame['startTime'];
$timestamp = strtotime($oldDate);
$newDate=date('F d,Y H:i a', $timestamp);
@endphp


<style>
    .game{
        width: 100%;
        height: 200px;
        background-color: #121212;
        padding: 20px;
        color: #fff;
    }
    .gameInfo{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .game .gameInfo img{
        width: 100px;
        height: 100px;
    }
    .firstUser,.secondUser{
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .timeAndResult{
        display: flex;
        flex-direction: column;
    }
    .scores{
        display: inline-block;
        width: 70px;
        padding: 9px 12px;
        margin-top: 10px;
        font-family: Montserrat, sans-serif;
        font-size: 0.87rem;
        font-weight: 600;
        line-height: 1.2;
        color: #fff;
        text-align: center;
        text-transform: uppercase;
        white-space: nowrap;
        vertical-align: middle;
        background-color: #454d5e;
        border-radius: 4px;
    }
    .gameDate{
        display: block;
    }
    .playerName{
        color: white;
        font-size: 22px;
        font-weight: 700;
        width: 90px;
    }
    .game ul{
        padding-top: 35px;
        font-size: 0.85em;
        display: flex;
        list-style: none;
        flex-direction: column;
        gap: 5px;
    }
    .game li img{
        width: 1em;
        height: 1em;
    }
</style>

<div class="game">
    <div class="gameInfo">
        <div class="firstUser">
            <img src="<?php echo asset('storage/UserProfilePic/' . $user1['image_url']) ?>">
            <p class="playerName">{{$tournGame['firstUserName']}}</p>
        </div>
        <div class="timeAndResult">
            <a href="#" style="text-align: center;">
              <span class="gameDate">  {{$newDate}} </span>
              <span class="scores">{{ $tournGame['firstUserScore'] == Null ? 'VS' : $tournGame['firstUserScore'] . ' : ' . $tournGame['secondUserScore']}}</span>
            </a>

        </div>
        <div class="secondUser">
            <p class="playerName">{{$tournGame['secondUserName']}}</p>
            <img src="<?php echo asset('storage/UserProfilePic/' . $user2['image_url']) ?>">
        </div>
    </div>
    <ul>
        <li>
            <strong>Game</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" src="https://wp.nkdev.info/squadforce/wp-content/uploads/2019/10/game-dota-2.svg" class="attachment-medium size-medium" alt="" loading="lazy"> 
                {{$tournGame['sportType']}}</a>                
        </li>
        <li>
            <strong>Tournament</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"> 
                {{ Tournaments::find($tournGame['tournaments_id'])->name   }}</a>                
        </li>
    </ul>
</div>


