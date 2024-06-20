<template>
  <div class="mainPage">
       <div class="mainContainer">
            <DashOpts />
            <div class="wrapped">
                <router-view></router-view>
            </div> 
       </div>
    </div> 
</template>

<script>
    import { computed } from 'vue'
    import store from '../../store'
    import Login from '../authentication/Login.vue'
    import DashOpts from "./DashboardOpts.vue"
    export default {
        name:"DashboardDefaultLayout",
            created(){

        }
        ,computed:{
            getUser(){
                return store.state.user;
            } 
        }  ,components:{
            DashOpts
        } 
        
        
    }
</script>

<style scoped>
    .wrapped{
        width: calc(85% - 5px);
        background-color: var(--post-color);;
        padding: 5px 0px;
    }
    @media screen and (max-width: 600px) {
   .mainContainer{
    max-width: 100%;
    flex-direction: column;
   }
   .wrapped{
    width: 100%;
   }
   
}
</style>