<template>
  <div class="comment" :class="'nb'+comments.id+'-'+comments.post_id" @click="display3dot = true" @mouseenter="display3dot = true" @mouseleave="display3dot =false;commentOpt=false">
        <div class="userAndCommentInfo">
            <router-link :to="/userProfile/+comments.user.id">
                <div class="userImage">
                    <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/' +comments.user.image_url" alt="http://127.0.0.1:8000/storage/images.jpeg">
                </div>
            </router-link>


            <div class="commentInfo" style="width: calc(100% - 65px);">
                <div class="username">
                    
                    <p>{{comments.user.name }}</p>
                </div>
                <div class="content">
                    <div class="editComm" v-if="editMode">
                        <input type="text" v-model="commentText" required>
                        <div class="commentAction">
                            <button @click="updateComment(comments.id,comments.post_id)">Update</button>
                            <button @click="editMode=false">Cancel</button>
                        </div>
                    </div>
                    <p v-else>{{ comments.text }}</p>
                </div>
            </div>
        </div>
        <div class="ownerOpt" style="position: relative;" v-if=" getUser!=null && comments.user.id == getUser.id  && display3dot">
                <button  class="threeDot" @click="displayMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                </button>
                <div class="postOptions" v-if="commentOpt">
                    <button @click="editComment(comments.id)">Edit Comment</button>
                    <button @click="deleteComment(comments.id,comments.post_id)">Delete Comment</button>
                </div>
            </div>
            
  </div>
</template>

<script>
import store from '../../store';
export default {
    name:"CommentCard",
    props: ['comments'],
    computed:{
        getUser(){
            return store.state.user.token ? store.state.user.data : null;
        }
    },data(){
        return{
            display3dot:false,
            commentOpt:false,
            commentText:"",
            editMode:false
        }
    },methods:{
        deleteComment(commentId,postId){
            store.dispatch("deleteComment",{commentId,postId});
            this.commentOpt= !this.commentOpt
        },editComment(post){
        //     let inp=document.createElement("input");
            this.commentOpt= !this.commentOpt
        //     let nb=".nb"+this.comments.id+"-"+this.comments.post_id;
        //     let commentBar=document.querySelector( nb + " .content")
        //     let text=commentBar.querySelector("p");

        //    text.remove()
        //    inp.value=this.comments.text
        //     commentBar.appendChild(inp);
        this.editMode=true;
            // store.commit("setCurrentPostData",post);
            // router.push('/post/'+post.id+'/edit');
        },updateComment(id,postId){
            let text=this.commentText
            store.dispatch("editComment",{id,text,postId})
            this.editMode=false;
        },displayMenu(){
            console.log(this.commentOpt)
            this.commentOpt= !this.commentOpt
        }
    },created(){
        this.commentText=this.comments.text;
    }
    
}
</script>

<style scoped>
.comment{
    color: white;
    display: flex;
    align-items: center;
    gap: 15px;
    justify-content: space-between;
    cursor: pointer;
    transition: all 0.3s ease;
    padding: 20px ;
    width: 100%;
}
.comment:hover{
    background-color: var(--hover-color);
}
.comment p{color: white;white-space: normal; /* Ensure wrapping */
    word-wrap: break-word;}
.comment a{
    align-self: flex-start;
    
}
.userAndCommentInfo{
    color: white;
    display: flex;
    gap: 15px;
    width: 95%;
}
.postOptions{
    width: 125px;
    height: fit-content;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    position: absolute;
    left: -125px;
}
.postOptions button{
    color: white;
    background-color: var(--background-color);
    border: none;
    padding: 10px 15px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}
.postOptions button:hover{
    background-color: var(--back-color);
}
.editComm{
    display: flex;
    gap: 10px;
    margin-top: 5px;
}
.editComm input{
    flex: 1;
    font-weight: 700;
    font-size: 15px;
}
.editComm button{
    cursor: pointer;
    border: none;
    box-shadow: 2px 2px 7px var(--background-color);
    background: var(--background-color);
    color: white;
    width: 75px;
    transition: all 1s;
    height: 30px;
    font-weight: 600;
    font-size: 17px;
}
.commentAction{
    display: flex;
    gap: 10px;
}
@media screen and (max-width: 600px) {
  .comment{
    padding: 20px 10px;
    gap:0px;
  }
  .editComm{
    flex-direction: column;
  }
  .editComm input{
    font-size: 17px;
    padding: 2px 2px;
  }
}
</style>