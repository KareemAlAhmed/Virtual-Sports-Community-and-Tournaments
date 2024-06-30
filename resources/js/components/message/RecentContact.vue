<template>
    <div class="contactOpts">
        <Contact v-for="contact in getUser.contacts" :key="contact.id" :user="contact" />
       
    </div>
</template>

<script>
    import { computed } from 'vue'
    import store from '../../store'
    import 'primeicons/primeicons.css'
    import Contact from "./Contact.vue"
    
    export default {
        name:"MessageContact",   
        components:{Contact},
        computed:{
            getUser(){
                return store.state.user;
            }
        }
    }
</script>

<style scoped>
    .contactOpts{
        color: white;
        width: 50%;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 20px;
        background-color: var(--post-color);
        font-size: 22px;
    }
    .contactOpts a {
        cursor: pointer;
        display: flex;
        font-size: 25px;
        gap: 5px;
        font-weight: 600;
    }

    .selected{
        background-color: var(--hover-color);
    }
    @media screen and (max-width: 600px) {
        .contactOpts{
            width: 100%;
        }  
    }

</style>