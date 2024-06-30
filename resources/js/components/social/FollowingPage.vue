<template>
    <div class="followedLIst">
        <h1  class="noResults" v-if="getUser.followed == null || getUser.followed.length == 0">You Are Not Following Any User.</h1>
        <UserCart v-for="user in getUser.followed" :key="user.id" :user="user" type='followed'/>
    </div>
  </template>
  
  <script>
  import store from '../../store';
  import UserCart from "../User/UserCart.vue"
  
  export default {
      name:"FollowingPage",
      components:{UserCart},
      computed:{
          getUser(){
              return store.state.user;
          }
      },
      created(){
        //   store.dispatch("getCurrentUserSocial",this.getUser.id)
      }  
  }
  </script>
  
  <style scoped>
  .followedLIst{
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      gap: 15px;
      padding: 20px;
  }
  .noResults{
    color: white;
    font-size: 40px;
    text-align: center;
  }
  @media screen and (max-width: 600px) {
    .noResults{

      font-size: 32px;

    }
  }
  </style>