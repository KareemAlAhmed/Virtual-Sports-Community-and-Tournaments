<template>   
    <div class="flex-container">
        
            <div class="content-container">
                <div class="form-container">
                    <form  id="registerForm" enctype="multipart/form-data" @submit="register">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <h1>
                        Register
                        </h1>
                        <br>
                        <br>
                        <span class="subtitle">NAME:</span>
                        <br>
                        <input type="text" name="name" value="" v-model="user.name">
                      
                        <br>
                        <span class="subtitle">EMAIL:</span>
                        <br>
                        <input type="email" name="email" value="" v-model="user.email">
                        <br>
                        <span class="subtitle">PASSWORD:</span>
                        <br>
                        <input type="password" name="password" value="" v-model="user.password">
                        <br>
                        <span class="subtitle">BIO:</span>
                        <br>
                        <input type="text" name="bio" value="" v-model="user.bio">
                        <br>
                        <span class="subtitle">PHOTO:</span>
                        <br>
                        <input type="file" name="image_url" @change="changePhoto" style="margin-top: 3px;">
                        <br>
                        <br>
                        <input type="submit" value="SUBMIT" class="submit-btn" style="margin-left: 50%;transform: translateX(-50%);">
                    </form>
                    <div class="errors">


                  </div> 
                </div>
            </div>
        </div>
 </template>
 <script >
import router from '../../router.js';
import store from '../../store.js';
export default {
    name:"Login",
    data(){
        return{
            user:{
                name:'',
                email:'',
                password:'',
                bio:'',
                image_url:''
            }
        }
    },methods:{
        register(ev){
            ev.preventDefault();
            const formData = new FormData();
            formData.append("image_url",this.user.image_url);
            formData.append("name",this.user.name);
            formData.append("email",this.user.email);
            formData.append("password",this.user.password);
            formData.append("bio",this.user.bio);
            store.dispatch('register',formData)
        },changePhoto(e){
                this.user.image_url=e.target.files[0];
            }
    }
}

    
 
 </script>
 <style scoped>
.errors{
    background-color: transparent;
    color: red;
    font-weight: bold;
    display: flex;
    margin-bottom: 25px;
    flex-direction: column;
    align-items: center;
}
.form-container {
            display: flex;
            justify-content: center;
            align-items: center;

            width: 500px;
            height: auto;

            margin-top: 5px;
            padding-top: 20px;

            border-radius: 12px;

            display: flex;
            justify-content: center;
            flex-direction: column;

            background: var(--hover-color);
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.199);
            }

            .subtitle {
            font-size: 11px;

            color: rgba(177, 177, 177, 0.3);
            }

            .flex-container input {
            border: none;
            border-bottom: solid rgb(143, 143, 143) 1px;
            margin-bottom: 30px;
            background: none ;
            background-color: transparent ;
            color: rgba(255, 255, 255, 0.555);
            height: 35px;
            width: 300px;
            }
            input:-internal-autofill-selected{
                background-color: transparent !important;
            }
            .submit-btn {
                cursor: pointer;
            border: none !important;
            border-radius: 8px;
            box-shadow: 2px 2px 7px var(--background-color);
            background: var(--background-color) !important;
            color: rgba(255, 255, 255, 0.8) !important;
            width: 90px !important;
            transition: all 1s;
            }

            .submit-btn:hover {
            color: rgb(255, 255, 255);

            box-shadow: none;
            }
            .flex-container {
            width: 100vw;

            margin-top: 60px;
            margin-bottom: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            }

            .content-container {
            width: 500px;
            height: auto;
            }
            .content-container   h1 {
            color: white;
            text-align: center;
            font-size: 35px;
            font-weight: 800;
            }
            @media screen and (max-width: 600px) {
                .flex-container{
                    margin-left: 20px;
                    margin-right: 20px;
                    margin-top: 0;
                    margin-bottom: 0;
                    width: auto;
                }
            
                .flex-container h1{
                    font-size: 35px;
                    font-weight: 800;
                    color: white;font-size: 35px;
                    font-weight: 800;
                    text-decoration: none;
                }
                .form-container{
                    width: 100%;
                    margin-top: 50px;
                }

            }
 </style>