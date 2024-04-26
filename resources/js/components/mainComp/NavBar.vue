<template>      
    <div  id="menuHolder">
        <div role="navigation" class="sticky-top border-bottom border-top" id="mainNavigation">
            <div class="flexMain">
                <router-link to="/"> 
                    <h1>Kamkom</h1>
                </router-link>
            
        
                <div class=" text-end d-none d-md-block listContainer" x-data="{ open: false,tournOpen: false,leagOpen: false,gameOpen: false,openMenu:false }" x-on:click.away="open = false" >
                    <router-link to="/" >
                        <button class="siteLink" id="ins">Home</button>
                    </router-link> 
                    <div class="tourns">
                        <router-link to="/tournaments/tops" x-on:click="tournOpen = !open" x-on:mouseover = "tournOpen = true">
                            <button class="siteLink tourn">Tournaments</button>
                        </router-link> 
                        <div x-show="tournOpen" class="popup tournPop" x-on:mouseover = "tournOpen = true" x-on:mouseover.away = "tournOpen = (e)=> e.target.className.split(' ')[1] == 'tourn' ? null : tournOpen = false">                                     
                            <router-link to="/tournaments/tops">Top Tournaments</router-link>                             
                            <router-link to="/tournaments/mytourns">My Tournament</router-link>                             
                            <router-link to="/tournaments/create">Create Tournament</router-link>                             
                        </div>
                    </div>
                    <div class="leagues">
                        <router-link to="/leagues/tops" x-on:click="leagOpen = !open" x-on:mouseover = "leagOpen = true">
                            <button class="siteLink league">Leagues</button>
                        </router-link> 
                        <div x-show="leagOpen" class="popup leaguePop" x-on:mouseover = "leagOpen = true" x-on:mouseover.away = "leagOpen = (e)=> e.target.className.split(' ')[1] == 'league' ? null : leagOpen = false">                                     
                            <router-link to="/leagues/tops">Top Leagues</router-link>                             
                            <router-link to="/leagues/myleague">My Leagues</router-link>                             
                            <router-link to="/leagues/create">Create League</router-link> 
                        </div>
                    </div>
                    <div class="games">
                        <router-link to="/games/tops" x-on:click="gameOpen = !open" x-on:mouseover = "gameOpen = true">
                            <button class="siteLink game">Games</button>
                        </router-link>
                        <div x-show="gameOpen" class="popup gamePop" x-on:mouseover = "gameOpen = true" x-on:mouseover.away = "gameOpen = (e)=> e.target.className.split(' ')[1] == 'game' ? null : gameOpen = false">                                     
                            <router-link to="/games/tops">Top Games</router-link>                             
                            <router-link to="/games/mygame">My Games</router-link>                             
                            <router-link to="/games/create">Create Games</router-link> 
                        </div>
                    </div>
                    
                    <!-- @guest -->
                      
                    <div v-if="!get_token">
                        <router-link to="/register"><button class="siteLink">Register</button></router-link>  
                        <router-link to="/Login"><button class="siteLink">Login</button></router-link>
                    </div>

                            <template v-if="get_token">
                                <div class="authen" x-on:click.away="openMenu = false" x-on:mouseover = "openMenu = true">
                                    <a href="#"  x-on:click="(event)=>{  openMenu=true}" x-on:mouseover = "openMenu = true" id="opt"  class="use OPT">   
                                        <button class="siteLink user" @click="console.log(user)" >
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"></path></svg>
                                            {{fullName}} 
                                        </button>

                                    </a> 
                                        <!-- @can('admin') -->
                                    <div x-show="openMenu" class="popup other" x-on:mouseover = "openMenu = true"  x-on:mouseover.away = "(e)=> {e.target.className.split(' ')[1] == 'user' ?  openMenu = true :  openMenu = false}">
                                        <!-- "openMenu = (e)=> e.target.className.split(' ')[1] == 'user' ? null : openMenu = false" -->
                                        <a href="#" x-on:mouseover = "openMenu = true" >Dashboard</a>
                                        <!-- @endcan --> 
                                        <a href="#" x-on:mouseover = "openMenu = true"  @click="(e)=> logout(e)">Logout</a>
                                    </div>
                                </div>       
                            </template>
                            
                             
                </div> 
            </div>
        </div>
    </div>


