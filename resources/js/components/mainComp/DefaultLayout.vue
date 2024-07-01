<template>   

  <div class="mainPage">
    <NavBar  />
    <router-view></router-view> 
  </div> 
</template>
<script>
import store from '../../store'
import Login from '../authentication/Login.vue'
import NavBar from "./NavBar.vue"


export default {
    name:"DefaultLayout",
    components: {
    'NavBar': NavBar,
        Login
    },data(){
        return{
          posts:{}
        }  
    },created(){
      store.dispatch("getAllTourns")
      store.dispatch("getAllGames")
      if(store.state.user.token){
        store.dispatch("getCurrentUser",store.state.user.id)     
     }    
    },computed:{
            getUser(){
                return store.state.user;
            }
      },mounted(){
        window.Echo.private('social')
        .listen("FollowRequest",(e)=>{

          if(this.getUser.id == e.receiver.id){
            store.commit("updateUserSocialOneByOne",{type:'requestToUser',user:e.sender})
          }
          if(this.getUser.id == e.sender.id){
            store.commit("updateUserSocialOneByOne",{type:'requestFromUser',user:e.sender,receiver:e.receiver})
          }
        })
        .listen("AccepetFollowRequest",(e)=>{
          console.log(e)
          if(this.getUser.id == e.receiver.id){
            store.commit("updateUserSocialOneByOne",{type:'acceptReq',user:e.sender})
          }
          if(this.getUser.id == e.sender.id){
            store.commit("updateUserSocialOneByOne",{type:'sendedReqAccepted',user:e.sender,receiver:e.receiver})
          }
        })
        .listen("DenyFollowRequest",(e)=>{
          console.log(e)
          if(this.getUser.id == e.receiver.id){
            store.commit("updateUserSocialOneByOne",{type:'denyReq',user:e.sender})
          }
          if(this.getUser.id == e.sender.id){
            store.commit("updateUserSocialOneByOne",{type:'sendedReqDenied',user:e.sender,receiver:e.receiver})
          }
        })
        .listen("CancelFollowRequest",(e)=>{
          if(this.getUser.id == e.receiver.id){
            store.commit("updateUserSocialOneByOne",{type:'requestToUserCancel',user:e.sender})
          }
          if(this.getUser.id == e.sender.id){
            store.commit("updateUserSocialOneByOne",{type:'requestFromUserCancel',user:e.sender,receiver:e.receiver})
          }
        })
        .listen("UnFollow",(e)=>{
          if(this.getUser.id == e.receiver.id){
            store.commit("updateUserSocialOneByOne",{type:'unfollowReceiver',user:e.sender})
          }
          if(this.getUser.id == e.sender.id){
            store.commit("updateUserSocialOneByOne",{type:'unfollowSender',user:e.sender,receiver:e.receiver})
          }
        })
    }
}
</script>
<style scoped>
  @media screen and (max-width: 600px) {
    .mainPage{
      overflow-x: hidden;
      overflow-y: hidden;
    }
  }
</style> 
    
