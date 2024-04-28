<template>   

    <div class="mainPage">
      <router-view></router-view> 
    </div> 
  </template>
  <script>
import { computed } from 'vue'
  import store from '../../store'
  import Login from '../authentication/Login.vue'
  export default {
      name:"LeagueDefaultLayout",
      created(){

    }
    ,computed:{
      getUser(){
        return store.state.user;
      }
    }   
    
      
  }
  </script>
  <style >
      
  </style>