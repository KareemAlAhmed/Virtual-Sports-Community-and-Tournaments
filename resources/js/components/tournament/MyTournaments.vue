<template>   
    <div class="mainContainer">
            
            
            <div class="tournsInfo">
                <ul class="nk-breadcrumbs">
                    <li><a rel="v:url" href="/">Home</a></li>
                    <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>
                    <li><span><h1>My Tournaments</h1></span></li>
                </ul>
                 <div class="centerContainer">
                    
                    
                   <div class="joinedTourns">
                        <div class="joined">
                            <span><h1>Joined Tournaments</h1></span>
                        </div>
                        <div v-if="getTourns.joined.length == 0"  class="noTourn">
                            <h3>There is no  Joined Tournament.</h3>
                        </div>

                        <ul class="tournsList"  v-else>
                            
                            <SmallCard v-for="tournament in getTourns.joined" :key="tournament.id" :post="tournament" comptype="tournament"  />
    
                        </ul>
                    </div>

                    <div class="createdTourns">
                        <div class="created">
                            <span><h1>Created Tournaments</h1></span>
                        </div>
                     
                       
                            <div class="noTourn" v-if="getTourns.created.length == 0">
                                <h3>There is no  Created Tournament.</h3>
                            </div>

                       
                            <ul class="tournsList" v-else>
                                <SmallCard v-for="tournament in getTourns.created" :key="tournament.id" :post="tournament" comptype="tournament"  />
                            </ul>
                        
                    </div>
                </div>

            </div> 
            
            
            <SideContainer class="hide"/>
        </div>

</template>
<script>
import store from '../../store'
import moment from 'moment';
import SideContainer from '../minicomponent/SideContainer.vue';
import SmallCard from '../minicomponent/SmallCard.vue';


export default {
    name:"MyTournaments",
    components:{ 'SideContainer': SideContainer, SmallCard }
    ,created(){
        store.dispatch("getCurrentUserTournaments",this.getUserId) 
    }
    ,mounted(){
    }
    ,methods:{
    },computed:{
      getError(){
          return store.state.errorMessages;
      },getTourns(){
        console.log(store.state.currentUserTourns)
        return store.state.currentUserTourns;
      },getUserId(){    
        return store.state.user.id;
      }
    }
}
</script>
<style scoped>

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
@media screen and (max-width: 600px) {
    .hide{
        display: none;
    }
    .tournsInfo{
        width: 100%;
    }
    .tournsInfo h1{
        font-size: 25px;
    }
    .noTourn h3{
        font-size: 25px;
    }
    .centerContainer,.joinedTourns,.createdTourns{
        width: 100%;
    }
    .tournsInfo .tournsList{
        width: 100%;
    }
}
</style>