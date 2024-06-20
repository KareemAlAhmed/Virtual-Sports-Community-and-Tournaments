<template>   

<div class="mainContainer">
           
                            
            <div class="tournsInfo">


                <div v-if="!isLoading" class="loading">
                    <p>
                        Loading
                    </p>
                    <div class="col-3">
                        <div class="snippet" data-title="dot-pulse">
                        <div class="stage">
                            <div class="dot-pulse"></div>
                        </div>
                        </div>
                    </div>
          
                </div>
                
                <template v-else>
                    <ul class="nk-breadcrumbs">
                    <li><a rel="v:url" href="/">Home</a></li>
                    <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                    <li><a rel="v:url" href="../tournament/tops">Tournaments</a></li>
                    <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                    <li><span><h1>{{tourn.name}}</h1></span></li>
                </ul>
                <div class="centerContainer">
                    <li id="post-762" class="post" x-data="{click: false}">
                        <ul class="cyberpress-tournament-info">
                            <li>
                                <strong>Dates</strong>: {{format_date(tourn.startDate)}}  -   {{format_date(tourn.endDate)}}  
                            </li>
                            <li>
                                <strong>Game</strong>: <img width="200" height="200" :src="'http://127.0.0.1:8000/storage/gamesLogo/'+tourn.sportType +'.png'" class="attachment-medium size-medium" alt="" loading="lazy"> 
                                    {{tourn.sportType}}                
                            </li>
                            <li>
                                <strong>Organizer</strong>: {{tourn.owner.name}}  
                            </li>
                            <li>
                                <strong>Type</strong>: {{tourn.type}}  
                            </li>
                            <li>
                                <strong>Total Prize pool</strong>: {{tourn.rewards}}          
                            </li>
                            <li>
                                <strong>Places</strong>: {{tourn.takesPlaces}}/{{tourn.maxPlaces}}            
                            </li>
                        </ul>  
                    </li>
    
                    <p  class="description">{{tourn.description}}</p>  
    
                    <div class="actions">
                        <button v-if="cuurentUserId == tourn.owner.id || cuurentUserId =='1'" name="submit" class="sbt" @click="simulateTourn(tourn.id);">Simulate Tourn</button>
                        <button v-if="cuurentUserId == tourn.owner.id || cuurentUserId =='1'" name="submit" class="sbt" @click="generateMatches(tourn.id);">Generate Matches</button>
                        <button v-if="cuurentUserId == tourn.owner.id || cuurentUserId =='1'" name="submit" class="sbt" @click="deleteTourn(tourn.id);">DELETE</button>
                        <template v-if="isGuest == false">
                            <button v-if="!isjoined" name="submit" class="sbt" @click="join(cuurentUserId,tourn.id);">JOIN</button>   
                            <button v-else name="submit"  class="sbt disabledbtn" disabled>JOINED</button>
                        </template>
                        <template v-else>
                            <button  name="SignIn" class="sbt" @click="goSign()" >SIGNIN</button>
                        </template>
                            
                    </div>


                    <div class="userNames">
                        <div class="memberNames"><span><h1>Tournament Members</h1></span></div>
                        <table class="tg">
                            <thead>
                                <tr>
                                    <td class="tg-0lax">Id<br></td>
                                    <td class="tg-0lax">Username<br></td>
                                    <td class="tg-0lax mobVersion">Email<br></td>
                                    <td class="tg-0lax" v-if="cuurentUserId == tourn.owner.id || cuurentUserId =='1'">Actions<br></td>    
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="members.length != 0">
                                            <tr v-for="member in members" :key="member.id">
                                                <td class="tg-0lax" :class="tourn.winner_id != null && member.id == tourn.winner_id ? 'winner' : null">{{member.id}}<br></td>
                                                <td class="tg-0lax memName" :class="tourn.winner_id != null && member.id == tourn.winner_id ? 'winner' : null"><router-link :to="/userProfile/+member.id ">{{member.name}}</router-link><br></td>
                                                <td class="tg-0lax mobVersion" :class="tourn.winner_id != null && member.id == tourn.winner_id ? 'winner' : null">{{member.email}}<br></td>
                                                
                                                <!-- @if(auth()->user()?->can('admin') || $tourn['organizer_id'] == auth()->user()?->id) -->
                                                <td class="tg-0lax" v-if="cuurentUserId == tourn.owner.id || cuurentUserId =='1'">
                                                <!-- <form method="post" action="../api/kick/user/{{$member['id']}}/tournament/{{$tourn['id']}}"> -->
                                                    <!-- @csrf   
                                                    @method('DELETE') -->
                                                    <button @click="kickUser(member.id,tourn.id)">                                        
                                                        <svg class="del" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                                    </button> 
                                                    
                                                    <button > 
                                                        <svg class="edt" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"> <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                    </button> 
                                                <!-- </form> -->
                                                </td>   
                                                <!-- @endif -->
                                            </tr>
                                        </template>
                                        <template v-else>
                                            <tr>
                                                <td colspan="4" class="noresult">There is No Member Participated Yet.</td>
                                            </tr>
                                        </template>
                            </tbody>
                        </table>
                    </div>


                    <div class="tournGames">
                        <div class="gamesHead"><span><h1>Games</h1></span></div>
                        <div class="gamesList">
                            <template v-if="games.length == 0">
                                <p class="nogame">There Is No Game Yet.</p>
                            </template>
                            <template v-else>
                                <GameSummary v-for="game in games" :key="game.id" compType="tourn" :game="game"/>
                            </template>
        
                        </div>

                    </div>
                    </div>
                </template>

            </div>
            <SideContainer class="hide"/>
        
            
        </div>
      
        
  </template>
  <script>
    import { RouterLink } from 'vue-router';
    import store from '../../store'  
    import router from "../../router";
    import SideContainer from '../minicomponent/SideContainer.vue'
    import moment from 'moment';
    import GameSummary from '../game/GameSummary.vue';
  export default {
      name:"TournPage",
      components: {
            SideContainer,
            RouterLink,
                GameSummary
        },data(){
            return{
                posts:{}
            }  
        },
        computed:{
            tourn(){
              return store.state.currentTourn.data;
            },members(){
                return store.state.currentTourn.members;
            },games(){
                return store.state.currentTourn.games;
            },isLoading(){
                return store.state.currentTourn.loading;
            },cuurentUserId(){
                return store.state.user.id;
            },isjoined(){
                return store.state.currentTourn.isJoined;
            },isGuest(){
                return store.state.user.id == null ? true : false;
            }
            }
         ,methods: { 
            format_date(value){
                if (value) {
                    return moment(String(value)).format('MMM DD,YYYY')
                }
          
            },join(userId,tournId){
                store.dispatch("joinTourn",{userId,tournId})
            },generateMatches(tournId){
                store.dispatch("createTournGames",tournId)      
            },deleteTourn(tournId){
                store.dispatch("deleteTourn",tournId)
            },kickUser(userId,tournId){            
                store.dispatch("kickUserFromTourn",{userId,tournId})
            },goSign(){
                router.push("/Login")
            },simulateTourn(id){
                store.dispatch("simulateTourn",id)
            }
        },created() {
            
            if(!store.state.currentTourn.data.id && store.state.currentTourn.id){
                store.dispatch('getCurrentTourn',store.state.currentTourn.id)
            }else{
                console.log("false")
            }
            let userId=this.cuurentUserId;
            let tournId=sessionStorage.getItem("currentTourn")
            store.dispatch("isJoinedTourn",{userId,tournId})
        }
  }
  </script>
  <style scoped >
      .mainContainer{
        min-height: 80vh;
        /* border-radius: 12px;
        margin: 45px 165px;
        padding: 15px 15px; */
    }
    
    
