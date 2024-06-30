<template>
    <div class="SocialOpts">
        <router-link :class=" currentOpt.follower === true ? 'selected' : null " to="/social/followers">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z"/></svg>
            <p>Followers</p>
        </router-link>
        <router-link :class=" currentOpt.following === true ? 'selected' : null " to="/social/following">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM609.3 512H471.4c5.4-9.4 8.6-20.3 8.6-32v-8c0-60.7-27.1-115.2-69.8-151.8c2.4-.1 4.7-.2 7.1-.2h61.4C567.8 320 640 392.2 640 481.3c0 17-13.8 30.7-30.7 30.7zM432 256c-31 0-59-12.6-79.3-32.9C372.4 196.5 384 163.6 384 128c0-26.8-6.6-52.1-18.3-74.3C384.3 40.1 407.2 32 432 32c61.9 0 112 50.1 112 112s-50.1 112-112 112z"/></svg>
            <p>Following</p>
        </router-link>
        <router-link :class=" currentOpt.followingRequests === true ? 'selected' : null" to="/social/followingRequests">
            <svg xmlns="http://www.w3.org/2000/svg" class="follow" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
            <p>Requests</p>
        </router-link>
        <router-link :class=" currentOpt.findUser === true ? 'selected' : 'search' " to="/social/search">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>            
            <p>Find User</p>
        </router-link>
    </div>
</template>

<script>
    import { computed } from 'vue'
    import store from '../../store'
    import 'primeicons/primeicons.css'
    export default {
        name:"SocialOptions",        
        computed:{
            getUser(){
                return store.state.user;
            },currentOpt(){
                return store.state.currentSocialOpt;
            }
        }         
    }
</script>

<style scoped>
    .SocialOpts{
        color: white;
        display: flex;
        flex-direction: column;
        font-size: 22px;
        background-color: var(--post-color);;
        height: fit-content;
        width: 16%;
    }
    .SocialOpts a {
        padding: 10px 15px;
        cursor: pointer;
        display: flex;
        align-items: flex-start;
        font-size: 25px;
        gap: 5px;
        font-weight: 600;
    }
    .SocialOpts svg{
        width: 25px;
        height: 25px;
        fill: white;
    }
    .search svg{
        height: 26px;
        width: 20px;
        fill: white;
    }
    .SocialOpts a:hover{
        background-color: var(--hover-color);
    }
    .selected{
        background-color: var(--hover-color);
    }
    @media screen and (max-width: 600px) {
        .SocialOpts{
            width: 100%;
        }  
    }

</style>