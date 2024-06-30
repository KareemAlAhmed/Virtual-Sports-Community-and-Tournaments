<template>
     <div class="mainContainer" style="overflow-x: hidden;">
            <div class="centerContainer">
      
                <div class="post ">
                    <div class="imageAndOtherOpt">
                        <div v-if="!isGuest" class="userImage">
                            <router-link :to="/userProfile/+getUser.id "><img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+getUser.image_url" alt=""></router-link>                         
                        </div>

                        <div v-else class="userImage">
                            <img :src="'http://127.0.0.1:8000/storage/UserProfilePic/'+image_url" alt="">
                        </div>
                        <div class="otherOptions">
                            <ul>
                                <li> 
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
                                    <label for="image_url">Photos</label>                              
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/></svg>    
                                    <label>Audios</label>
                                </li>
                                <li>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>
                                    <label for="video_url"> Videos </label>
                                </li>
                                <li>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                    <label>Documents</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="textEntering">
                            <input type="file" name="image_url" @change="changePhoto"  id="image_url" style="display: none;"/>
                            <input type="file" name="video_url"  id="video_url" style="display: none;"/>
                            <!-- @php
                            $user= auth()->check() ? auth()->user()->name : 'Client';
                            @endphp -->
                            <textarea name="content" v-model="post.content" :placeholder="'What is on your mind ,'+fullName+ '?'"></textarea>
                    </div>

                    <div class="submiting" >
                        <div class="selectedImg" v-if="post.image_url != null">
                            <div class="wrapped">
                                <p>{{ post.image_url.name.replace(" ","") }}</p>
                                <div class="cancelImg" @click="post.image_url=null">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                                </div>
                            </div>
                        </div>
                       <div v-if="get_token" >
                            <button @click="onSubmit">Submit</button>          
                        </div>
                        <div v-else>
                            <router-link to="/register"><button>Signin</button></router-link>
                        </div>
                    </div>

                </div>
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
                        <template v-for="post in getPost" :key="post.id">
                            <Post :post='post' :user="post.user"></Post>
                        </template>
                    </template>
            </div>
            

            <SideContainer class="hideNav" />
           
           
        </div>
       
       
</template>
<script>




import SideContainer from "../minicomponent/SideContainer.vue"
import SidePost from "../minicomponent/SidePost.vue"
import Post from "../minicomponent/Post.vue"
import store from '../../store';

