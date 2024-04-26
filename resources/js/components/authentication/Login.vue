<template lang="">
    <div class="flex-container">
            <div class="content-container">
                <div class="form-container">
                <form id="registerForm" @submit="submit">
                  
                    <h1>
                    Login
                    </h1>
                    <br>
                    <br>
                    <span class="subtitle">EMAIL:</span>
                    <br>
                    <input type="email" name="email" value=""  v-model="user.email" >
                    <br>
                    <span class="subtitle">PASSWORD:</span>
                    <br>
                    <input type="password" name="password" value="" v-model="user.password">
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
<script>
import store from '../../store';
export default {
    name:"Login",
    data(){
        return{
            user:{
                email:"",
                password:""
            }
        }
    },methods:{
        submit(e){
            e.preventDefault();
            store.dispatch("login",this.user)
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
</style>