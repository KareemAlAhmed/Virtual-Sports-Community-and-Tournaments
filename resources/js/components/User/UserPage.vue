<template>   

<div class="mainContainer">

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
                <div  class="centerContainer" >

                    <div class="logoAndName">
                        <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+getUser.image_url " alt="http://127.0.0.1:8000/storage/images.jpeg">
                        <div class="name">{{getUser.name}}<span>#{{getUser.id}}</span></div>
                    </div>

                    <hr style="width: 100%;">

                    <div class="bio">
                        <p style="color: white;font-weight: bold;font-size: 20px;" >Biography:</p>
                        <p>{{getUser.bio}}</p>
                    </div>

                    <hr style="width: 100%;">

                    <div class="records" style="width: 100%;">
                        <p style="color: white;font-weight: bold;font-size: 20px;margin-bottom: 5px;" >Titles:</p>
                        <p>Winning Tournaments : <span class="winning" >{{getAcheivs.tournsWon.length}}</span></p>
                        <p>Winning Leagues : <span class="winning" >{{getAcheivs.leaguesWon.length}}</span></p>
                        <p>Winning Games : <span class="winning" >{{getAcheivs.gamesWon.length}}</span></p>

                        <!-- <p><span class="winning">Winning Tournaments :</span> {{$winningTourns}}</p>
                        <p><span class="winning">Winning Leagues :</span> {{$winningLeagues}}</p> -->
                    </div>

                    </div>


                    <div class="sideContainer">
                    <div class="wrapper" style="width: 100%;height:100%">
                        
                        <div class=" text-end d-none d-md-block listContainer" x-data="{ open: false,tournOpen: false,leagOpen: false,gameOpen: false }" x-on:click.away="open = false" >                   
                            <div class="tourns" @click="setSelected('Tourns')">
                            
                                <button :class="getSelected === 'Tourns' ? 'selected siteLink tourn' :'siteLink tourn'" > Tournaments</button>
                                
                            </div>
                            <div class="leagues" @click="setSelected('Leagues')">

                                    <button :class="getSelected === 'Leagues' ? 'selected siteLink league' :'siteLink league'" >Leagues</button>

                            </div>
                            <div class="games" @click="setSelected('Games')">
                            
                                    <button  :class="getSelected === 'Games' ? 'selected siteLink gameNav' :'siteLink gameNav'">Games</button>

                            </div>      
                        </div>

                        <div class="recordsContent">
                            
                                <template v-if="getSelected === 'Tourns'">                              
                                    <div v-if="getAcheivs.tournsWon.length === 0" class="noWinning">
                                        <p>The User didnt won Any Tournament .</p>
                                    </div>
                            

                                    <template v-else>
                                        <div class="tournSum" v-for="tourn in getAcheivs.tournsWon" :key="tourn.id">
                                            <img :src="'http://127.0.0.1:8000/storage/gamesLogo/'+tourn.sportType+'.png' " alt="http://127.0.0.1:8000/storage/images.jpeg">
                                            <div class="tournInfo">
                                                <p class="tournName">{{tourn.name}}</p>
                                                <p>Sport Type :<span>{{tourn.sportType}}</span></p>
                                                <p>Rewards :<span>{{tourn.rewards}}</span></p>
                                                <p>Type :<span>{{tourn.type}}</span></p>
                                            </div>
                                        
                                        </div>
                                    </template>
                                </template>

                                <template v-if="getSelected ==='Leagues'">
                                        <div class="noWinning"  v-if="getAcheivs.leaguesWon.length === 0">
                                            <p>The User didnt won Any League .</p>
                                        </div>
                                    
                                        <template v-else>
                                            <div class="tournSum" v-for="league in getAcheivs.leaguesWon" :key="league.id">
                                                <img :src="'http://127.0.0.1:8000/storage/gamesLogo/'+league.sportType+'.png' " alt="http://127.0.0.1:8000/storage/images.jpeg">
                                                <div class="tournInfo">
                                                    <p class="tournName">{{league.name}}</p>
                                                    <p>Sport Type :<span>{{league.sportType}}</span></p>
                                                    <p>Rewards :<span>{{league.rewards}}</span></p>
                                                    <p>Type :<span>{{"Ranked"}}</span></p>
                                                </div>
                                            
                                            </div>
                                        </template>  
                                </template>
                                
                                <template v-if="getSelected==='Games'">
                                    <div class="noWinning" v-if="getAcheivs.gamesWon.length === 0">
                                        <p>The User didnt won Any Game .</p>
                                    </div>
                            
                                    <template v-else>
                                        <div class="tournSum" v-for="game in getAcheivs.gamesWon" :key="game.id">
                                            <img :src="'http://127.0.0.1:8000/storage/gamesLogo/'+game.sportType+'.png' " alt="http://127.0.0.1:8000/storage/images.jpeg">
                                            <div class="tournInfo">
                                                <p class="tournName">Against {{game.firstUserName == getUser.name ? game.secondUserName : game.firstUserName}}</p>
                                                <p>Sport Type :<span>{{game.sportType}}</span></p>
                                                <p>Scores : <span>{{game.firstUserScore}}</span> <span>{{" - "}}</span><span>{{game.secondUserScore}}</span> </p>
                                                <p>Type :<span>{{"Ranked"}}</span></p>
                                            </div>
                                        
                                        </div>
                                    </template> 
                                </template>     
                                
                            
                                        

                        </div>

                    </div>
                    </div>
            </template>
        </div>        
