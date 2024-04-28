<template>   

    <div class="mainPage">
      <router-view></router-view> 
    </div> 
  </template>
  <script>
  import store from '../../store'
  import Login from '../authentication/Login.vue'
  export default {
      name:"DefaultTournLayout",
  }
  </script>
  <style >
      
  </style>