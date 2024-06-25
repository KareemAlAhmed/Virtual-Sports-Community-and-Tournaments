<template>
  <div class="form-container-tournCr">      
       <form  id="createTournForm">
           <h1>Create Tournament</h1><br>

           <div class="nameInpt">   
               <span>Name:</span>
               <input type="text" name="name" value="" required v-model="tourn.name">
           </div>
           <div>
               <span>Description:</span>
               <input type="text" name="description" value="" required v-model="tourn.description">
           </div>
           <div>
               <span>Rewards:</span>
               <input type="number" name="rewards" value="" required v-model="tourn.rewards">
           </div>
           <div>
               <span>Requirements:</span>
               <input type="text" name="requirements" value="" required v-model="tourn.requirements">
           </div>
           <div>
               <span>Max Places:</span>
               <input type="number" name="maxPlaces" value="" required v-model="tourn.maxPlaces">
           </div>
           <div>
               <span>Sport Type:</span>
               <select name="sportType" required v-model="tourn.sportType">
                    <option v-if="tourn.type != 'knockout'" value="fortnite">Fortnite</option>
                    <option value="dota">Dota</option>
                    <option value="CS">Counter Strike</option>
                    <option value="LOL">League Of Legends</option>
                    <option  v-if="tourn.type != 'knockout'" value="PUBG">PUBG</option>
                    <option v-if="tourn.type != 'knockout'" value="apex">Apex Legend</option>
                    <option value="football">Football</option>
                    <option value="Overwatch">Overwatch</option>
                    <option value="fifa">FIFA 24</option>
               </select>
           </div>
           <div>
               <span>Type:</span>
               <select name="type" v-model="tourn.type"> 
                    <option value="Friendly">Friendly</option>
                    <option value="bypoints">By Points</option>
                    <option value="knockout">Knock out</option>
               </select>
           </div>
           <div>
               <span>Start Date:</span>
               <input type="datetime-local" name="startDate" value="" required v-model="tourn.startDate">
           </div>
           <div>
               <span>End Date:</span>
               <input type="datetime-local" name="endDate" value="" required v-model="tourn.endDate">
           </div>
           <div class="errors">
               <template v-if="JSON.stringify(getError) !== '{}'" >
                   <p v-for="error in getError" :key="error">****{{ error[0] }}</p>
               </template>
            </div> 

           <input type="submit" value="SUBMIT" @click="onSubmit" class="submitTourn" style="margin-left: 50%;transform: translateX(-50%);">
        </form>
   </div>
</template>

<script>
    import store from '../../store';
    import router from '../../router';
    import moment from 'moment';
    export default {
        name:"CreateTournDash",      
        data(){
            return{
                tourn:{
                    name:"",
                    description:"",
                    rewards:"",
                    requirements:"",
                    maxPlaces:"",
                    sportType:"",
                    startDate:"",
                    endDate:"",
                    type:"",
                },error:""
            }  
        },methods:{
            onSubmit(e){
                e.preventDefault();
                console.log("hello")
                store.state.errorMessages={}
                const date1 = moment(this.tourn.startDate);
                const date2 = moment(this.tourn.endDate);
                if (date1.isAfter(date2)) {
                    store.state.errorMessages["date"]=["The Start Date is after the End Date!"]
                } else {
                    store.dispatch("createTourn",this.tourn)                  
                    this.tourn.name=""
                    this.tourn.description=""
                    this.tourn.rewards=""
                    this.tourn.requirements=""
                    this.tourn.maxPlaces=""
                    this.tourn.sportType=""
                    this.tourn.startDate=""
                    this.tourn.endDate=""
                    this.tourn.type=""
                    this.error=""
                }
            }
        },computed:{
            getError(){
                return store.state.errorMessages;
            }
        }

    }
</script>

<style scoped>
    .form-container-tournCr h1{
        color: white;
        text-align: center;
        font-size: 45px;
        font-weight: 800;
    }

    .form-container-tournCr {
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 100%;
        padding: 20px;
        border-radius: 12px;
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
    .form-container-tournCr div{
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
    @media screen and (max-width: 600px) {
        .form-container-tournCr form{
            width: 100%;
        }
        .form-container-tournCr h1{
            font-size: 32px;
        }
        .form-container-tournCr div{
            flex-direction: column;
        }
        .form-container-tournCr input,.form-container-tournCr select{
            width: 100%;
        }
    }
</style>