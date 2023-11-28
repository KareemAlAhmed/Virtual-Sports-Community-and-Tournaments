
@props(['tourn'])



<style>
    .mainContainer{
        min-height: 80vh;
        background-color: #191919;
        border-radius: 12px;
        margin: 45px 165px;
        padding: 15px 15px;
    }
    /* .mainContainer{
        width: 70%;
        min-height: 80vh;
        margin: 45px 15%;
        background-color: #191919;
        border-radius: 12px;
    } */
    .nk-breadcrumbs{
        font-family: "Montserrat", sans-serif;
        font-style: normal;
        font-weight: 700;
        padding: 0;
        margin: 0;
        color: #fff;
        text-transform: uppercase;
        list-style-type: none;
        margin-bottom: 40px;
    }
    .nk-breadcrumbs > li{
        display: inline-block;
    font-size: 1.07rem;
    }
    .nk-breadcrumbs > li + li {
    margin-left: 6px;
    }
    .nk-breadcrumbs > li:last-of-type {
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 18px;
    gap: 10px;
}
.svg-inline--fa {
    display: var(--fa-display,inline-block);
    height: 1em;
    overflow: visible;
    vertical-align: -0.125em;
}
.nk-breadcrumbs > li:last-of-type::after {
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(-12px);
    margin-bottom: -3px;
}
.tournsInfo{
    width: 100%;
    min-height: 50vh;
    display: flex;
    gap: 25px;
    color: white;
}
.tournsInfo .tournsList{
    
    width: 730px;
    display: flex;
    
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.tournsList ul{
    display: flex;
    
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.sideContainer{
    width: calc(100% - 755px);
    height: fit-content;
    padding: 20px 23px ;
    background-color: #121212;
}
h4{
    margin: -23px;
    margin-bottom: 0;
    padding: 23px;
    font-size: 1.22rem;
    text-transform: uppercase;
    font-family: Montserrat, sans-serif;
    font-style: normal;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    position: relative;
    z-index: 1;
}
h4 span{
    display: inline-block;
    padding-right: 18px;
    background-color: #121212;
}
h4::after{
    content: "";
    position: absolute;
    display: block;
    top: 36px;
    right: 1px;
    left: 30px;
    height: 3px;
    background-color: #fff;
    z-index: -1;
}

.centerContainer{
    width: 730px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.post {
    width: 100%;
    height: 170px;
    padding: 20px;
    font-size: 16px;
    color: white;
    border-radius: 8px;
    background-color: #121212;
}
h2{
    font-weight: 700;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.post ul{
    font-size: 0.85em;
    display: flex;
    list-style: none;
    gap: 13px;
    flex-direction: column;
}
.post img{
    width: 1em;
    height: 1em;
}
.cyberpress-tournament-title a:hover{
    color: black;
}
h2 svg{
    height: 20px;
    fill: white;
    cursor: pointer;
}
h2 svg:hover{
    fill: black;
}
.sbt{
    cursor: pointer;
    border: none;
    box-shadow: 2px 2px 7px #121212;
    background: #121212;
    color: white;
    width: fit-content;
    padding: 3px 10px;
    transition: all 1s;
    height: 35px;
    font-weight: 600;
    font-size: 17px;
}
.sign{
    align-self: flex-end;
    cursor: pointer;
    border: none;
    box-shadow: 2px 2px 7px #121212;
    background: #121212;
    color: white;
    width: 90px;
    transition: all 1s;
    height: 35px;
    font-weight: 600;
    font-size: 17px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.responseContent{
        padding: 10px 10px;
        width: fit-content;
        display: flex;
        align-items: center;
        border-radius: 10px;
    }
    .responseMessage{
        position: sticky;
        bottom: 0;
        left: 0;
        background-color: transparent;
        color: white;
        width: 100%;
        height: 60px;
        padding: 5px 25px 5px 10px;
        font-size: 19px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        }
        .success{
            background-color: #4bb543;
        }
        .error{
            background-color: red;
        }
        .actions{
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        .tg{
            border-collapse:collapse;
            border-spacing:0;
            background-color: #121212;
            color: white;
            width: 100%;
        }
        .tg td{
            border-color:#121212;
            border-style:solid;
            border-width:1px;
            font-family:Arial, sans-serif;
            font-size:14px;
            overflow:hidden;
            padding:10px 5px;
            word-break:normal;
        }
        .tg th{
            border-color:#121212;
            border-style:solid;
            border-width:1px;
            font-family:Arial, sans-serif;
            font-size:14px;
            font-weight:normal;
            overflow:hidden;
            padding:10px 5px;
            word-break:normal;
        }
        .tg .tg-0lax{
            text-align:left;
            vertical-align:top
        }
        .tg tbody tr{
            height: 50px;
        }
        .tg tbody td{
            font-size: 18px;
        }
        
.memberNames,.gamesHead{
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 18px;
    gap: 10px;
    margin-bottom: 20px;
}

.memberNames::after,.gamesHead::after{
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(-12px);
    margin-bottom: -3px;
}
.memberNames h1,.gamesHead h1{
    font-size: 30px;
}
.tg svg{

    height: 20px;
    width: 20px;
}
.del{
    fill: #cc0000;
}
.edt{
    fill: #24a0ed;
}
.tg td button{
    background-color: transparent;
    border: none;
    cursor: pointer;
}
.gamesList{
    width: 100%;
    height: fit-content;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

</style>

@php

use App\Models\Tournaments;
use App\Models\Posts;
use App\Models\User;
use App\Http\Controllers\TournamentController;

$start = $tourn['startDate']; 
$startDate = strtotime($start); 
$organizerName=User::find($tourn['organizer_id'])->name;

$tournController=new TournamentController();
$tournMembers=$tournController->members($tourn['id']);
$tournGames=Tournaments::find($tourn['id'])->games;

$firstSide=Posts::find(31);
$secondSide=Posts::find(35);
$thirdSide=Posts::find(36);

@endphp


<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
            <ul class="nk-breadcrumbs">
                <li><a rel="v:url" href="/">Home</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                <li><a rel="v:url" href="../tournament/tops">Tournaments</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                <li><span><h1>{{$tourn['name']}}</h1></span></li>
            </ul>
                            
            <div class="tournsInfo">
                <div class="centerContainer">
                    <li id="post-762" class="post" x-data="{click: false}">
                        <ul class="cyberpress-tournament-info">
                            <li>
                                <strong>Dates</strong>: {{date('F  j, Y', strtotime($tourn['startDate']))}}  -   {{date('F  j, Y', strtotime($tourn['endDate']))}}  
                            </li>
                            <li>
                                <strong>Game</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" src="https://wp.nkdev.info/squadforce/wp-content/uploads/2019/10/game-dota-2.svg" class="attachment-medium size-medium" alt="" loading="lazy"> 
                                    {{$tourn['sportType']}}</a>                
                            </li>
                            <li>
                                <strong>Organizer</strong>: {{$organizerName}}  
                            </li>
                            <li>
                                <strong>Type</strong>: {{$tourn['type']}}  
                            </li>
                            <li>
                                <strong>Total Prize pool</strong>: {{$tourn['rewards']}}$            
                            </li>
                        </ul>  
                        @auth
                            <form method="post" style="display: none;" id="userAdd{{$tourn['id']}}" action="../api/enroll/user/{{auth()->user()->id}}/tournament/{{$tourn['id']}}">
                                @csrf                       
                            </form>
                        @endauth
                    </li><!-- #post-## -->
    
                    <p style="margin-bottom: 1.5rem;padding: 0 20px;">{{$tourn['description']}}</p>  
    
                    <div class="actions">
                        @can('admin')
                            <form method="post" action="../api/tournament/{{$tourn['id']}}/createGames" style="display: flex;justify-content: flex-end;">
                                @csrf
                                <input type="submit" name="submit" class="sbt" value="Generate Matches">
                            </form>
                            <form method="post" action="../api/tournament/delete/{{$tourn['id']}}" style="display: flex;justify-content: flex-end;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="submit" class="sbt" value="DELETE">
                            </form>
                            <form method="get" action="../api/tournament/{{$tourn['id']}}/edit" style="display: flex;justify-content: flex-end;">
                                @csrf
                                <input type="submit" name="submit" class="sbt" value="EDIT">
                            </form>
                        @endcan
                        @auth
                            <form method="post" action="../api/enroll/user/{{auth()->user()->id}}/tournament/{{$tourn['id']}}" style="display: flex;justify-content: flex-end;">
                                @csrf
                                <input type="submit" name="submit" class="sbt" value="JOIN">
                            </form>
                        @endauth
                        @guest
                            <a href="../register" class="sign">Signin</a>
                        @endguest
                    </div>


                    <div class="userNames">
                        <div class="memberNames"><span><h1>Tournament Members</h1></span></div>
                        <table class="tg">
                            <thead>
                                <tr>
                                    <td class="tg-0lax">Id<br></td>
                                    <td class="tg-0lax">Username<br></td>
                                    <td class="tg-0lax">Email<br></td>
                                    @if(auth()->user()?->can('admin') || $tourn['organizer_id'] == auth()->user()?->id)
                                    <td class="tg-0lax">Actions<br></td>    
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($tournMembers as $member)
                                        <tr>
                                            <td class="tg-0lax">{{$member['id']}}<br></td>
                                            <td class="tg-0lax">{{$member['name']}}<br></td>
                                            <td class="tg-0lax">{{$member['email']}}<br></td>
                                            

                                            @if(auth()->user()?->can('admin') || $tourn['organizer_id'] == auth()->user()?->id)
                                            <td class="tg-0lax">
                                             <form method="post" action="../api/kick/user/{{$member['id']}}/tournament/{{$tourn['id']}}">
                                                @csrf   
                                                @method('DELETE')
                                                <button >
                                                    <svg class="del" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                                </button> 
                                                
                                               <!-- <button > 
                                                <svg class="edt" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><!-- <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                </button> -->
                                             </form>
                                            </td>   
                                            @endif

                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="tournGames">
                        <div class="gamesHead"><span><h1>Games</h1></span></div>
                        <div class="gamesList">


                            
                            @for($i = 0; $i<count($tournGames);$i++)
                            <x-gameSummary :tournGame='$tournGames[$i]'></x-gameSummary>
                            @endfor
                        </div>

                    </div>
                </div>

                <div class="sideContainer">
                    <h4 class="nk-widget-title"><span>Top 3 Recent</span></h4>
                    <ul>
                        <x-sidePost :firstSide='$firstSide' ></x-sidePost>
                        <x-sidePost :firstSide='$secondSide'></x-sidePost>
                        <x-sidePost :firstSide='$thirdSide'></x-sidePost>
                    </ul>
                </div>
            </div>
        
            
        </div>
        @if(request()->session()->has('response'))
                
                <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                    <p   class="responseContent success">{{session('response')[0]->original['message']}}</p>   
                    @php
                    session()->forget('response');
                    @endphp
                </div>
            @endif
    
            @if(request()->session()->has('error'))
                  <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                      <p   class="responseContent error">{{session('error')[0]->original['errors']}}</p> 
                      @php
                        session()->forget('error');
                    @endphp
                  </div>
            @endif
        
    </x-slot>
</x-baselayout>