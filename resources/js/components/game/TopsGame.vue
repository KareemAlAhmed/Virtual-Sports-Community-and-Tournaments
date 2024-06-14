<template>   

    <div class="mainContainer">
               
                
                <div class="tournsInfo">
                    <!-- @if(empty($tourn))
                        <div class="noTourn">
                            <h3>There is no Tournaments.</h3>
                        </div> -->
                    <!-- @else -->
                    <ul class="nk-breadcrumbs">
                        <li><a rel="v:url" href="/">Home</a></li>
                        <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>
                        <li><span><h1>Games</h1></span></li>
                    </ul>
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
                        <ul class="tournsList">
                            <template v-if="games.length == 0">
                                <p class="nogame">There Is No Game Yet.</p>
                            </template>
                            <template v-else>
                                <GameSummary v-for="game in games" :key="game.id" compType="league" :game="game"/>
                            </template>
                        <!-- <template v-for="game in getTourns" :key="game.id">
                            <SmallCard :post="game" comptype="Tourn" />
                        </template> -->
                        <!-- <x-smallCardPost :data='$tourn'  nojoined='true' compType='tournament'></x-smallCardPost>
                        @for( $i = 1; $i<count($allTourn);$i++)
                            <x-smallCardPost :data='$allTourn[$i]'  nojoined='true' compType='tournament'></x-smallCardPost>
                        @endfor -->
                    </ul>
                    </template>
                    <!-- @endif -->
    
                </div>
                <SideContainer  class="hide"/>
               
                
            </div>
           
      </template>
      <script>
      import store from '../../store'
      import SideContainer from '../minicomponent/SideContainer.vue';
      import GameSummary from '../game/GameSummary.vue';
      export default {
          name:"TopsGame",
          components: {
            'SideContainer': SideContainer,
            GameSummary
           
        },created(){
            store.dispatch("getAllGames");
        },computed:{
            games(){
                return store.state.allGames.games;
            },isLoading(){
                return store.state.allGames.loading;
            }
        }
      }
      </script>
      <style scoped>
          
        .nk-breadcrumbs{
            font-family: "Montserrat", sans-serif;
            font-style: normal;
            font-weight: 700;
            padding: 0;
            margin: 0;
            color: #fff;
            text-transform: uppercase;
            list-style-type: none;
    
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
        width: 70%;
        min-height: 50vh;
        display: flex;
        flex-direction: column;
        gap: 25px;
        padding: 15px 15px;
        background-color: var(--post-color);
    }
    .tournsInfo .tournsList{
        
        width: 100%;
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
    .noTourn{
        width: 100%;
    }
    .noTourn h3{
        color: white;
        font-size: 30px;
        text-align: center;
    }
    .post ul{
    padding-top: 20px;
    font-size: 0.85em;
    list-style: none;
    flex-direction: column;
}
@media screen and (max-width: 600px) {
    .hide{
        display: none;
    }
    .tournsInfo{
        width: 100%;
    }
    .tournsInfo h1{
        font-size: 30px;
    }
    .nogame {
        font-size: 25px;
        color: white;
        width: 100%;
        text-align: center;
        font-weight: 700;
        
    }
}
      </style>