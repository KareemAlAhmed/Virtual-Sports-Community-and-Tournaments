<template>   
   <div class="post postCont">
        <div class="imageAndOtherOpt">
            <div class="userInfo">
                <router-link :to="/userProfile/+user.id ">
                <div class="userImage">
                    <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+user.image_url " alt="http://127.0.0.1:8000/storage/images.jpeg">
                </div>
                </router-link>
            
                <div class="otherOptions userName">
                
                    <router-link :to="/userProfile/+user.id ">   <p>{{user.name}}</p></router-link> <span>{{format_date(post.created_at)}}</span>
                
                </div>
            </div>
            <div class="ownerOpt">

            </div>
        </div>
   
        <div class="content">
            <p>{{post.content}}</p> 

                <img v-if="post.image_url != null" :src="'http://127.0.0.1:8000/storage/postImage/'+ post.image_url" style="width: 100%;">
      
        </div>
        <div class="postReactionsInfo">


            <div class="reactionaInfo">
                <p v-if="getPostLikes != 0">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.<path d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z"/></svg> -->
                    <svg class="liked logo" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"></path></svg>
                    <span>{{ getPostLikes}}</span>
                </p>
                <p v-if="getPostComments != 0">
                    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.<path d="M248 8C111.1 8 0 119.1 0 256s111.1 248 248 248 248-111.1 248-248S384.9 8 248 8zm114.6 226.4l-113 152.7-112.7-152.7c-8.7-11.9-19.1-50.4 13.6-72 28.1-18.1 54.6-4.2 68.5 11.9 15.9 17.9 46.6 16.9 61.7 0 13.9-16.1 40.4-30 68.1-11.9 32.9 21.6 22.6 60 13.8 72z"/></svg> -->
                    <svg class="comments logo" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" ><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>
                    <span>{{ getPostComments}}</span>
                </p>
            </div>
            <div class="reactions"> 
                <button :class="(reaction.isLiked == true && getUser.id !=null) || userLike  == true? 'liked like' : 'like'"  @click="getLikes(post.id,getUser.id,post.liked_users,isUserLiked)">
                    <svg :class="(reaction.isLiked == true && getUser.id !=null ) || userLike == true? 'liked' : null"  xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="logo"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M313.4 32.9c26 5.2 42.9 30.5 37.7 56.5l-2.3 11.4c-5.3 26.7-15.1 52.1-28.8 75.2H464c26.5 0 48 21.5 48 48c0 18.5-10.5 34.6-25.9 42.6C497 275.4 504 288.9 504 304c0 23.4-16.8 42.9-38.9 47.1c4.4 7.3 6.9 15.8 6.9 24.9c0 21.3-13.9 39.4-33.1 45.6c.7 3.3 1.1 6.8 1.1 10.4c0 26.5-21.5 48-48 48H294.5c-19 0-37.5-5.6-53.3-16.1l-38.5-25.7C176 420.4 160 390.4 160 358.3V320 272 247.1c0-29.2 13.3-56.7 36-75l7.4-5.9c26.5-21.2 44.6-51 51.2-84.2l2.3-11.4c5.2-26 30.5-42.9 56.5-37.7zM32 192H96c17.7 0 32 14.3 32 32V448c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V224c0-17.7 14.3-32 32-32z"/></svg>    
                    Like
                </button>
                <button class="comment" @click="displayComts(post.id)">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="logo"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4l0 0 0 0 0 0 0 0 .3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>    
                    Comment
                </button>
                <button class="share" @click="postLiked()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" class="logo"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M307 34.8c-11.5 5.1-19 16.6-19 29.2v64H176C78.8 128 0 206.8 0 304C0 417.3 81.5 467.9 100.2 478.1c2.5 1.4 5.3 1.9 8.1 1.9c10.9 0 19.7-8.9 19.7-19.7c0-7.5-4.3-14.4-9.8-19.5C108.8 431.9 96 414.4 96 384c0-53 43-96 96-96h96v64c0 12.6 7.4 24.1 19 29.2s25 3 34.4-5.4l160-144c6.7-6.1 10.6-14.7 10.6-23.8s-3.8-17.7-10.6-23.8l-160-144c-9.4-8.5-22.9-10.6-34.4-5.4z"/></svg>    
                    Share
                </button>
                
            </div>
        </div>
 
        <div class="commentBar">
            <router-link :to="/userProfile/+getUser.id " v-if="getUser.id != null">
                <div class="userImage">
                    <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+getUser.image_url " alt="http://127.0.0.1:8000/storage/images.jpeg">
                </div>
            </router-link>
                <div class="userImage" v-else>
                    <img  src="http://127.0.0.1:8000/storage/images.jpeg">
                </div>
            <input type="text" v-model="commentText" required  placeholder="Enter Your Comment..."/>
            <div class="submitDiv" @click="placeComment(getUser.id,post.id,commentText)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/></svg>
            </div>
        </div> 
        <teleport to="body">
            <!-- Content to be teleported -->
            <CommentList v-if="displayListCmts" @close="closeComments"  />
        </teleport>
        <!-- Other app content -->
        
    </div>
