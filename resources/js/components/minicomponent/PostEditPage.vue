<template>   

    <div class="mainContainer">
            
            <div class="form-container-tournCr">
                        <form  id="createTournForm" @submit="onSubmit">
                        <!-- @csrf -->
                            <h1>
                            Edit Post
                            </h1>
                            <br>
                            {{  synchroData(getPostInfo) }}
                            <div class="nameInpt">   
                                <span>Content:</span>
                                <input type="text" name="content"  required v-model="post.content">
                            </div>

                            <div class="imageInp">
                                <span class="subtitle">Photo:</span>
                                <div class="fileInfo">
                                   
                                    <input type="file" name="image_url" @change="changePhoto"  style="margin-top: 3px;">
                                    <img v-if="getPostInfo.image_url != null" :src="'http://127.0.0.1:8000/storage/postImage/'+(post.image_url == null ? getPostInfo.image_url : post.image_url)" width="100px" height="100px">
                                </div>
                            </div>
                            <div class="imageInp">
                                <span class="subtitle">Video:</span>
                                <div class="fileInfo">
                                    <input type="file" name="video_url" @change="changePhoto()" style="margin-top: 3px;">
                                    <img v-if="getPostInfo.video_url != null" :src="'http://127.0.0.1:8000/storage/postImage/'+post.video_url == null ? getPostInfo.video_url: post.video_url" width="100px" height="100px">
                                </div>
                            </div>
                                
                            <div class="errors">
                                <template v-if="JSON.stringify(getError) !== '{}'" >
                                    <p v-for="error in getError" :key="error">****{{ error[0] }}</p>
                                </template>
                                
    
    
                            </div> 
    
                            <input type="submit" value="SUBMIT" class="submitTourn" style="margin-left: 50%;transform: translateX(-50%);">
                        </form>
                    <!-- @endif -->
                    </div>
                   
            
            </div>
      </template>
      <script>
      import axiosClient from '../../axios';
import store from '../../store'
      import moment from 'moment';
      
      
      export default {
          name:"EditPost",
            data(){
              return{
                    post:{
                        content:"",
                        image_url:null,
                        video_url:null,
                        id:0
                    },error:""
              }  
          },methods:{
            onSubmit(e){
                e.preventDefault();

                const formData = new FormData();
                    formData.append("image_url",this.post.image_url);
                    formData.append("content",this.post.content);
                    formData.append("video_url",this.post.video_url);
                    formData.append("id",this.post.id);

                store.state.errorMessages={}
                
                store.dispatch("editPost",formData)
                
            },changePhoto(e){
                this.post.image_url=e.target.files[0];
            },synchroData(postData){
                this.post.content=postData.content
                this.post.image_url=postData.image_url
                this.post.video_url=postData.video_url
            }
          },computed:{
            getError(){
                return store.state.errorMessages;
            },getPostInfo(){
                return store.state.currentPost.data;
            },getCurrentPostToEdit(){
                return store.state.postToEditId;
            }
            },created(){
                if(this.getCurrentPostToEdit != null && !this.getPostInfo.loading ){
                    store.dispatch("getPost",this.getCurrentPostToEdit)
                }
            }
      }
      </script>
      <style scoped>
          .mainContainer{
        width: 50%;
        min-height: 80vh;
        margin: 45px 25%;
        background-color: var(--post-color);
        border-radius: 12px;
    }
     .mainContainer h1{
        color: white;
        text-align: center;
        font-size: 35px;
        font-weight: 800;
     }
    
     .form-container-tournCr {
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 100%;
        /* margin-top: 5px; */
        padding: 20px;
        border-radius: 12px;
        background: var(--hover-color);
        box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.199);
    }
    .form-container-tournCr span{
        font-size: 22px;
        color: white;
        font-weight: 700;
        width: 160px;
    }
    .form-container-tournCr input {
        border: none;
        border: solid rgb(143, 143, 143) 1px;
        background-color: white ;
        color: var(--hover-color);
        height: 35px;
        width: 300px;
        padding-left: 5px;
        font-size: 18px;
        font-weight: 600;
    }
    .form-container-tournCr .nameInpt,.form-container-tournCr .imageInp{
        display: flex;
        margin-bottom: 25px;
    }
    .form-container-tournCr .submitTourn {
        cursor: pointer;
        border: none;
        border-radius: 8px;
        box-shadow: 2px 2px 7px var(--background-color);
        transition: all 1s;
    }
    
    .form-container-tournCr .submitTourn:hover {
        color: white;
        background-color: var(--background-color);
        box-shadow: none;
    }
    select{
        width: 300px;
        height: 35px;
        font-size: 18px;
        font-weight: 600;
    }
    .errorslist{
        display: flex;
        margin-bottom: 25px;
        flex-direction: column;
        color: red;
        gap: 5px;
    }
    
    .errors{
        background-color: transparent;
        color: red;
        font-weight: bold;
        display: flex;
        margin-bottom: 25px;
        flex-direction: column;
        align-items: center;
    }
    input#file-upload-button{
        display: none;
    }
    .fileInfo{
        
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    @media screen and (max-width: 600px) {
        body {
            overflow-y: hidden;
        }
        .mainContainer{
            margin: 50px 10px;
            width: calc(100% - 20px);

        }
       .form-container-tournCr {
        width: 100%;
       }
       .form-container-tournCr h1{
        font-size: 32px;
       }
       .form-container-tournCr div{
        flex-direction: column;
       }
       .form-container-tournCr input{
        width: 100%;
       }

    }
      </style>