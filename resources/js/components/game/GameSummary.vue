<template>   
  
  <div class="game">
  
    <template v-if="compType == 'tourn' || game.competetionType == 'Tournament'">
        <div class="gameInfo">

            <div class="firstUser">
                <a href="../user/{{$user1['id']}}">
                    <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+game.user1.image_url">
                </a>
                <a href="../user/{{$user1['id']}}" class="playerName">{{game.firstUserName}}</a>
            </div>
            <div class="timeAndResult">
                <a href="#" style="text-align: center;">
                <span class="gameDate">  {{format_date(game.date + " " +game.startTime)}} </span>
                <span class="scores">{{ game.firstUserScore == 'Null' || game.firstUserScore == Null ? 'VS' : game.firstUserScore + ' : ' + game.secondUserScore}}</span>
                </a>

            </div>
            <div class="secondUser">
                
                <a href="../user/{{$user2['id']}}">
                    <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+game.user2.image_url">
                </a>
                <a href="../user/{{$user2['id']}}" class="playerName">{{game.secondUserName}}</a>
            </div>
            </div>
            <ul>
            <li>
                <strong>Game:</strong> <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" :src="'http://127.0.0.1:8000/storage/gamesLogo/'+game.sportType+'.png'" class="attachment-medium size-medium" alt="" loading="lazy"> 
                    {{game.sportType}}</a>                
            </li>
            <li>
                <strong>Tournament:</strong> <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"> 
                    {{game.tournaments.name}}</a>                
            </li>
            </ul>
    </template>



    <template v-else >
        <div class="gameInfo">
            <div class="firstUser">
                <a href="../user/{{$user1['id']}}">
                   
                <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+game.user1.image_url"></a>
                <a href="../user/{{$user1['id']}}" class="playerName">{{game.firstUserName}}</a>
            </div>
            <div class="timeAndResult">
                <a href="#" style="text-align: center;">
                <span class="gameDate">  {{format_date(game.date + " " +game.startTime)}}  </span>
                <span class="scores">{{ game.firstUserScore == 'Null' || game.firstUserScore == Null ? 'VS' : game.firstUserScore + ' : ' + game.secondUserScore}}</span>
                </a>

            </div>
            <div class="secondUser">
                
                <a href="../user/{{$user2['id']}}">
                <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+game.user2.image_url"></a>
                <a href="../user/{{$user2['id']}}" class="playerName">{{game.secondUserName}}</a>
            </div>
            </div>
            <ul>
            <li>
                <strong>Game</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" :src="'http://127.0.0.1:8000/storage/gamesLogo/'+game.sportType+'.png'" class="attachment-medium size-medium" alt="" loading="lazy"> 
                    {{game.sportType}}</a>                
            </li>
            <li>
                <strong>League</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"> 
                    {{game.leagues.name}}</a>                
            </li>
            </ul>
    </template>





 
</div>
  </template>
  
  <script>
    import { RouterLink } from 'vue-router';
  import store from '../../store'
 
      import moment from 'moment';
    export default {
      name:"GameSummary",props:['compType','game'],
      

      methods: { 
        format_date(value){
           if (value) {
             return moment(String(value)).format('MMM DD,YYYY')
            }
        }
        
     },
      
    }
  </script>
  <style scoped>
  .playerName{
        color: white;
        font-size: 22px;
        font-weight: 700;
        width: fit-content;
    }
.game{
        width: 100%;
        height: fit-content;
        background-color: var(--background-color);
        padding: 20px;
        color: #fff;
        cursor: pointer;
        position: relative;
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
        flex-direction: column;
        gap: 10px;
        width: 245px;
    }
    .secondUser {
        justify-content: center;
    }
    .secondUser .playerName{
        text-align: center;
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
    @media screen and (max-width: 600px) {
        .game .gameInfo img{
            height: 50px;
            width: 50px;
        }
        .playerName{
            font-size: 16px;
        }
        .scores{
            width: fit-content;
        }
        .gameDate{
            font-size: 14px;
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-weight: 700;
        }
        .gameInfo{
            gap: 8px;
        }
        .game ul{
        font-size: 14px;
    }
    }
  </style>
  