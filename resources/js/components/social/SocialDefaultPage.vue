<template>
    <div class="mainPage">
        <div class="mainContainer">
            <SocialOptions />
            <div class="wrapped">
                <router-view></router-view>
            </div> 
       </div>
    </div> 
</template>

<script>
    import { computed } from 'vue'
    import store from '../../store'
    import SocialOptions from './SocialOptions.vue';
    export default {
        name:"SocialDefaultPage",
        computed:{
            getUser(){
                return store.state.user;
            } 
        },components:{SocialOptions}        
    }
</script>

<style scoped>
    .wrapped{
        width: calc(85% - 5px);
        background-color: var(--post-color);;
        padding: 5px 0px;
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