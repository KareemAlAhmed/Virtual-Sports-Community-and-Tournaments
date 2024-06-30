<template>
    <div class="wrapped">
      <div class="chatRoom">
       
       <div class="contactBar">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" @click="goToChatContacts"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
           <router-link :to="/userProfile/+getMessagingUser.id "><img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+getMessagingUser.image_url" alt=""></router-link>                            
           <div class="info">
               <router-link :to="/userProfile/+getMessagingUser.id "><p class="contactName">{{getMessagingUser.name}}</p></router-link>
               <p class="status">{{ typing }}</p>
             </div>
       </div>
       <div class="chats"  v-chat-scroll>

        <div v-if="!isLoading" class="loading">
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
           <template v-else>
              <div class="msg" v-for="t,index in text" :key="t" :class="users[index] !='You' ? 'otherP' : null">
                <p >{{ t }}</p>
                <small :class="colors[index]">{{users[index]}}  {{ times[index]}}</small>
            </div>
           </template>

       </div>
       <div class="sendMessage">
           <input type="text" v-model="content" required>
           <button class="submit" @click="add(getUser.id,getMessagingUser.id)">
               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM241 377c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l87-87-87-87c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L345 239c9.4 9.4 9.4 24.6 0 33.9L241 377z"/></svg>
           </button>
       </div>
 <!-- <UserCart v-for="user in getUser.followers" :key="user.id" :user="user" type='followers'/> -->
</div> 
    </div> 
    
  </template>
  
  <script>
  import store from '../../store';
  import UserCart from "../User/UserCart.vue"
  import router from '../../router'
  import {mapActions} from "vuex"
import axiosClient from '../../axios';
  export default {
      name:"ChatRoom",
      components:{UserCart},
      data(){
        return{
            text:[],
            users:[],
            colors:[],
            times:[],
            content:"",
            typing:"",
            messagerId:0,
            isLoading:false
        }
      },watch:{
          content(){
            Echo.private('chat')
                .whisper('typing', {  // broadcasting client event with
                    name: this.content,
                    senderId:parseInt(this.getUser.id),
                    receiverId:this.getMessagingUser.id
                })
          }
      },
      computed:{
          getUser(){
              return store.state.user;
          },getMessagingUser(){
            return store.state.currrentMessagingUser.data;
          },getMsg(){
            return store.state.currrentMessagingUser;
          }
      },methods:{
        add(id,receiverId){
            let message =this.content;
            store.dispatch("sendMessage",{id,message,receiverId,time:this.getTime()})
            this.text.push(this.content);
            this.users.push("You");
            this.colors.push("success");
            this.times.push(this.getTime());
            this.content=""
        },getTime(){
          let time= new Date();
          return time.toLocaleTimeString([], {hour: 'numeric', minute: 'numeric', hour12: true});
        },goToChatContacts(){
            // router.push("/messages/contacts")
            router.go(-1);
        },getMessages(currentId,receivId) {
          axiosClient.get("chats/between/"+currentId+"/"+receivId)
            .then(res=>{      

                let data=res.data.chat
                data.forEach(element => {
      
                  this.text.push(element.msg)
                  this.users.push(element.sender)
                  if(element.sender == "You"){

                    this.colors.push("success")
                  }else{
                    this.colors.push("warning");
                  }
                  this.times.push(element.time)
                });
                this.isLoading=true
                // this.commit("setCurrrentMessagingUserData",res.data)
                // return res.data
            })
            .catch(err=>{
                console.log(err)
            })
        }
      },mounted(){
            window.Echo.private('chat')
            .listen("Chat",(e)=>{
                if(e.user.id != this.getUser.id && e.receiver.id == this.getUser.id && e.user.id == this.getMessagingUser.id){
                this.text.push(e.message);
                this.users.push(e.user.name);
                this.colors.push("warning");
                this.times.push(this.getTime());               
                }
            })
            .listenForWhisper('typing', (e) => {
                if(e.name != '' && e.senderId ==this.getMessagingUser.id && e.receiverId == this.getUser.id ){
                  this.typing="Typing..."
                }else{
                  this.typing=""
                }
            }); 
            Echo.join(`chat`)
              .here((users) => {
                console.log(users);
              })
              .joining((user) => {
                  console.log(user.name);
              })
              .leaving((user) => {
                  console.log(user.name);
              })
              .error((error) => {
                  console.error(error);
              });

    },created(){
        const userId = this.$route.params.id;
        this.messagerId=userId;
        this.getMessages(this.getUser.id,this.getMessagingUser.id)
    }
  }
  </script>
  
  <style scoped>
  .chatRoom{
      width: 100%;
      /* height: 100%; */
      height: calc(100vh - 70px - 90px);
      display: flex;
      flex-direction: column;
      gap: 15px;
      padding: 15px;
  }
  .chats{
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  .msg{
    display: flex;
    flex-direction: column;
    width: fit-content;
    align-items: flex-end;
  }

  .msg p{
    font-size: 24px;
    width: fit-content;
    padding: 5px 15px 5px;
    color: white;
    background-color: var(--cart-color);
    border-radius: 5px;
  }
  .msg small{
    color: white;
    font-weight: 700;
    padding: 0 5px;
    border-radius: 5px;
  }
  .success{
    background-color: #2f82ff;
  }
  .warning{
    background-color: red;
  }
  .contactBar{
    display: flex;
    gap: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid white;
  }
  .contactBar img{
    width: 75px;
    height: 75px;
  }
  .contactBar svg{
    width: 50px;
    height: 100%;
    fill: white;
    cursor: pointer;
  }

  .contactName{
    color: white;
    font-size: 25px;
  }
.sendMessage{
    display: flex;
    font-size: 20px;
}
.sendMessage input{
    flex: 1;
    font-size: 20px;
    padding: 5px;
}
.sendMessage button{
    font-size: 20px;
    cursor: pointer;
}
.sendMessage button svg{
    width: 40px;
    height: 100%;
    fill: blue;
}
.otherP{
    align-self: flex-end;
}
.status{
  color: var(--toastify-spinner-color);
  font-size: 20px;
  margin-top: 5px;
}
@media screen and (max-width: 600px) {
  .contactBar{
    gap: 10px;
  }
  .contactBar svg{
    width: 35px;
  }
  .contactName{
    font-size: 21px;
  }

}
  </style>