<template>
    {{ console.log(user) }}
    <div  :class="'contact nb'+user[0] " @click="goToChatRoom($event,user)">
            <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+user[3]" alt="">                          
            <div class="info">
                <p>{{user[2]}}</p> 
                <p v-if="typing ==''" class="lastMsg">{{ user[1] }}</p>         
                <p v-else class="status">{{typing}}</p>          
            </div>
    </div>
</template>

<script>
    import { computed } from 'vue'
    import store from '../../store'
    import router from '../../router'
export default {
    name:"Contact",
    props:["user"],
    data(){
        return{
            typing:""
        }
    },computed:{
        getUser(){
            return store.state.user;
        }
    },methods:{
        goToChatRoom($event,user){
            document.querySelector(".nb"+user[0]).classList.add("selected")
            store.commit("setCurrrentMessagingUser",{id:user[0],name:user[2],image_url:user[3]})
            router.push("/messages/chatRoom/with/"+user[0])
        }
    },mounted(){
        window.Echo.private('chat').listenForWhisper('typing', (e) => {
            console.log(e.receiverId == this.getUser.id)
            if(e.name != '' && e.senderId ==this.user[0] && e.receiverId == this.getUser.id){
              this.typing="Typing..."
            }else{
              this.typing=""
            }
            // console.log(e)
        }); 
    }
}
</script>

<style scoped>
    .contact{
        display: flex;
        padding: 15px;
        gap:10px;
        cursor: pointer;
    }
    .contact:hover{
        background-color: var(--hover-color);
    }
    .contact p{
        height: fit-content;
        font-size: 32px;
    }
    .contact img{
        width: 75px;
        height: 75px;
    }
    .status{
        color: var(--toastify-spinner-color);
        font-size: 20px;
        margin-top: 5px;
    }
    .lastMsg{
        font-size: 24px !important;
    }
    .info{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    @media screen and (max-width: 600px) {
        .info p{
            font-size: 22px ;
        }
        .lastMsg{
            font-size: 21px !important;
        }
    }
</style>