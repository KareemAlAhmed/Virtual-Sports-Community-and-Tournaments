<template>
    <div class="followerList">
        <div class="searchUser">
            <input type="text" v-model="searchText" @change="getResultsData(searchText)">
        </div>
        <h1  class="noResults" v-if="(getResults.data.length == 0) && searchStart==true">User Not Found.</h1>
        {{ console.log(getResults.data.length) }}
        <UserCart v-for="user in getResults.data" :key="user.id" :user="user" type='followers'/>
    </div>
  </template>
  
  <script>
  import store from '../../store';
  import UserCart from "../User/UserCart.vue"
  
  export default {
      name:"SearchUser",
      data(){
        return{
            searchText:"",
            isLoading:false,
            searchStart:false,
        }
      },
      components:{UserCart},
      computed:{
          getUser(){
              return store.state.user;
          },getResults(){
            return store.state.currentSearch
          }
      },
      created(){
            store.commit("setCurrentSearch",{data:[],loading:false})
        
          store.dispatch("getCurrentUserSocial",this.getUser.id)
      },methods:{
        getResultsData(text){
            this.searchStart=true;
            this.isLoading=true;
            console.log(text)
            store.dispatch("searchUser",text)
            this.isLoading=false;
        }
      }
  }
  </script>
  
  <style scoped>
  .followerList{
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
  </style>