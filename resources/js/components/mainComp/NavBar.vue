<template>      
    <div  id="menuHolder" style="position: relative;">
        <div role="navigation" class="sticky-top border-bottom border-top" id="mainNavigation">
            <div class="flexMain">
                <router-link to="/"> 
                    <h1>Kamkom</h1>
                </router-link>
            
        
                <div class=" text-end d-none d-md-block listContainer" x-data="{ open: false,tournOpen: false,leagOpen: false,gameOpen: false,openMenu:false }" x-on:click.away="open = false" >
                    <router-link to="/" >
                        <button class="siteLink" id="ins">Home</button>
                    </router-link> 
                    <div class="tourns" @mouseenter="tournOpt= !tournOpt" @mouseleave="tournOpt= !tournOpt">
                        <router-link to="/tournaments/tops">
                            <button class="siteLink">Tournaments</button>
                        </router-link> 

                        <div class="popup tournPop" v-if="tournOpt">                                     
                            <router-link to="/tournaments/tops">Top Tournaments</router-link>                             
                            <template v-if="!isGuest">
                                <router-link to="/tournaments/mytourns">My Tournament</router-link>                             
                            </template>
     
                        </div>
                    </div>

                    <div class="leagues" @mouseenter="leagueOpt= !leagueOpt" @mouseleave="leagueOpt= !leagueOpt">
                        <router-link to="/leagues/tops">
                            <button class="siteLink">Leagues</button>
                        </router-link> 
                        <div v-if="leagueOpt" class="popup leaguePop">                                     
                            <router-link to="/leagues/tops">Top Leagues</router-link>                             
                            <template v-if="!isGuest">
                                <router-link to="/leagues/myleague">My Leagues</router-link>                             
                            </template>
                        </div>
                    </div>
                    <div class="games" @mouseenter="gameOpt= !gameOpt" @mouseleave="gameOpt= !gameOpt"> 
                        <router-link to="/games/tops">
                            <button class="siteLink game">Games</button>
                        </router-link>
                        <div v-if="gameOpt" class="popup gamePop">                                     
                            <router-link to="/games/tops">Top Games</router-link>  
                            <template v-if="!isGuest">                       
                                <router-link to="/games/mygames">My Games</router-link>
                            </template>                              
                        </div>
                    </div>
                    <div class="social" @mouseenter="socialOpt= !socialOpt" @mouseleave="socialOpt= !socialOpt"> 
                        <router-link to="/social">
                            <button class="siteLink">Social</button>
                        </router-link>
                        <div v-if="socialOpt" class="popup gamePop">                                     
                            <router-link to="/social/followers">Followers</router-link>  
                            <router-link to="/social/following">Following</router-link>  
                            <router-link to="/social/followingRequests">Follow Requests</router-link>  
                            <router-link to="/social/search">Find User</router-link>                              
                        </div>
                    </div>
                    
                    <!-- @guest -->
                      
                    <div v-if="!get_token">
                        <router-link to="/register"><button class="siteLink">Register</button></router-link>  
                        <router-link to="/Login"><button class="siteLink">Login</button></router-link>
                    </div>
                            <template v-if="get_token">
                                <div class="authen" x-on:click.away="openMenu = false" x-on:mouseover = "openMenu = true">
                                    <router-link :to="/userProfile/+getUser.id " x-on:mouseover = "openMenu = true" id="opt"  class="use OPT">
                                         
                                            <button class="siteLink user" >                          
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"></path></svg>
                                                {{fullName}} 
                                                
                                            </button>

                                           
                                    </router-link>
                                        <!-- @can('admin') -->
                                    <div x-show="openMenu" class="popup other" x-on:mouseover = "openMenu = true"  x-on:mouseover.away = "(e)=> {e.target.className.split(' ')[1] == 'user' ?  openMenu = true :  openMenu = false}">
                                        <!-- "openMenu = (e)=> e.target.className.split(' ')[1] == 'user' ? null : openMenu = false" -->
                                        <!-- <a href="#" x-on:mouseover = "openMenu = true" >Dashboard</a> -->
                                        <router-link to="/dashboard">Dashboard</router-link>  
                                        <router-link to="/messages/contacts">Messages</router-link>  
                                        <!-- @endcan --> 
                                        <a href="#" x-on:mouseover = "openMenu = true"  @click="(e)=> logout(e)">Logout</a>
                                    </div>
                                </div>       
                            </template>
                            
                             
                </div> 
                
                <svg class="ham hamRotate ham8 hide"  @click="displayMenu" viewBox="0 0 100 100" width="80" >
                    <path
                        class="line top"
                        d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
                    <path
                        class="line middle"
                        d="m 30,50 h 40" />
                    <path
                        class="line bottom"
                        d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
                </svg>
            </div>
        </div>
        <div class="mobileMenu">
            
            <div class="home">
                <router-link to="/" ><button class="navMenuOpt" @click="displayMenu">Home</button></router-link>
            </div>
            <div class="tournOpt">
                <button class="navMenuOpt" @click="activateTournPop(isGuest)">Tournaments</button>
                <div class="mobilePopUp">                                     
                    <router-link to="/tournaments/tops"><button class="navMenuOpt" @click="displayMenu">Top Tournaments</button></router-link>                        
                    <template v-if="!isGuest">
                        <router-link to="/tournaments/mytourns"><button class="navMenuOpt" @click="displayMenu">My Tournament</button></router-link>                                                           
                    </template>
                </div>
            </div>
            <div class="leagueOpt">
                <button class="navMenuOpt" @click="activateLeaguePop(isGuest)">Leagues</button>
                <div class="mobilePopUp">    
                    <router-link to="/leagues/tops"><button class="navMenuOpt" @click="displayMenu">Top Leagues</button></router-link>                                        
                    <template v-if="!isGuest">                      
                        <router-link to="/leagues/myleague"><button class="navMenuOpt" @click="displayMenu">My Leagues</button></router-link>                          
                    </template>
                </div>
            </div>
            <div class="gameOpt">
                <button class="navMenuOpt" @click="activateGamePop(isGuest)">Games</button>
                <div   class="mobilePopUp">
                    <router-link to="/games/tops"><button class="navMenuOpt" @click="displayMenu">Top Games</button></router-link>
                     
                    <template v-if="!isGuest">   
                        <router-link to="/games/mygames"><button class="navMenuOpt" @click="displayMenu">My Games</button></router-link>                                          
                    </template> 
                </div>
            </div>
            <div class="socialOpt">
                <button class="navMenuOpt" @click="activateSocialPop(isGuest)">Social</button>
                <div   class="mobilePopUp">
                    <router-link to="/social/followers"><button class="navMenuOpt" @click="displayMenu">Followers</button></router-link>
                    <router-link to="/social/following"><button class="navMenuOpt" @click="displayMenu">Following</button></router-link>
                    <router-link to="/social/followingRequests"><button class="navMenuOpt" @click="displayMenu">Follow Requests</button></router-link>
                    <router-link to="/social/search"><button class="navMenuOpt" @click="displayMenu">Find User</button></router-link>
 
                </div>
            </div>
            <template v-if="!get_token">
                <div class="auth">
                    <router-link to="/register"><button class="navMenuOpt" @click="displayMenu">Register</button></router-link>
                </div>
                <div class="auth">
                    <router-link to="/Login"><button class="navMenuOpt" @click="displayMenu">Login</button></router-link>
                </div>
            </template>

            <template v-else>
                <div class="auth">                        
                                                                                   
                                <router-link :to="/userProfile/+getUser.id " x-on:mouseover = "openMenu = true" id="opt"  class="use OPT">
                                    <button class="navMenuOpt" @click="displayMenu"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"></path></svg>
                                        {{fullName}} 
                                    </button>
                                </router-link>
                                             
                </div> 

                <div  class="auth">
                    <router-link to="/dashboard"><button class="navMenuOpt" @click="displayMenu">Dashboard</button></router-link>                                       
                </div>   
                <div  class="auth">
                    <router-link to="/messages/contacts"><button class="navMenuOpt" @click="displayMenu">Message</button></router-link>                                       
                </div>   
                <div class="auth">
                    <button class="navMenuOpt" @click="(e)=> {displayMenu();logout(e)}">Logout</button>
                </div>
            </template>

        </div>
    </div>