.tournsInfo{
    width: 70%;
    min-height: 50vh;
    display: flex;
    flex-direction: column;
    gap: 25px;
    color: white;
    padding: 15px 15px;
    background-color: var(--post-color);
    font-size: 20px;
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



.centerContainer{
    width: 100%;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.post {
    width: 100%;

    padding: 20px;
    font-size: 16px;
    color: white;
    border-radius: 8px;
    background-color: var(--background-color);
}
h2{
    font-weight: 700;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.post ul{
    display: flex;
    list-style: none;
    gap: 13px;
    flex-direction: column;
    font-size: 20px;
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
    box-shadow: 2px 2px 7px var(--background-color);
    background: var(--background-color);
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
    box-shadow: 2px 2px 7px var(--background-color);
    background: var(--background-color);
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
            background-color: var(--background-color);
            color: white;
            width: 100%;
        }
        .tg td{
            border-color:var(--background-color);
            border-style:solid;
            border-width:1px;
            font-family:Arial, sans-serif;
            font-size:20px;
            overflow:hidden;
            padding:10px 5px;
            word-break:normal;
        }
        .tg th{
            border-color:var(--background-color);
            border-style:solid;
            border-width:1px;
            font-family:Arial, sans-serif;
            font-size:20px;
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
            font-size: 20px;
        }
        tbody td:last-child{
            display: flex;
            gap: 5px;
        }
        .winner{
    color: yellow;
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
li strong{
    cursor: pointer;
}
li strong:hover{
    text-decoration: underline;
}
.noresult{
    text-align: center;
    font-size: 22px !important;
    font-weight: bold;
    display: table-cell !important;
}
.nogame{
    width: 100%;
    height: 50px;
    background-color: var(--background-color);
    text-align: center;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 22px;
    font-weight: bold;

}
.memName a{
    transition: all 0,3s ease;
}
.memName a:hover{
    text-decoration: underline;
}
.loading{
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 15px;
}
.description{
    margin-bottom: 1.5rem;
    padding: 0px 20px;
    width: 100%;
}
@media screen and (max-width: 600px) {
    .hide{
        display: none;
    }
    .tournsInfo{
        width: 100%;
    }
    .tournsInfo h1,.memberNames h1{
        font-size: 27px;
    }
    .noTourn h3{
        font-size: 25px;
    }
    .post ul{
        font-size: 17px;
    }
    .actions,.userNames,.tournGames{
        width: 100%;
    }
    .sbt{
        font-size: 14px;
    }
    .mobVersion{
        display: none;
    }

}
  </style>