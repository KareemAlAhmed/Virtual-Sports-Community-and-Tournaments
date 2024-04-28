<template>   
    <div class="mainContainer">
            
            
            <div class="tournsInfo">
                <ul class="nk-breadcrumbs">
                    <li><a rel="v:url" href="/">Home</a></li>
                    <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>
                    <li><span><h1>My Leagues</h1></span></li>
                </ul>
                <div class="centerContainer">
                    
                    
                   <div class="joinedTourns">
                        <div class="joined">
                            <span><h1>Joined Leagues</h1></span>
                        </div>
                        <div v-if="getLeagues.joined.length == 0"  class="noTourn">
                            <h3>There is no  Joined Leagues.</h3>
                        </div>

                        <ul class="tournsList"  v-else>
                            
                            <SmallCard v-for="league in getLeagues.joined" :key="league.id" :post="league" comptype="league"  />
                            <!-- @for( $i = 0; $i<count($joinedLeague);$i++)
                                <x-smallCardPost  :data='$joinedLeague[$i]' nojoined='false' compType='league' ></x-smallCardPost>
                            @endfor -->
                        </ul>
                    </div>

                    <div class="createdTourns">
                        <div class="created">
                            <span><h1>Created Leagues</h1></span>
                        </div>
                     
                       
                            <div class="noTourn" v-if="getLeagues.created.length == 0">
                                <h3>There is no  Created Leagues.</h3>
                            </div>

                       
                            <ul class="tournsList" v-else>
                                <!-- <p v-for="league in getLeagues.created" :key="league.id">{{ league.name }}</p> -->
                                <SmallCard v-for="league in getLeagues.created" :key="league.id" :post="league" comptype="league"  />
                                <!-- @for( $i = 0; $i<count($created);$i++)
                                    <x-smallCardPost  :data='$created[$i]' nojoined='false' compType='league'></x-smallCardPost>
                                @endfor -->
                            </ul>
                        
                    </div>
                </div>

            </div>
            
            
            <SideContainer />
        </div>

</template>
<script>
import store from '../../store'
import moment from 'moment';
import SideContainer from '../minicomponent/SideContainer.vue';
import SmallCard from '../minicomponent/SmallCard.vue';


export default {
    name:"MyLeagues",
   data(){
        
        return{
              
        }  
    },components:{ 'SideContainer': SideContainer, SmallCard }
    ,created(){
        store.dispatch("getCurrentUserLeagues",this.getUserId)
        
    }
    ,mounted(){
        console.log(this.getLeagues)
        
    }
    ,methods:{
     
    },computed:{
      getError(){
          return store.state.errorMessages;
      },getLeagues(){
        return store.state.currentUserLeagues;
      },getUserId(){    
        return store.state.user.id;
      }
    }
}
</script>
<style >

.tournsInfo{
    width: 70%;
    min-height: 50vh;
    display: flex;
    gap: 25px;
    color: white;
    flex-direction: column;
    background-color: var(--post-color);
    padding: 15px;
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
    width: 35%;
    height: fit-content;
    padding: 20px 23px ;
    background-color: var(--background-color);
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
    background-color: var(--background-color);
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

.centerContainer,.joinedTourns,.createdTourns{
    width: 730px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.centerContainer{
    width: 70%;
}
.joined ,.created {
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 15px;
    gap: 10px;
    height: fit-content;
    width: 100%;
    align-items: flex-start;
}
.joined::after,.created::after{
    
    width: 100%;
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(23px);
    margin-bottom: -3px;
}
.noTourn{
    width: 100%;
}
.noTourn h3{
    color: white;
    font-size: 28px;
    text-align: center;
}
</style>