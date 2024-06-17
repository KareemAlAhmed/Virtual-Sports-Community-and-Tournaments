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

            background: #1f1f1f;
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
            box-shadow: 2px 2px 7px #121212;
            background: #121212 !important;
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
                    align-items: baseline;
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