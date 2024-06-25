<template>
  <div class="commentBar">
        <router-link :to="/userProfile/+user.id ">
            <div class="userImage">
                <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+user.image_url " alt="http://127.0.0.1:8000/storage/images.jpeg">
            </div>
        </router-link>

        <input type="text" v-model="commentText" required  placeholder="Enter Your Comment..."/>

        <div class="submitDiv" @click="placeComment(user.id,postId,commentText)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
        </div>
  </div>
</template>

<script>
import store from '../../store'
export default {
    name:"CommentBar",
    data(){
        return{
            commentText:""
        }
    },
    props: ['user',"postId"],
    methods:{
        placeComment(userId,postId,text){
            store.dispatch("placeComment",{userId,postId,text});
            this.commentText=""
        }
    }
}
</script>

<style scoped>
    .commentBar{
        display: flex;
        gap: 10px;
    }
    .commentBar input{
        flex: 1;
        border-radius: 100px;
        border: none;
        font-size: 21px;
        padding: 0 10px;
        font-weight: 600;
    }
    .submitDiv{
        width: 50px;
        height: 50px;
        background-color: blue;
        border-radius: 100px;
        display: flex;
        align-content: center;
        justify-content: center;
        flex-wrap: wrap;
        cursor: pointer;
    }
    .submitDiv svg{
        height: 35px;
        width: 30px;
        fill: white;
    }
</style>