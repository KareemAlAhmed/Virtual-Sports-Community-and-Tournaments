<template>
    <div class="followingReqList">
      <h1  class="noResults" v-if="getUser.followingRequestsToUser == null || getUser.followingRequestsToUser.length == 0">There is No Follow Requests.</h1>
      <UserCart v-for="user in getUser.followingRequestsToUser" :key="user.id" :user="user" type='request'/>
    </div>
  </template>
  
  <script>
  import store from '../../store';
  import UserCart from "../User/UserCart.vue"
  
  export default {
      name:"FollowReqPage",
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
  .followingReqList{
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