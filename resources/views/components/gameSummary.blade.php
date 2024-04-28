@props(['tournGame','leagueGame'])

@php
use App\Models\User;
use App\Models\Tournaments;
use App\Models\Leagues;

if($tournGame != null){
    $user1=User::where('name',$tournGame['firstUserName'])->get();
    $user1=$user1[0];

    $user2=User::where('name',$tournGame['secondUserName'])->get();
    $user2=$user2[0];

    $oldDate =  $tournGame['date'] . " " . $tournGame['startTime'];
    $timestamp = strtotime($oldDate);
    $newDate=date('F d,Y H:i a', $timestamp);
}

if($leagueGame !=null){
    $user1=User::where('name',$leagueGame['firstUserName'])->get();
    $user1=$user1[0];

    $user2=User::where('name',$leagueGame['secondUserName'])->get();
    $user2=$user2[0];

    $oldDate =  $leagueGame['date'] . " " . $leagueGame['startTime'];
    $timestamp = strtotime($oldDate);
    $newDate=date('F d,Y H:i a', $timestamp);
}
@endphp


<style>
    .game{
        width: 100%;
        height: 200px;
        background-color: var(--background-color);
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
    .game ul li:first-child{
        display: flex;
        gap: 5px;
    }
    .game ul li:first-child a{
        display: flex;
        gap: 3px;
    }
</style>

<div class="game">
@if($tournGame != null)
    <div class="gameInfo">

        
        <div class="firstUser">
            <a href="../user/{{$user1['id']}}">
                <img src="<?php echo asset('storage/UserProfilePic/' . $user1['image_url']) ?>">
            </a>
            <a href="../user/{{$user1['id']}}" class="playerName">{{$tournGame['firstUserName']}}</a>
        </div>
        <div class="timeAndResult">
            <a href="#" style="text-align: center;">
              <span class="gameDate">  {{$newDate}} </span>
              <span class="scores">{{ $tournGame['firstUserScore'] == Null ? 'VS' : $tournGame['firstUserScore'] . ' : ' . $tournGame['secondUserScore']}}</span>
            </a>

        </div>
        <div class="secondUser">
            <a href="../user/{{$user2['id']}}" class="playerName">{{$tournGame['secondUserName']}}</a>
            <a href="../user/{{$user2['id']}}">
                <img src="<?php echo asset('storage/UserProfilePic/' . $user2['image_url']) ?>">
            </a>
        </div>
    </div>
    <ul>
        <li>
            <strong>Game:</strong> <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" src="<?php echo asset('storage/gamesLogo/' . $tournGame['sportType'] .'.png') ?>" class="attachment-medium size-medium" alt="" loading="lazy"> 
                {{$tournGame['sportType']}}</a>                
        </li>
        <li>
            <strong>Tournament:</strong> <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"> 
                {{ Tournaments::find($tournGame['tournaments_id'])->name   }}</a>                
        </li>
    </ul>
@else


<div class="gameInfo">

        
<div class="firstUser">
    <a href="../user/{{$user1['id']}}">
    <img src="<?php echo asset('storage/UserProfilePic/' . $user1['image_url']) ?>"></a>
    <a href="../user/{{$user1['id']}}" class="playerName">{{$leagueGame['firstUserName']}}</a>
</div>
<div class="timeAndResult">
    <a href="#" style="text-align: center;">
      <span class="gameDate">  {{$newDate}} </span>
      <span class="scores">{{ $leagueGame['firstUserScore'] == Null ? 'VS' : $leagueGame['firstUserScore'] . ' : ' . $leagueGame['secondUserScore']}}</span>
    </a>

</div>
<div class="secondUser">
    <a href="../user/{{$user2['id']}}" class="playerName">{{$leagueGame['secondUserName']}}</a>
    <a href="../user/{{$user2['id']}}">
    <img src="<?php echo asset('storage/UserProfilePic/' . $user2['image_url']) ?>"></a>
</div>
</div>
<ul>
<li>
    <strong>Game</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" src="<?php echo asset('storage/gamesLogo/' . $leagueGame['sportType'] . '.png') ?>" class="attachment-medium size-medium" alt="" loading="lazy"> 
        {{$leagueGame['sportType']}}</a>                
</li>
<li>
    <strong>League</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"> 
        {{ Leagues::find($leagueGame['leagues_id'])->name   }}</a>                
</li>
</ul>


@endif
</div>


