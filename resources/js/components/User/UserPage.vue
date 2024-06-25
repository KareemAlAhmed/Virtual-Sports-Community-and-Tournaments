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

                    <div class="actions" v-if="!currentUser">
                            <template v-if="!isFollowRequested">
                                <button v-if="!isFollowed" class="follow" @click="createFollowingReq(getId,getUser.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                                    <p>Follow</p>
                                </button>
                                <button v-if="isFollowed"  class="followed" @click="cancelFollowingRequest(getId,getUser.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                                    <p>Followed</p>
                                </button>
                            </template>
                            <button v-if="isFollowRequested" class="cancelRequest" @click="cancelFollowingRequest(getId,getUser.id)">
                                <svg class="mobileVersion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                                Cancel Request
                            </button>
                        <button>Message</button>
                    </div>

                    <hr style="width: 100%;">

                    <div class="bio">
                        <p style="color: white;font-weight: bold;font-size: 20px;" >Biography:</p>
                        <p>{{getUser.bio}}</p>
                    </div>
                    <hr style="width: 100%;">

                    <div class="records" style="width: 100%;">
                        <p style="color: white;font-weight: bold;font-size: 20px;margin-bottom: 5px;" >Titles:</p>
                        <p>Winning Tournaments : <span class="winning" >{{getUserData.acheivements.tournsWon.length}}</span></p>
                        <p>Winning Leagues : <span class="winning" >{{getUserData.acheivements.leaguesWon.length}}</span></p>
                        <p>Winning Games : <span class="winning" >{{getUserData.acheivements.gamesWon.length}}</span></p>

                        <!-- <p><span class="winning">Winning Tournaments :</span> {{$winningTourns}}</p>
                        <p><span class="winning">Winning Leagues :</span> {{$winningLeagues}}</p> -->
                    </div>

                    <hr style="width: 100%;">
                    <div class="social">
                        <p style="color: white;font-weight: bold;font-size: 20px;margin-bottom: 5px;" >Social:</p>
                        <p>Following : {{ getUserSocialInfo.followed.length }}</p>
                        <p>Followers : {{ getUserSocialInfo.followers.length }}</p>
                        <p>Posts : {{ getUserData.posts.length }}</p>
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
                            <div class="games" @click="setSelected('Posts')">
                            
                                    <button  :class="getSelected === 'Posts' ? 'selected siteLink gameNav' :'siteLink gameNav'">Posts</button>

                            </div>      
                        </div>

                        <div class="recordsContent">
                            
                                <template v-if="getSelected === 'Tourns'">                              
                                    <div v-if="getUserData.acheivements.tournsWon.length === 0" class="noWinning">
                                        <p>The User didnt won Any Tournament .</p>
                                    </div>
                            

                                    <template v-else>
                                        <div class="tournSum" v-for="tourn in getUserData.acheivements.tournsWon" :key="tourn.id">
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
                                        <div class="noWinning"  v-if="getUserData.acheivements.leaguesWon.length === 0">
                                            <p>The User didnt won Any League .</p>
                                        </div>
                                    
                                        <template v-else>
                                            <div class="tournSum" v-for="league in getUserData.acheivements.leaguesWon" :key="league.id">
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
                                    <div class="noWinning" v-if="getUserData.acheivements.gamesWon.length === 0">
                                        <p>The User didnt won Any Game .</p>
                                    </div>
                            
                                    <template v-else>
                                        <div class="tournSum" v-for="game in getUserData.acheivements.gamesWon" :key="game.id">
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

                                <template v-if="getSelected === 'Posts'">
                                    <div class="noWinning" v-if="getUserData.posts.length === 0">
                                        <p>The User Didnt Post Anything Yet .</p>
                                    </div>
                            
                                    <template v-else>
                                        <Post v-for="post in getUserData.posts" :key="post.id" :post='post' :user="post.user"></Post>
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
    import Post from '../minicomponent/Post.vue';

    export default {
        name:"UserPage",
        components: {
            "Post":Post
        },data(){
            return{
                selectedTab:"Tourns",
                currentUser:true
            }  
        },
        computed:{
            isLoading(){
                return store.state.user.acheivements.loading;
            },fullName() {
                return `${store.state.user.name[0].toLocaleUpperCase() +store.state.user.name.slice(1)}`;
            },getUser(){
                return store.state.userProfileData;        
            },getUserData(){
                return store.state.user;
            },getId(){
                return store.state.user.id;
            },getSelected(){
                return store.state.selectedTab;
            },getUserSocialInfo(){
                if(this.currentUser){
                    let info={
                        "followers":store.state.user.followers,
                        "followed":store.state.user.followed,
                        "followingRequests":store.state.user.followingRequests,
                    }
                    return info;
                }else{
                    return store.state.userSocialInfo;
                }
            },isFollowed(){
                return store.state.currentUser.followed;
            },isFollowRequested(){
                return store.state.currentUser.requestSent;
            }
            },methods: { 
                format_date(value){
                    if (value) {
                        return moment(String(value)).format('MMM DD,YYYY');
                }},
                setSelected(select){
                    store.commit("setSelectedTab",select)             
                },createFollowingReq(followerId,followedId){
                    store.dispatch("createFollowingRequest",{followerId,followedId})
                },cancelFollowingRequest(followerId,followedId){
                    store.dispatch("cancelFollowingRequest",{followerId,followedId})
                }
        },created() {
            const userId = this.$route.params.id;
            const currentID=this.getId;
            store.dispatch("getUserProf",userId)
            store.dispatch("getUserAcheivements",userId)
            store.dispatch("getUserPosts",userId)
            store.dispatch("getCurrentUserSocial",userId)
            store.dispatch("isFollowingTrue",{currentID,userId})
            store.dispatch("isFollowRequested",{currentID,userId})
            if(currentID !== userId){
                this.currentUser = false
            }
        }
}
      </script>
      <style scoped>
  .mainContainer{
        min-height: 90vh;
        max-width: 100vw;
        /* padding: 50px 180px; */
        display: flex;
        gap: 20px;
    }
    .centerContainer{
        width: 30%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        background-color: var(--post-color);;
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
        color: #ffffff33;
        margin-left: 10px;
        margin-bottom: 3px;
    }
    .social{
        width: 100%;
    }
    .social p:nth-child(2)
    ,.social p:nth-child(3)
    ,.social p:nth-child(4){
        color: #ffffff33;
        margin-left: 10px;
        margin-bottom: 3px;
    }

    .listContainer{
                position: relative;
                display: flex;
                
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
        background-color: var(--hover-color) !important;
    }
    .wrapper button.siteLink{
        background-color: var(--post-color);;
        padding: 15px;
        transition: all 0.3s ease;
    }
    .wrapper button.siteLink:hover{
        background-color: var(--hover-color) 
    }
    .wrapper .tournSum{
        width: 100%;
        background-color: var(--post-color);;
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
        background-color: var(--post-color);;
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
.actions{
    display: flex;
    gap: 10px;
}
.actions button{
    margin-left: -5px;
    border: none;
    padding: 15px;

    min-width: 115px;
    background-color: var(--background-color);
    color: white;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
}
.actions button:hover{
    background-color: var(--back-color);
    
}
.followed,.follow{
    background-color: var(--back-color) !important;
    display: flex;
    gap: 5px;
    align-items: flex-end;
}
.followed svg,.follow svg{
    width: 15px;
    height: 20px;
    fill: white;
}
.cancelRequest{
    display: flex;
    gap: 10px;
}
.cancelRequest svg{
    width: 15px;
    height: 15px;
    fill: white;
}

.recordsContent .post{
    background-color: var(--post-color);
    padding: 15px;
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
@media screen and (max-width: 600px) {
   .mainContainer{
        flex-direction: column;
        padding: 0;
   }
   .centerContainer{
        width: 100%;
   }
   .sideContainer{
        width: 100%;
        padding: 0;
   }
   .wrapper .listContainer{
        gap: 10px;
        width: 100%;
   }
   .wrapper button.siteLink{
        padding: 15px 5px;
        font-size: 15px;
   }
   .noWinning{
    padding: 20px;
    height: fit-content;
   }
   .wrapper .tournSum img,.wrapper .tournInfo{
        width: calc(50% - 20px);
   }
   .wrapper .tournName{
    font-size: 18px;
   }
   .wrapper .tournInfo p:nth-child(2)
    ,.wrapper .tournInfo p:nth-child(3)
    ,.wrapper .tournInfo p:nth-child(4){
        margin-top: 25px;
        font-size: 15px;
    }
    .centerContainer .post {
            gap: 10px;
        }
        .userImage img{
            width: 50px;
        }   
        .listContainer{
            overflow: scroll;
        }
        .mobileVersion{
            display: none;
        }
        .cancelRequest{
            display: flex;
            font-size: 15px !important;
        }
    }


      </style>