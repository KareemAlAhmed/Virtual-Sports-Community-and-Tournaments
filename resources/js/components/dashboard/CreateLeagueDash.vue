<template>
    <div class="form-container-tournCr">
         
         
        <form  id="createTournForm" action="../api/league/user/{{auth()->user()->id}}" @submit="onSubmit">
                    <!-- @csrf -->
                        <h1>
                        Create League
                        </h1>
                        <br>
                        <div class="nameInpt">   
                            <span>Name:</span>
                            <input type="text" name="name" value="" required v-model="league.name">
                        </div>
                        <div>
                            <span>Description:</span>
                            <input type="text" name="description" value="" required v-model="league.description">
                        </div>
                        <div>
                            <span>Rewards:</span>
                            <input type="number" name="rewards" value="" required v-model="league.rewards">
                        </div>
                        <div>
                            <span>Requirements:</span>
                            <input type="text" name="requirements" value="" required v-model="league.requirements">
                        </div>
                        <div>
                            <span>Max Places:</span>
                            <input type="number" name="maxPlaces" value="" required v-model="league.maxPlaces">
                        </div>
                        <div>
                            <span>Sport Type:</span>
                            <select name="sportType" required v-model="league.sportType">
                                <option value="fortnite">Fortnite</option>
                                <option value="dota">Dota</option>
                                <option value="CS">Counter Strike</option>
                                <option value="LOL">League Of Legends</option>
                                <option value="PUBG">PUBG</option>
                                <option value="apex">Apex Legend</option>
                                <option value="football">Football</option>
                                <option value="Overwatch">Overwatch</option>
                                <option value="fifa">FIFA 24</option>

                            </select>
                        </div>
                        <div>
                            <span>Start Date:</span>
                            <input type="date" name="startDate" value="" required v-model="league.startDate">
                        </div>
                        <div>
                            <span>End Date:</span>
                            <input type="date" name="endDate" value="" required v-model="league.endDate">
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
  </template>
  
  <script>
  import store from '../../store';
  import router from '../../router';
  import moment from 'moment';
  export default {
      name:"CreateLeagueDash",
      
      data(){
            return{
                league:{
                    name:"",
                    description:"",
                    rewards:"",
                    requirements:"",
                    maxPlaces:"",
                    sportType:"",
                    startDate:"",
                    endDate:"",
                },error:""
            }  
        },methods:{
          onSubmit(e){

            
            e.preventDefault();
            store.state.errorMessages={}
            const date1 = moment(this.league.startDate);
            const date2 = moment(this.league.endDate);
            if (date1.isAfter(date2)) {
                store.state.errorMessages["date"]=["The Start Date is after the End Date!"]
            } else {
                store.dispatch("createLeague",this.league)            
                this.league.name=""
                this.league.description=""
                this.league.rewards=""
                this.league.requirements=""
                this.league.maxPlaces=""
                this.league.sportType=""
                this.league.startDate=""
                this.league.endDate=""
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
    height: 100%;
    /* margin-top: 5px; */
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
    color: #1f1f1f;
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
    box-shadow: 2px 2px 7px #121212;
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