</template>
<script>
import store from '../../store';
export default {
    name:"NavBar",data(){
        return{
            user:store.state.user.data,
            name:store.state.user.name,
            token:store.state.user.token,
            email:store.state.user.email,
            nameText:"hello"
        }
    },methods:{
        logout(e){
            e.preventDefault();
            store.dispatch()
        }
        },mounted() {
            this.user=store.state.user.data

    },computed: {
        fullName() {
            return `${store.state.user.name}`;
        },
        get_token() {
            return store.state.user.token;
        }
    }
}
</script>
<style>
            .userName{
                color: white;
                font-size: 23px;
                font-weight: 700;
            }

            .flexMain {
                display:flex;
                align-items: center;
                justify-content: space-between;
                padding: 0px 70px 0 165px;
                background-color: #000000e6;
            }
    
            .flexMain h1{
                font-size: 35px;
                font-weight: 800;
                color: white;font-size: 35px;
                font-weight: 800;
                text-decoration: none;
            }
            button.siteLink {
                margin-left:-5px;
                border:none;
                padding:24px;
                display:inline-block;
                min-width:115px;
                background-color: transparent;
                color: white;
                font-weight: 600;
                font-size: 17px;
                cursor: pointer;
            }
            button.siteLink:hover{
                background-color: #1f1f1f;
            }
            #mainNavigation {
            transition : transform 200ms linear;
            background : #fff;
            }
            .content-container   h1 {
            color: white;
            text-align: center;
            font-size: 35px;
            font-weight: 800;
            }

            .flex-container {
            width: 100vw;

            margin-top: 60px;
            margin-bottom: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            }

            .content-container {
            width: 500px;
            height: auto;
            }

            .form-container {
            display: flex;
            justify-content: center;
            align-items: center;

            width: 500px;
            height: auto;

            margin-top: 5px;
            padding-top: 20px;

            border-radius: 12px;

            display: flex;
            justify-content: center;
            flex-direction: column;

            background: #1f1f1f;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.199);
            }

            .subtitle {
            font-size: 11px;

            color: rgba(177, 177, 177, 0.3);
            }

            .flex-container input {
            border: none;
            border-bottom: solid rgb(143, 143, 143) 1px;
            margin-bottom: 30px;
            background: none ;
            background-color: transparent ;
            color: rgba(255, 255, 255, 0.555);
            height: 35px;
            width: 300px;
            }
            input:-internal-autofill-selected{
                background-color: transparent !important;
            }
            .submit-btn {
                cursor: pointer;
            border: none !important;
            border-radius: 8px;
            box-shadow: 2px 2px 7px #121212;
            background: #121212 !important;
            color: rgba(255, 255, 255, 0.8) !important;
            width: 90px !important;
            transition: all 1s;
            }

            .submit-btn:hover {
            color: rgb(255, 255, 255);

            box-shadow: none;
            }
            .popup{
                position: absolute;
                right: 0;
                z-index: 8;

                color: white;
                background-color: #191919;
                /* padding: 7px 13px; */
                width: 130px;
                display: flex;
                flex-direction: column;
                font-weight: 600;
                font-size: 17px;
                align-items: center;
            }
            .tournPop{
                width: 104%;
                left: -5px;
                z-index: 8;
            }
            .leaguePop,.gamePop{
                width: 105%;
                left: -5px;
                z-index: 8;
            }
            .userOp{
                top: 100%;
            }
            .listContainer{
                position: relative;
                display: flex;
            }
            .popup a{
                width: 100%;
                text-align: center;
                padding: 10px;
            }
            .popup a:hover{
                background-color: #1f1f1f;
            }
            .user svg{
                width: 15px;
                height: 15px;
                margin-top: 2px;
                fill: white;
            }
            .tourns,.leagues,.games,.authen{
                position: relative;
            }
            #opt{
                width: 100%;
                display: block;
                height: 100%;
            }
</style>