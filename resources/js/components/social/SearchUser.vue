<template>
    <div class="followerList">
        <div class="searchUser">
          <svg @click="getFocus" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>            
            <input type="text" v-model="searchText" id="search" @change="getResultsData(searchText)" placeholder="Enter The Name Of The User...">
        </div>
        <template v-if="!isStarted && didFirstSearch">
          <h1  class="noResults" v-if="(getResults.data.length == 0) && isLoading==false">User Not Found.</h1>
          <UserCart v-for="user in getResults.data" :key="user.id" :user="user" type='none' :totnb="getUser.length" />
        </template>

        <div v-if="isStarted" class="loading">
          <p>
            Loading
          </p>
          <div class="col-3">
            <div class="snippet" data-title="dot-pulse">
              <div class="stage">
                <div class="dot-pulse"></div>
              </div>
            </div>
          </div>             
        </div>


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
            didFirstSearch:false
        }
      },
      components:{UserCart},
      computed:{
          getUser(){
              return store.state.user;
          },getResults(){
            return store.state.currentSearch
          },isLoaded(){
            return this.isLoading;
          },isStarted(){
            return this.searchStart;
          },didFirstS(){
            return this.didFirstSearch;
          }
      },
      created(){
            store.commit("setCurrentSearch",{data:[],loading:false})        
      },methods:{
        getResultsData(text){
            this.didFirstSearch=true;
            this.searchStart=true;
            this.isLoading=true;
            store.dispatch("searchUser",text)
            this.isLoading=false;
            this.searchStart=false;
        },getFocus(){
            document.querySelector("#search").focus()
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
  .searchUser{
    background-color: #999999;
    display: flex;
    gap: 5px;
    border-radius: 50px;
  }
  .searchUser input{
    flex: 1;
    font-size: 18px;
    font-weight: 700;
    padding-left: 5px;
  }
  .searchUser svg{
    fill: white;
    width: 50px;
    height: 50px;
    padding: 5px 5px 5px 10px;
    cursor: pointer;
  }
  @media screen and (max-width: 600px) {
    .noResults{

      font-size: 36px;

    }
  }
  </style>