export default {
    name:"HomePage",
    components: {
    'SidePost': SidePost,
    'Post': Post,
    'SideContainer':SideContainer
    },mounted() {
        
        if(store.state.notification.show){
          if(store.state.notification.type ==="error"){
             store.dispatch("notifyError")
          }else{
             store.dispatch("notifySuccess")
          }
        }
     },
    data() {
    return {
      side1: {
        name: "LESSER YEARS THIRD IN YOU’RE RULE",
        image_url: 'post-41.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      side2: {
        name: "WE FOUND A WITCH! MAY WE BURN HER?",
        image_url: 'post-31-300x169.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      side3: {
        name: "CREEPETH YOU’RE A BEHOLD HEAVEN",
        image_url: 'post-51-300x188.jpg',
        created_at:"2024-02-26 11:37:43"
      },
      post:{
        content:"",
        image_url:null
      }
      
    };
  },computed:{
        fullName() {
            return store.state.user.token ? `${store.state.user.name[0].toLocaleUpperCase() +store.state.user.name.slice(1)}` :"Client";
        },
        get_token() {
            return store.state.user.token;
        },image_url() {
            return store.state.user.token ? `${store.state.user.data.image_url}` :"images.jpeg";
        },
        getPost(){
            return store.state.posts.data;
        },
        isLoading(){
            return store.state.posts.loading;
        },isGuest(){
                return store.state.user.id == null ? true : false;
        },getUser(){
            return store.state.user.token ? store.state.user.data : null;
        },isThereSuccess(){
                return store.state.notification.message;
            }
  },methods:{
        onSubmit(e){
                e.preventDefault();

                const formData = new FormData();
                    formData.append("image_url",this.post.image_url);
                    formData.append("content",this.post.content);
                    // formData.append("video_url",this.post.video_url);
                    formData.append("id",this.getUser.id);

                store.state.errorMessages={}
                
                store.dispatch("createPost",formData)
                this.post.content="" 
                this.post.image_url=null 
            },changePhoto(e){
                this.post.image_url=e.target.files[0];
            }
  },created(){
        store.dispatch("getPosts")
        store.dispatch("getCurrentUserSocial",sessionStorage.getItem("Id"))

        if(this.isThereSuccess != '' && (this.isThereSuccess.slice(0,7) == "Welcome" ||  this.isThereSuccess.slice(0,7) == "Logout")){
            store.dispatch("notifySuccess")
            setTimeout(()=>{
                store.state.notification.message=null;
            })
        }
    } 

}
</script>
<style >
       
  
    .centerContainer{
        width: 70%;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    


    .centerContainer .post {
        padding: 30px 25px 25px;
        display: flex;
        flex-direction: column;
        gap: 25px;
        width: 100%;
        background-color: var(--post-color);
    }
    .imageAndOtherOpt{
        display: flex;
        gap: 25px;
        align-items: center;
        color: white;
    }
    .userImage{
         width: 50px;
         height: 50px;
    }
    .userImage img{
        width: 100%;
        height: 100%;
        border-radius: 50px;
    }
    
    .otherOptions ul{
        list-style: none;
        display: flex;
        gap: 22px;
        font-weight: 600;
        font-size: 17px;
        cursor: pointer;
    }
    .otherOptions ul li{
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .otherOptions ul li svg{
        align-self: baseline;
        fill: white;
    }
    .textEntering{
        width: 100%;
        height: 85px;
    }
    .textEntering textarea{
        width: 100%;
        height: 100%;
        font-weight: 600;
        font-size: 17px;
        outline: none;
        resize: none;
        border: 0;
        padding: 5px
    }
    .textEntering textarea:hover{
        border: none;
    }
    .textEntering textarea:focus{
        border: none;
    }
    .textEntering form{
        height: 100%;
    }
    .submiting {
        display: flex;
        justify-content: flex-end;
        position: relative;
    }
    .submiting button{
        cursor: pointer;
        border: none;
        
        box-shadow: 2px 2px 7px var(--background-color);
        background: var(--background-color);
        color: white;
        width: 90px;
        transition: all 1s;
        height: 35px;
        font-weight: 600;
        font-size: 17px;
    }

    .content{
        width: 100%;
    }
    .content p{
        color: white;
        font-size: 21px;
        font-weight: 600;  
        margin-bottom: 10px;
    }
    .reactions{
        display: flex;
        justify-content: center;
    }

    .reactions button{
        cursor: pointer;
        border: none;
        
        box-shadow: 2px 2px 7px var(--background-color);
        background: var(--background-color);
        color: white;
        width: calc( 100% / 3 );
        transition: all 0.3s;
        height: 35px;
        font-weight: 600;
        font-size: 17px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }
    .reactions button:hover{
        background-color: var(--hover-color);
    }
    .reactions svg{
        fill: white;
        margin-bottom: 5px;
        transition: all 0.1s;
    }
    .responseContent{
        padding: 10px 10px;
        width: fit-content;
        display: flex;
        align-items: center;
        border-radius: 10px;
    }
    .responseMessage{
        position: sticky;
        bottom: 0;
        left: 0;
        background-color: transparent;
        color: white;
        width: 100%;
        height: 60px;

        font-size: 20px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        }
        .success{
            background-color: #4bb543;
            padding: 10px 25px 10px 25px;
        }
        .error{
            background-color: red;
            padding: 10px 25px 10px 25px;
        }
        .selectedImg{
            left: 0;
            position: absolute;
            color: white;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 100px;
            background-color: var(--back-color);
        }
        .cancelImg{
            position: absolute;
            right: -15px;
            top: -10px;
            width: 25px;
            height: 25px;
        }
        .cancelImg svg{
            width: 100%;
            height: 100%;
            fill: white;
            cursor: pointer;
        }
    label{
        cursor: pointer;
    }
    .hideNav{
        display: block;
    }
    @media screen and (max-width: 600px) {
        .hideNav{
            display: none;
        }
        .centerContainer{
            width: 100%;
        }
        .centerContainer .post {
            gap: 10px;
        }
        .userImage img{
            width: 50px;
        }   

        .otherOptions ul{
            gap: 25px;
            font-size: 20px;
        } 
        .otherOptions label{
            display: none;
        }
        .disabl_scrolling{
            height: 100%;
            overflow: hidden;
        }
        }
</style>