</template>

<script>
    import { RouterLink } from 'vue-router';
    import store from '../../store'  

    import moment from 'moment';
    import router from "../../router";

    export default {
        name:"UserPage",
        components: {

        },data(){
            return{
                selectedTab:"Tourns"
            }  
        },
        computed:{
            isLoading(){
                return store.state.user.acheivements.loading;
            },fullName() {
                return `${store.state.user.name[0].toLocaleUpperCase() +store.state.user.name.slice(1)}`;
            },getUser(){
                return store.state.userProfileData;        
            },getAcheivs(){
                return store.state.user.acheivements;
            },getId(){
                return store.state.user.id;
            },getSelected(){
                return store.state.selectedTab;
            }
            },methods: { 
                format_date(value){
                    if (value) {
                        return moment(String(value)).format('MMM DD,YYYY');
                }},
                setSelected(select){
                    store.commit("setSelectedTab",select)             
                }
        },created() {
            const userId = this.$route.params.id;
            store.dispatch("getUserProf",userId)
            store.dispatch("getUserAcheivements",userId)
        }
}
      </script>
      <style scoped>
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
        transition: all 0.3s ease;
    }
    .wrapper button.siteLink:hover{
        background-color: #1f1f1f 
    }
    .wrapper .tournSum{
        width: 100%;
        background-color: #191919;
        height: 200px;
        display: flex;
        gap: 20px;
        color: white;
        cursor: pointer;
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
.loading{
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    display: flex;
    align-items: baseline;
    justify-content: center;
    gap: 15px;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
}

.dot-pulse {
  position: relative;
  left: -9999px;
  width: 10px;
  height: 10px;
  border-radius: 5px;
  background-color: white;
  color: #ffffff;
  box-shadow: 9999px 0 0 -5px;
  animation: dot-pulse 1.5s infinite linear;
  animation-delay: 0.25s;
}
.dot-pulse::before, .dot-pulse::after {
  content: "";
  display: inline-block;
  position: absolute;
  top: 0;
  width: 10px;
  height: 10px;
  border-radius: 5px;
  background-color: white;
  color: white;
}
.dot-pulse::before {
  box-shadow: 9984px 0 0 -5px;
  animation: dot-pulse-before 1.5s infinite linear;
  animation-delay: 0s;
}
.dot-pulse::after {
  box-shadow: 10014px 0 0 -5px;
  animation: dot-pulse-after 1.5s infinite linear;
  animation-delay: 0.5s;
}

@keyframes dot-pulse-before {
  0% {
    box-shadow: 9984px 0 0 -5px;
  }
  30% {
    box-shadow: 9984px 0 0 2px;
  }
  60%, 100% {
    box-shadow: 9984px 0 0 -5px;
  }
}
@keyframes dot-pulse {
  0% {
    box-shadow: 9999px 0 0 -5px;
  }
  30% {
    box-shadow: 9999px 0 0 2px;
  }
  60%, 100% {
    box-shadow: 9999px 0 0 -5px;
  }
}
@keyframes dot-pulse-after {
  0% {
    box-shadow: 10014px 0 0 -5px;
  }
  30% {
    box-shadow: 10014px 0 0 2px;
  }
  60%, 100% {
    box-shadow: 10014px 0 0 -5px;
  }
}

      </style>