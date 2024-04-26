<template>   

  <div class="mainPage">
    <NavBar/>
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
    },mounted() {
      
      // this.posts=store.state.posts
    },created(){
      store.dispatch("getPosts")
      store.dispatch("getTourns")
      store.dispatch("getLeagues")
      store.dispatch("getGames")
      if(store.state.user.token){
        store.dispatch("getCurrentUser",store.state.user.name)
      }
    }
}
</script>
<style >
    
</style>