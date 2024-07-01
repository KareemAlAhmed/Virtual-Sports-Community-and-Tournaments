<template>
    <div class="user">
        <div class="photo">
            <router-link :to="/userProfile/+user.id ">
                <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+user.image_url" alt="">
            </router-link>
        </div>
        {{ console.log(userType) }}
        <template class="mobileV">
            <div class="info">
             <router-link :to="/userProfile/+user.id "><p class="userName">{{ user.name }}</p></router-link>
                <router-link :to="/userProfile/+user.id "><p class="userEmail">{{ user.email }}</p></router-link>
        </div>
        <div class="actions">
            <button v-if="userType.includes('notFollower') || getCreateRe" class="actBtn" @click="createFollowingReq(getUser.id,user.id)">
                <svg xmlns="http://www.w3.org/2000/svg" class="follow" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>

                <p>Follow</p>
            </button>
            <button v-if="userType.includes('requestFromUser') || cancelFollow" class="actBtn" @click="cancelFollowingRequest(getUser.id,user.id)">
                <svg class="mobileVersion" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                <p>Cancel Following</p>
            </button>
            <button v-if="userType.includes('followers') || removeFollow" class="actBtn" @click="unFollowing(user.id,getUser.id)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                <p>Remove</p>
            </button>
            <button v-if="userType.includes('followed')|| unfollow" class="actBtn" @click="unFollowing(getUser.id,user.id)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM471 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                <p>Unfollow</p>
            </button>
            <template v-if="userType.includes('requestToUser')" >
                <button class="acceptBtn" @click="acceptRequest(user.id,getUser.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                    <p>Accept</p>
                </button>
                <button class="denyBtn" @click="denyRequest(user.id,getUser.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L353.3 251.6C407.9 237 448 187.2 448 128C448 57.3 390.7 0 320 0C250.2 0 193.5 55.8 192 125.2L38.8 5.1zM264.3 304.3C170.5 309.4 96 387.2 96 482.3c0 16.4 13.3 29.7 29.7 29.7H514.3c3.9 0 7.6-.7 11-2.1l-261-205.6z"/></svg>
                    <p>Deny</p>
                </button>
            </template>
            <button v-if="!userType.includes('SameUser') &&  !userType.includes('requestToUser')" @click="goToChatRoom(user)">Message</button>
        </div>
        </template>
    </div>
</template>

<script>
import store from '../../store';
import router from "../../router";
export default {
    name:"UserCart",
    data(){
        return{
            userType:[],
            createFollow:false,
            cancelFollow:false,
            unfollow:false,
            accpetFollow:false,
            removeFollow:false,
            denyFollow:false,

        }
    },
    props:["user","type","totnb"],
    methods:{
        createFollowingReq(followerId,followedId){
            store.dispatch("createFollowingRequest",{followerId,followedId})
            this.userType ='requestFromUser'
            this.createFollow= false;
            this.cancelFollow=true;
            this.unfollow=false;

            this.accpetFollow=false;
            this.removeFollow=false;
            this.denyFollow=false;
        },
        removeFollowing(followerId,followedId){
            store.dispatch("cancelFollowingRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
            this.userType ='notFollower'
            this.createFollow=true;
            this.cancelFollow=false;
            this.unfollow=false;

            this.accpetFollow=false;
            this.removeFollow=false;
            this.denyFollow=false;
        },cancelFollowingRequest(followerId,followedId){
            store.dispatch("cancelFollowingRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
            this.userType ='notFollower'
            this.createFollow=true;
            this.cancelFollow=false;
            this.unfollow=false;

            this.accpetFollow=false;
            this.removeFollow=false;
            this.denyFollow=false;
        },
        unFollowing(followerId,followedId){
            store.dispatch("unfollow",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followerId)
            this.userType ='notFollower'

            this.createFollow=true;
            this.cancelFollow=false;
            this.unfollow=false;

            this.accpetFollow=false;
            this.removeFollow=false;
            this.denyFollow=false;
        },acceptRequest(followerId,followedId){
            store.dispatch("acceptFollowRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
            this.accpetFollow=false;
            this.userType ='followers'
            this.createFollow=false;
            this.cancelFollow=false;
            this.unfollow=false;

            this.removeFollow=true;
            this.denyFollow=false;
        },denyRequest(followerId,followedId){
            store.dispatch("denyFollowRequest",{followerId,followedId})
            store.dispatch("getCurrentUserSocial",followedId)
            this.denyFollow=false;
            this.userType ='notFollower'
            this.createFollow=true;
            this.cancelFollow=false;

            this.accpetFollow=false;
            this.removeFollow=false;
            this.unfollow=false;

        },typeOfUer(cartUserID,currentUser,test){

            // console.log(currentUser)

            // console.log()
            let found=false;
            let type=[]
            if(currentUser.followed != null){
                    currentUser.followed.forEach(element => {
                        console.log(element.id)
                        console.log(cartUserID)
                        if(element.id ==cartUserID){                           
                            found=true;
                            this.unfollow=true;

                            type.push("followed");
                        }
                });
            }
            if(currentUser.followers != null ){
                    currentUser.followers.forEach(element => {
                        if(element.id ==cartUserID){
                            found=true;
                            this.removeFollow=true,

                            type.push("followers");
                        }
                });
            }
            
            if(currentUser.followingRequestsToUser != null ){
                    currentUser.followingRequestsToUser.forEach(element => {
                        console.log(currentUser.followingRequestsToUser )
                        if(element.id ==cartUserID){
                            found=true;
                            type.push("requestToUser");

                        }
                });
            }
            if(currentUser.followingRequestsFromUser != null ){
                    currentUser.followingRequestsFromUser.forEach(element => {
                        if(element.id ==cartUserID){
                            found=true;
                            this.cancelFollow=true;

                            type.push("requestFromUser");

                        }
                });
            }
            
            if(cartUserID==this.getUser.id ){
                type.push("SameUser");

            }else if(!found){
                type.push("notFollower");

                this.createFollow=true;
            }
            return type;
        },goToChatRoom(user){
                    store.commit("setCurrrentMessagingUser",{id:user.id,name:user.name,image_url:user.image_url})
                    router.push("/messages/chatRoom/with/"+user.id)
                }
    },computed:{
        getUser(){
            return store.state.user;
        },getCreateRe(){
            return this.createFollow;
        }

    },created(){

        this.userType=this.type
        this.userType= this.typeOfUer(this.user.id,this.getUser,this.totnb)
    }
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
.mobileV{
    display: flex;
    flex: 1;
}
@media screen and (max-width: 600px) {
    .user{
        height: fit-content;
        gap: 5px;
    }
   .photo{
        width: 100px;
        height: 100px;
   }
   .user .photo a{
        width: 100%;
        height: 100%;
        display: block;
   }
   .user .photo img{
        width: 100%;
        height: 100%;
   }
   .mobileV{
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        width: calc(100% - 145px);
   }
   .user .info{
    width: fit-content;
    flex: 0;
    gap: 10px;
   }
   .user .info .userName{
    font-size: 19px;
    white-space: initial;
   }
   .user .info .userEmail{
    font-size: 14px;
    white-space: initial;
   }
   .user .actions{
    gap: 10px;
   }
   .user .actions button{
    min-width: 0px;
    padding: 10px 5px;
   }
}
</style>