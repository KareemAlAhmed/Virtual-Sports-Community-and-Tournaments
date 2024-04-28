<template>   
  
  <li id="post-762" class="post" x-data="{click: false}">
    <h2 class="cyberpress-tournament-title">
        <template v-if="comptype == 'league'">
            <a  href="#" @click="getLeague($event,this.getUserId,post.id)">{{post.name}}  </a>
        </template>
        
        <template v-else>
            <RouterLink :to="'/tournaments/'+post.id">{{post.name}}  </RouterLink>
        </template>
    
        <!-- @if($nojoined !='false') -->
        <svg  @click="addingUser(getUserId,post.id)" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path :class="'tourn'+post.id" d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
        <!-- @endif -->
    </h2>

    <ul class="cyberpress-tournament-info">
        <li>
            <strong>Dates</strong>: {{format_date(post.startDate)}}  -   {{format_date(post.endDate)}}  
        </li>
        <li>
            <strong>Game</strong>: <a href="#" class="cyberpress-game-inline-link"><img width="200" height="200" :src="'http://127.0.0.1:8000/storage/gamesLogo/'+post.sportType+'.png'"  class="attachment-medium size-medium" alt="" loading="lazy"> 
                {{post.sportType}}</a>                
            </li>
        <li>
            <strong>Total Prize pool</strong>: {{post.rewards}}$                
        </li>
    </ul>             
   <!-- @auth
                @if($compType == 'league')
                <form method="post" style="display: none;" id="userAdd{{$data['id']}}" action="../api/enroll/user/{{auth()->user()->id}}/league/{{$data['id']}}">
                        @csrf
                    
                </form>
                @else
                <form method="post" style="display: none;" id="userAdd{{$data['id']}}" action="../api/enroll/user/{{auth()->user()->id}}/tournament/{{$data['id']}}">
                        @csrf
                    
                </form>
                @endif
    @endauth -->
  </li>
</template>

<script>
  import { RouterLink } from 'vue-router';
import store from '../../store'
    import SidePost from './SidePost.vue';
    import moment from 'moment';
  export default {
    name:"SideContainer",
    components: {
    'SidePost': SidePost,
    RouterLink
},
    props:['post',"comptype"], 
    methods: { 
      format_date(value){
         if (value) {
           return moment(String(value)).format('MMM DD,YYYY')
          }
      },getTourn(e,id){
          e.preventDefault();
          store.dispatch("getCurrentTourn",id)
      },getLeague(e,userId,leagueId){
          e.preventDefault();
          store.dispatch("getCurrentLeague",leagueId)
          store.dispatch("isJoinedLeague",{userId,leagueId})
      },addingUser(userId,leagueId){
      store.dispatch("joinLeague",{userId,leagueId})
    }
      
   },
    data() {
    return {
      side1: {
        name: "LESSER YEARS THIRD IN YOU’RE RULE",
        image_url: 'post-41.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      side2: {
        name: "WE FOUND A WITCH! MAY WE BURN HER?",
        image_url: 'post-31-300x169.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      side3: {
        name: "CREEPETH YOU’RE A BEHOLD HEAVEN",
        image_url: 'post-51-300x188.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      user:{
        id:1,
        name:"Kareem",
        userPic:"images.jpeg"
      }
      
    };
  },computed:{
      getUserId(){    
        return store.state.user.id;
      }
    }
  }
</script>
<style scoped>
 .post {
    width: 355px;
    height: fit-content;
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
    padding-top: 20px;
    font-size: 0.85em;
    display: flex;
    list-style: none;
    flex-direction: column;
    display: flex; 
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
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
ul li img{
        width: 1em;
        height: 1em;
    }
    ul ul li:nth-child(2){
        display: flex;
        gap: 5px;
    }
    ul ul li:nth-child(2) a{
        display: flex;
        gap: 3px;
    }
</style>
