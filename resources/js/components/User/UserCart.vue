<template>
    <div class="user">
        <div class="photo">
            <router-link :to="/userProfile/+user.id ">
                <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+user.image_url" alt="">
            </router-link>
        </div>
        <div class="info">

             <router-link :to="/userProfile/+user.id "><p class="userName">{{ user.name }}</p></router-link>
                <router-link :to="/userProfile/+user.id "><p class="userEmail">{{ user.email }}</p></router-link>
        </div>
        <div class="actions">
            <button v-if="type == 'followers'" class="actBtn" @click="cancelFollowing(user.id,getUser.id)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                <p>Remove</p>
            </button>
            <button v-if="type == 'followed'" class="actBtn" @click="unFollowing(getUser.id,user.id)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                <p>Unfollow</p>
            </button>
            <template v-if="type == 'request'">
                <button class="acceptBtn" @click="acceptRequest(user.id,getUser.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                    <p>Accept</p>
                </button>
                <button class="denyBtn" @click="denyRequest(user.id,getUser.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L353.3 251.6C407.9 237 448 187.2 448 128C448 57.3 390.7 0 320 0C250.2 0 193.5 55.8 192 125.2L38.8 5.1zM264.3 304.3C170.5 309.4 96 387.2 96 482.3c0 16.4 13.3 29.7 29.7 29.7H514.3c3.9 0 7.6-.7 11-2.1l-261-205.6z"/></svg>
                    <p>Deny</p>
                </button>
            </template>
            <button v-else >Message</button>
        </div>
    </div>
</template>

<script>
import store from '../../store';

export default {
    name:"UserCart",
    props:["user","type"],
    methods:{
        removeFollowing(followerId,followedId){
            store.dispatch("cancelFollowingRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
        },
        unFollowing(followerId,followedId){
            store.dispatch("cancelFollowingRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followerId)
        },acceptRequest(followerId,followedId){
            store.dispatch("acceptFollowRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
        },denyRequest(followerId,followedId){
            store.dispatch("denyFollowRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
        }
    },computed:{
        getUser(){
            return store.state.user;
        }
    },
}
</script>

<style scoped>
.user{
    display: flex;
    gap: 15px;
    height: 200px;
    cursor: pointer;
}
.user .info{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    gap: 20px;
    width: 250px;
    flex: 1;
}
.user .photo img{
    width: 200px;
    height: 200px;
}

.user .info .userName{
    font-size: 35px;

}
.user .info .userEmail{
    font-size: 28px;
    font-weight: 700;
}
.user .actions{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}
.user .actions button{
    margin-left: -5px;
    border: none;
    padding: 15px;
    min-width: 115px;
    background-color: var(--background-color);
    color: white;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
}
.user .actions button:hover{
    background-color: var(--back-color);
}
.actBtn{
    display: flex;
    gap: 5px;
    align-items: baseline;
}
.actBtn svg{
    fill: white;
    height: 13px;
}
.acceptBtn,.denyBtn{
    display: flex;
    gap: 5px;
    font-size: 18px !important;
}
.acceptBtn svg,.denyBtn svg{
    fill: white;
    height: 20px;
    width: 17px;
}
.acceptBtn{
    background-color: #1a67f6  !important;
}
.denyBtn{
    background-color: red !important;
}
</style>