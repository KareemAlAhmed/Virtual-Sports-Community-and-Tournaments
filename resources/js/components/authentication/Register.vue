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
                        <input type="file" name="image_url" value="" style="margin-top: 3px;">
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
 <script setup>
import router from '../../router.js';
import store from '../../store.js';

    const user={
        name:'',
        email:'',
        password:'',
        bio:'',
        image_url:''
    }
    function register(ev){
        ev.preventDefault();
        store.dispatch('register',user)
        
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
 </style>