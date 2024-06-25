<template>
  <div class="followerList">
    <h1  class="noResults" v-if="getUser.followers.length == 0">There is No Followers.</h1>
    <UserCart v-for="user in getUser.followers" :key="user.id" :user="user" type='followers'/>
  </div>
</template>

<script>
import store from '../../store';
import UserCart from "../User/UserCart.vue"

export default {
    name:"FollowerPage",
    components:{UserCart},
    computed:{
        getUser(){
            return store.state.user;
        }
    },
    created(){
        store.dispatch("getCurrentUserSocial",this.getUser.id)
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