</template>
<script>
import moment from 'moment';
import store from '../../store';
import axios from 'axios';
import axiosClient from '../../axios';
import CommentBar from '../comment/CommentBar.vue';
import CommentList from "./CommentList.vue"
export default {
    name:"Post",
    props: ['post','user'],
    data(){
        
        return{
            reaction:{
                isLiked:false,
                isShared:false
            },userLike:false,
            postLikes:0,
            postComments:0,
            displayListCmts:false,
            likesSaved:false,
            likedUser:[],
            commentText:"",
            listCommts:[]
        }
        
        
    },
    components: {
        'CommentBar': CommentBar, 
        'CommentList': CommentList, 
    },
    methods: { 
      format_date(value){
         if (value) {
           return moment(String(value)).format('MMM DD,YYYY')
          }
      },postLiked(postId,userId,isLiked){

            if(userId != null){

                     if(!this.reaction.isLiked){
                        store.dispatch("likeAPost",{postId,userId})
                        this.reaction.isLiked= true;
                        this.postLikes+=1;

                    }else{
                        let situation='NotLiked'
                        store.dispatch("UnlikeAPost",{postId,userId})
                        this.reaction.isLiked= false;
                        this.postLikes-=1;               

                    }

                    
            }else{
                store.state.notification.message="You Should Be Authenticated To Like a Post!"
                store.dispatch("notifyError")
            }
      },userLiked(likes_list,id){
            let isLiked=false;
            for(let i=0;i<likes_list.length;i++){
                if(likes_list[i].user_id == id){
                    isLiked=true;
                    break;               
                }
            }
            return isLiked;
            
        },getLikes(postId,userId,listUsers,isLiked){
            this.postLiked(postId,userId,this.likedUser,isLiked)
        },placeComment(userId,postId,text){
            store.dispatch("placeComment",{userId,postId,text})
     
             this.postComments +=1 ;
            
            this.commentText="";
            
        },displayComts(postId){
            store.dispatch("getCurrentPostComments",postId)
            document.querySelector("body").classList.add("freeze")
            // this.listCommts=this.post.comments;
            // console.log(this.post.comments);
            this.displayListCmts=true;
        },closeComments(){
            this.displayListCmts = false;
            document.querySelector("body").classList.remove("freeze");
        }
   },computed: {
        getUser(){
            return store.state.user.data;        
        },getPostReaction(){
            return this.reaction;
        },isUserLiked(){
           return this.userLike;
        },getPostLikes(){
            return this.postLikes;
        },getPostComments(){
            return this.postComments;
        }
        ,getStatus(){
            return store.state.commentStatus;
        }
    },created(){
        // this.likesSaved=true;
        // this.postLikes=this.post.likes;
        this.reaction.isLiked=this.userLiked(this.post.likes,this.getUser.id)
        this.postLikes=this.post.likes.length;
        this.postComments=this.post.comments.length;
    }
}
</script>
<style >
     .sidePost{
        display: flex;
        gap: 17px;
        margin-bottom: 30px;
        cursor: pointer;
    }
    
    .sidePost img{
        width: 95px;
        height: 75px;
    }
    .postInfo{
        display: flex;
        flex-direction: column;
        justify-content: space-between
    }
    .sidePost p:first-child{
        font-size: 16px;
        color: white;
        font-weight: 800;
    }
    .sidePost:hover p:first-child{
        color: black;
    }
    .sidePost p:last-child{
        font-size: 16px;
        color: white;
    }
    .userName a{
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .userName p{
        font-size: 20px;
    }
    .userName p:hover{
        text-decoration: underline;
    }
    
    .userName span{
        font-size: 14px;
        color: #ffffff45;
    }
    .userInfo{
        display: flex;
        gap: 25px;
        align-items: center;
    }
    .liked{
        color:  red !important;
        fill:  red !important;
    }
    .shared{
        color:  yellow !important;
        fill:  yellow !important;
    }

    .postReactionsInfo{
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .postReactionsInfo p{
        color: white;
        font-weight: bold;
        display: flex;
        gap: 5px;
        margin-left: 10px;
    }
    .likeicon{
        height: 20px;
        width: 20px;
        fill: red;
        border: none;
        background-color: wheat;
        border-radius: 120px;
    }
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
.comments{
    fill: blue;
    color: blue;
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
.reactionaInfo{
    display: flex;
}
.freeze{
    overflow: hidden;
}
@media screen and (max-width: 600px) {
    .commentBar input{
        font-size: 16px;
    }
    .commentBar{
        gap: 5px;
    }
}
</style>