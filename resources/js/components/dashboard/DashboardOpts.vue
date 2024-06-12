<template>
    <div class="Opts">
        <router-link :class=" currentOpt.users === true ? 'dashboardLink selected' : null " to="/dashboard/users">Users</router-link>
        <router-link :class=" currentOpt.tourns === true ? 'dashboardLink selected' : null " to="/dashboard/tourns">Tournaments</router-link>
        <router-link :class=" currentOpt.leagues === true ? 'dashboardLink selected' : null " to="/dashboard/leagues">Leagues</router-link>
        <router-link :class=" currentOpt.games === true ? 'dashboardLink selected' : null " to="/dashboard/games">Games</router-link>
        <router-link :class=" currentOpt.createTourn === true ? 'dashboardLink selected' : null " to="/dashboard/createTourn">Create Tournament</router-link>
        <router-link :class=" currentOpt.createLeague === true ? 'dashboardLink selected' : null " to="/dashboard/createLeague">Create League</router-link>
    </div>
</template>

<script>
import { computed } from 'vue'
    import store from '../../store'
    import Login from '../authentication/Login.vue'
    import 'primeicons/primeicons.css'
    export default {
        name:"DashOpts",
            created(){

        }
        ,computed:{
            getUser(){
                return store.state.user;
            },currentOpt(){
                return store.state.currentDash;
            }
        }  
        
        
    }
</script>

<style scoped>
    .Opts{
        color: white;
        display: flex;
        flex-direction: column;
        font-size: 22px;
        background-color: #191919;
        height: fit-content;
        width: 15%;
    }
    .Opts a {
        padding: 10px 15px;
        cursor: pointer;
    }
    .Opts a:hover{
        background-color: #1f1f1f;
    }
    .selected{
        background-color: #1f1f1f;
    }

</style>