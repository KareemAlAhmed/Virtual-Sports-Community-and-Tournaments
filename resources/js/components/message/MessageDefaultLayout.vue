<template>
    <div class="mainPage">
        <div class="mainContainer">
            <router-view></router-view>         
       </div>
    </div> 
</template>

<script>
    import { computed } from 'vue'
    import store from '../../store'
    import MessageContact from "./RecentContact.vue"
    export default {
        name:"MessageDefaultPage",
        computed:{
            getUser(){
                return store.state.user;
            } 
        },components:{MessageContact} ,   
    }
</script>

<style scoped>
    .mainContainer{
        /* height: calc(100vh - 70px - 90px); */
        min-height: 100%;
        justify-content: center
    }
    .wrapped{
        width: calc(85% - 5px);
        background-color: var(--post-color);;
        padding: 5px 0px;
        max-height: 100%;
    }
    .stopScroll{
        height: 100%;
    }
    @media screen and (max-width: 600px) {
        .mainContainer{
                max-width: 100%;
                flex-direction: column;
        }
        .wrapped{
                width: 100%;
        } 
    }
</style>