</template>
<script>
import store from '../../store';
import MobileNav from "./MobileNavBar.vue"
export default {
    name:"NavBar",data(){
        return{
            user:store.state.user.data,
            name:store.state.user.name,
            token:store.state.user.token,
            email:store.state.user.email,
            tournOpt:false,
            leagueOpt:false,
            gameOpt:false,
            socialOpt:false,
            nameText:"hello",
            navMobille:false,
        }
    },methods:{
        logout(e){
            e.preventDefault();
            store.dispatch("logout")
        },displayMenu(){
            document.querySelector(".ham").classList.toggle('active')
            document.querySelector("body").classList.toggle('disabl_scrolling')
            document.querySelector(".mainPage").classList.toggle("stopScroll")
            document.querySelector(".mobileMenu").classList.toggle("loadMenu")
            document.querySelector("#app").classList.toggle("appExpand")

            if(document.querySelector(".tournOpt div").classList.contains("popUpActive")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".tournOpt div").classList.contains("popUpActive2")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive2")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".gameOpt div").classList.contains("popUpActive")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".gameOpt div").classList.contains("popUpActive2")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive2")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".leagueOpt div").classList.contains("popUpActive")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".leagueOpt div").classList.contains("popUpActive2")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive2")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".socialOpt div").classList.contains("popUpActive")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".socialOpt div").classList.contains("popUpActive3")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive3")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }
        },activateTournPop(isGuest){

            if(document.querySelector(".leagueOpt div").classList.contains("popUpActive")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".leagueOpt div").classList.contains("popUpActive2")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive2")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".gameOpt div").classList.contains("popUpActive")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".gameOpt div").classList.contains("popUpActive2")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive2")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }
     
            if(document.querySelector(".socialOpt div").classList.contains("popUpActive")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".socialOpt div").classList.contains("popUpActive3")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive3")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }
            if(isGuest){
                document.querySelector(".tournOpt div").classList.toggle("popUpActive")
            }else{
                document.querySelector(".tournOpt div").classList.toggle("popUpActive2")
            }
            document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")          
        },activateLeaguePop(isGuest){
            if(document.querySelector(".tournOpt div").classList.contains("popUpActive")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".tournOpt div").classList.contains("popUpActive2")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive2")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".gameOpt div").classList.contains("popUpActive")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".gameOpt div").classList.contains("popUpActive2")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive2")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }
            
            if(document.querySelector(".socialOpt div").classList.contains("popUpActive")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".socialOpt div").classList.contains("popUpActive3")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive3")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }
            if(isGuest){
                document.querySelector(".leagueOpt div").classList.toggle("popUpActive")
            }else{
                document.querySelector(".leagueOpt div").classList.toggle("popUpActive2")
            }
            document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")          
        },activateGamePop(isGuest){
            if(document.querySelector(".tournOpt div").classList.contains("popUpActive")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".tournOpt div").classList.contains("popUpActive2")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive2")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".leagueOpt div").classList.contains("popUpActive")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".leagueOpt div").classList.contains("popUpActive2")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive2")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }
            
            if(document.querySelector(".socialOpt div").classList.contains("popUpActive")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".socialOpt div").classList.contains("popUpActive3")){
                document.querySelector(".socialOpt div").classList.remove("popUpActive3")
                document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
            }

            if(isGuest){
                document.querySelector(".gameOpt div").classList.toggle("popUpActive")
            }else{
                document.querySelector(".gameOpt div").classList.toggle("popUpActive2")
            }
            document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")          
        },activateSocialPop(isGuest){
            if(document.querySelector(".leagueOpt div").classList.contains("popUpActive")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".leagueOpt div").classList.contains("popUpActive2")){
                document.querySelector(".leagueOpt div").classList.remove("popUpActive2")
                document.querySelector(".leagueOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".gameOpt div").classList.contains("popUpActive")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".gameOpt div").classList.contains("popUpActive2")){
                document.querySelector(".gameOpt div").classList.remove("popUpActive2")
                document.querySelector(".gameOpt button").classList.toggle("activeMenuOpt")
            }
            if(document.querySelector(".tournOpt div").classList.contains("popUpActive")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }else if(document.querySelector(".tournOpt div").classList.contains("popUpActive2")){
                document.querySelector(".tournOpt div").classList.remove("popUpActive2")
                document.querySelector(".tournOpt button").classList.toggle("activeMenuOpt")
            }


            if(isGuest){
                document.querySelector(".socialOpt div").classList.toggle("popUpActive")
            }else{
                document.querySelector(".socialOpt div").classList.toggle("popUpActive3")
            }
            document.querySelector(".socialOpt button").classList.toggle("activeMenuOpt")
        }
        },mounted() {
            this.user=this.getUser

    },computed: {
        fullName() {
            return `${store.state.user.name[0].toLocaleUpperCase() +store.state.user.name.slice(1)}`;
        },
        get_token() {
            return store.state.user.token;
        },getUser(){
            return store.state.user.data;        
        },isGuest(){
                return store.state.user.id == null ? true : false;
        }
    },components:{
        MobileNav
    }
}
</script>
<style scoped>
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
                background-color: var(--hover-color);
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
            .disabl_scrolling{
                height: 100%;
                overflow: hidden;
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

            background: var(--hover-color);
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
            box-shadow: 2px 2px 7px var(--background-color);
            background: var(--background-color) !important;
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
                background-color: var(--post-color);
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
                background-color: var(--hover-color);
            }
            .user svg{
                width: 15px;
                height: 15px;
                margin-top: 2px;
                fill: white;
            }
            .tourns,.leagues,.games,.authen,.social{
                position: relative;
            }
            .tourns a,.leagues a,.games a,.authen a,.social a{
                height: 100%;
                width: 100%;
                display: block;
            }
           
            #opt{
                width: 100%;
                display: block;
                height: 100%;
            }
            .hide{
                display: none;
            }
            .mobileMenu{
                background-color: var(--background-color);;
                position: absolute;
                width: 0;
                right: 0;
                transition: all 0.3s ease;
                height: calc(100vh - 80px);
                display: flex;
                flex-direction: column;
                align-items: center;
                z-index: 9;
                overflow-y: scroll;
            }
            .loadMenu{
                width: 100%;
            }
            .ham {
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            transition: transform 400ms;
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
            }
            .hamRotate.active {
            transform: rotate(45deg);
            }
            .hamRotate180.active {
            transform: rotate(180deg);
            }
            .line {
            fill:none;
            transition: stroke-dasharray 400ms, stroke-dashoffset 400ms;
            stroke:white;
            stroke-width:5.5;
            stroke-linecap:round;
            }
            .ham1 .top {
            stroke-dasharray: 40 139;
            }
            .ham1 .bottom {
            stroke-dasharray: 40 180;
            }
            .ham1.active .top {
            stroke-dashoffset: -98px;
            }
            .ham1.active .bottom {
            stroke-dashoffset: -138px;
            }
            .ham2 .top {
            stroke-dasharray: 40 121;
            }
            .ham2 .bottom {
            stroke-dasharray: 40 121;
            }
            .ham2.active .top {
            stroke-dashoffset: -102px;
            }
            .ham2.active .bottom {
            stroke-dashoffset: -102px;
            }
            .ham3 .top {
            stroke-dasharray: 40 130;
            }
            .ham3 .middle {
            stroke-dasharray: 40 140;
            }
            .ham3 .bottom {
            stroke-dasharray: 40 205;
            }
            .ham3.active .top {
            stroke-dasharray: 75 130;
            stroke-dashoffset: -63px;
            }
            .ham3.active .middle {
            stroke-dashoffset: -102px;
            }
            .ham3.active .bottom {
            stroke-dasharray: 110 205;
            stroke-dashoffset: -86px;
            }
            .ham4 .top {
            stroke-dasharray: 40 121;
            }
            .ham4 .bottom {
            stroke-dasharray: 40 121;
            }
            .ham4.active .top {
            stroke-dashoffset: -68px;
            }
            .ham4.active .bottom {
            stroke-dashoffset: -68px;
            }
            .ham5 .top {
            stroke-dasharray: 40 82;
            }
            .ham5 .bottom {
            stroke-dasharray: 40 82;
            }
            .ham5.active .top {
            stroke-dasharray: 14 82;
            stroke-dashoffset: -72px;
            }
            .ham5.active .bottom {
            stroke-dasharray: 14 82;
            stroke-dashoffset: -72px;
            }
            .ham6 .top {
            stroke-dasharray: 40 172;
            }
            .ham6 .middle {
            stroke-dasharray: 40 111;
            }
            .ham6 .bottom {
            stroke-dasharray: 40 172;
            }
            .ham6.active .top {
            stroke-dashoffset: -132px;
            }
            .ham6.active .middle {
            stroke-dashoffset: -71px;
            }
            .ham6.active .bottom {
            stroke-dashoffset: -132px;
            }
            .ham7 .top {
            stroke-dasharray: 40 82;
            }
            .ham7 .middle {
            stroke-dasharray: 40 111;
            }
            .ham7 .bottom {
            stroke-dasharray: 40 161;
            }
            .ham7.active .top {
            stroke-dasharray: 17 82;
            stroke-dashoffset: -62px;
            }
            .ham7.active .middle {
            stroke-dashoffset: 23px;
            }
            .ham7.active .bottom {
            stroke-dashoffset: -83px;
            }
            .ham8 .top {
            stroke-dasharray: 40 160;
            }
            .ham8 .middle {
            stroke-dasharray: 40 142;
            transform-origin: 50%;
            transition: transform 400ms;
            }
            .ham8 .bottom {
            stroke-dasharray: 40 85;
            transform-origin: 50%;
            transition: transform 400ms, stroke-dashoffset 400ms;
            }
            .ham8.active .top {
            stroke-dashoffset: -64px;
            }
            .ham8.active .middle {
            stroke-dashoffset: 0px;
            transform: rotate(90deg);
            }
            .ham8.active .bottom {
            stroke-dashoffset: -64px;
            }
            .stopScroll{
                max-height: 100vh;
                overflow: hidden;
            }
            .navMenuOpt{
                border: none;
                padding: 24px;
                display: inline-block;
                width: 100vw;
                background-color: transparent;
                color: white;
                font-weight: 600;
                font-size: 32px;
                cursor: pointer;
            }
            .navMenuOpt a{
                width: 100%;
                height: 100%;
                display: block;
            }
            .mobileMenu div{
                width: 100%;
            }
            .mobileMenu a{
                height: 100%;
                width: 100%;
                display: block;
            }
            .popUpActive1 a {
                height: fit-content !important;
            }
            .popUpActive2 a {
                height: fit-content !important;
            }
            .popUpActive3 a {
                height: fit-content !important;
            }
            .mobilePopUp{
                height: 0;
                transition: all 0.3s ease;
                overflow: hidden;
                background-color: var(--post-color);;
            }
            .mobilePopUp button{
                height: fit-content;
            }
            .popUpActive{
                height: 85px;
            }
            .popUpActive2{
                height: 170px;
            }
            .popUpActive3{
                height: 340px;
            }
            .activeMenuOpt{
                background-color: var(--post-color);;
            }
            .auth svg{
                fill: white;
            }
            @media screen and (max-width: 600px) {
                .listContainer{
                    display: none;
                }
                .hide{
                    display: block;
                }
                .flexMain{
                    padding: 0px 20px;
                }
            }
</style>