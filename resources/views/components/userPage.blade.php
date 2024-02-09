
@props(["user","opt"])

<style>

    .mainContainer{
        min-height: 90vh;
        max-width: 100vw;
        padding: 50px 180px;
        display: flex;
        gap: 20px;
    }
    .centerContainer{
        width: 30%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        background-color: #191919;
        padding: 20px 45px;
        height: fit-content;
    }
    .sideContainer{
        width: 70%;
        height: fit-content;
        padding: 0px 0px 20px 23px;

    }
    .logoAndName{
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        font-weight: bold;
    }

    .logoAndName img{
        width: 200px;
        border-radius: 112px;
    }
    .name{
        margin-top: 10px;
        font-size: 25px;
    }
    .name span{
        font-size: 17px;
        margin-left: 4px;
        color: #ffffff33;
    }
    .bio p:last-child{
        color: #ffffff33;
        font-size: 17px;
        margin-top: 5px;
    }
    .winning{
        color: #ffffff33;
    }
    .records p:nth-child(2)
    ,.records p:nth-child(3)
    ,.records p:nth-child(4){
        color: white;
        margin-left: 10px;
        margin-bottom: 3px;
    }


   
    .wrapper .listContainer{
        gap: 20px;
        left: 5px;
    }
    .recordsContent{
        width: 100%;
        margin-top: 20px;
        min-height: 50px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .wrapper .selected{
        background-color: #1f1f1f !important;
    }
    .wrapper button.siteLink{
        background-color: #191919;
        padding: 15px;
    }
    .wrapper .tournSum{
        width: 100%;
        background-color: #191919;
        height: 200px;
        display: flex;
        gap: 20px;
        color: white;
    }
    .wrapper .tournSum img{
        width: 250px;
        height: 100%;
    }
    .wrapper .tournInfo{
        width: calc(100% - 270px);
    }
    .wrapper .tournName{
        font-weight: bold;
        font-size: 25px;
        margin-top: 10px;
        margin-bottom: 25px;
    }
    .wrapper .tournInfo p:nth-child(2)
    ,.wrapper .tournInfo p:nth-child(3)
    ,.wrapper .tournInfo p:nth-child(4){
        margin-top: 25px;
    }
    .noWinning{
        width: 100%;
        background-color: #191919;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 27px;
        font-weight: bold;
    }
</style>
@php
use App\Models\Tournaments;
use App\Models\Leagues;
use App\Models\Games;
if(!isset($_SESSION["userPageOpt"])){
    if($opt == "tourn"){
        $_SESSION["userPageOpt"]="tourn";
    }else if($opt== "league"){
        $_SESSION["userPageOpt"]="league";
    }else{
        $_SESSION["userPageOpt"]="game";
    }
}

    $winningTourns=Tournaments::where("winner_id",$user["id"])->get();
    $winningLeagues=Leagues::where("winner_id",$user["id"])->get();
    $winningGames=Games::where("winner_id",$user["id"])->get();

@endphp
<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
            <div class="centerContainer">
      
                <div class="logoAndName">
                    <img src="<?php echo asset("storage/UserProfilePic/" .$user['image_url'] )?>" alt="">
                    <div class="name">{{ucfirst($user["name"])}}<span>#{{$user["id"]}}</span></div>
                </div>

                <hr style="width: 100%;">

                <div class="bio">
                    <p style="color: white;font-weight: bold;font-size: 20px;" >Biography:</p>
                    <p>{{$user["bio"]}}</p>
                </div>

                <hr style="width: 100%;">

                <div class="records" style="width: 100%;">
                    <p style="color: white;font-weight: bold;font-size: 20px;margin-bottom: 5px;" >Titles:</p>
                    <p>Winning Tournaments : <span class="winning" >{{count($winningTourns)}}</span></p>
                    <p>Winning Leagues : <span class="winning" >{{count($winningLeagues)}}</span></p>
                    <p>Winning Games : <span class="winning" >{{count($winningGames)}}</span></p>

                    <!-- <p><span class="winning">Winning Tournaments :</span> {{$winningTourns}}</p>
                    <p><span class="winning">Winning Leagues :</span> {{$winningLeagues}}</p> -->
                </div>

            </div>
            

            <div class="sideContainer">
                <div class="wrapper" style="width: 100%;height:100%">
                    
                    <div class=" text-end d-none d-md-block listContainer" x-data="{ open: false,tournOpen: false,leagOpen: false,gameOpen: false }" x-on:click.away="open = false" >                   
                        <div class="tourns">
                            <a href="../../user/{{$user['id']}}" @click="tournOpen = !open" @mouseover = "tournOpen = true" >
                                <button class="<?php echo($_SESSION["userPageOpt"] === "tourn" ? "selected siteLink tourn" : "siteLink tourn"); ?>"  >Tournaments</button>
                            </a>
                        </div>
                        <div class="leagues">
                            <a href="../../user/{{$user['id']}}/league" @click="leagOpen = !open" @mouseover = "leagOpen = true" >
                                <button class="<?php echo($_SESSION["userPageOpt"] === "league" ? "selected siteLink league" : "siteLink league"); ?>" >Leagues</button>
                            </a>
                        </div>
                        <div class="games">
                            <a href="../../user/{{$user['id']}}/game" @click="gameOpen = !open" @mouseover = "gameOpen = true" >
                                <button  class="<?php echo($_SESSION["userPageOpt"] === "game" ? "selected siteLink gameNav " :"siteLink gameNav"); ?>">Games</button>
                            </a>
                        </div>      
                    </div>

                    <div class="recordsContent">
                            @if($_SESSION["userPageOpt"] == "tourn")                            
                               @if(count($winningTourns) == 0)
                                    <div class="noWinning">
                                        <p>The User didnt won Any Tournament .</p>
                                    </div>
                               @else
                               @foreach($winningTourns as $key=>$value)
                                <div class="tournSum">
                                    <img src="<?php echo asset("storage/gamesLogo/" . $value['sportType'].".png" )?>" alt="">
                                    <div class="tournInfo">
                                        <p class="tournName">{{$value["name"]}}</p>
                                        <p>Sport Type :<span>{{$value["sportType"]}}</span></p>
                                        <p>Rewards :<span>{{$value["rewards"]}}</span></p>
                                        <p>Type :<span>{{$value["type"]}}</span></p>
                                    </div>
                                
                                </div>
                                @endforeach
                               @endif

                            @endif
                            @if($_SESSION["userPageOpt"] == "league")  
                            @if(count($winningLeagues) == 0)
                                    <div class="noWinning">
                                        <p>The User didnt won any League .</p>
                                    </div>
                               @else                          
                                @foreach($winningLeagues as $key=>$value)
                                <div class="tournSum">
                                    <img src="<?php echo asset("storage/gamesLogo/" . $value['sportType'].".png" )?>" alt="">
                                    <div class="tournInfo">
                                        <p class="tournName">{{$value["name"]}}</p>
                                        <p>Sport Type :<span>{{$value["sportType"]}}</span></p>
                                        <p>Rewards :<span>{{$value["rewards"]}}</span></p>
                                        <p>Type :<span>{{"Ranked"}}</span></p>
                                    </div>
                                
                                </div>
                                @endforeach
                                @endif
                            @endif

                            @if($_SESSION["userPageOpt"] == "game")  
                            @if(count($winningGames) == 0)
                                    <div class="noWinning">
                                        <p>The User didnt won any Game .</p>
                                    </div>
                               @else
                                @foreach($winningGames as $key=>$value)
                                <div class="tournSum">
                                    <img src="<?php echo asset("storage/gamesLogo/" . $value['sportType'].".png" )?>" alt="">
                                    <div class="tournInfo">
                                        <p class="tournName">Against {{$value["firstUserName"] == $user["name"] ? $value["secondUserName"] : $value['firstUserName']}}</p>
                                        <p>Sport Type : <span>{{$value["sportType"]}}</span></p>
                                        <p>Scores : <span>{{$value["firstUserScore"]}}</span> <span>{{" - "}}</span><span>{{$value["secondUserScore"]}}</span> </p>
                                        <p>Type : <span>{{"Ranked"}}</span></p>
                                    </div>
                                
                                </div>
                            @endforeach
                            @endif
                            @endif
                    </div>

                </div>
            </div>
        </div>
    </x-slot>
</x-baselayout>