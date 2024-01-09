@props(['tourn','foredit'])
@if(request()->session()->has('error'))

                    @auth   
                        @php

                        $errors=array(json_decode(session('error')[0]->original['errors']));
                        $error=$errors[0];
                        @dd($error)
                        @endphp
             
             
             @endauth
            @endif

<style>
.mainContainer{
    width: 50%;
    min-height: 80vh;
    margin: 45px 25%;
    background-color: #191919;
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
    margin-top: 5px;
    padding: 20px;
    border-radius: 12px;
    background: #1f1f1f;
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
    background-color: #121212;
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
</style>
<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
        
                <div class="form-container-tournCr">
                @if($foredit)
                    <form  method="POST" id="createLeagueForm" action="../api/tournament/{{$tourn['id']}}/edit">
                    @csrf
                    @method('PUT')
                        <h1>
                        Create Tournament
                        </h1>
                        <br>
                        <div class="nameInpt">   
                            <span>Name:</span>
                            <input type="text" name="name" value="{{$tourn['name']}}" @readonly(auth()->user()== 'Kareem')>
                        </div>
                        <div>
                            <span>Description:</span>
                            <input type="text" name="description" value="{{$tourn['description']}}">
                        </div>
                        <div>
                            <span>Rewards:</span>
                            <input type="text" name="rewards" value="{{$tourn['rewards']}}">
                        </div>
                        <div>
                            <span>Requirements:</span>
                            <input type="text" name="requirements" value="{{$tourn['requirements']}}">
                        </div>
                        <div>
                            <span>Max Places:</span>
                            <input type="number" name="maxPlaces" value="{{$tourn['maxPlaces']}}">
                        </div>
                        <div>
                            <span>Sport Type:</span>
                            <input type="text" name="sportType" value="{{$tourn['sportType']}}">
                        </div>
                        <div>
                            <span>Type:</span>
                            <select name="type">
                                <option value="Friendly">Friendly</option>
                                <option value="Ranked">Ranked</option>
                            </select>
                        </div>
                        <div>
                            <span>Start Date:</span>
                            <input type="date" name="startDate" value="{{$tourn['startDate']}}">
                        </div>
                        <div>
                            <span>End Date:</span>
                            <input type="date" name="endDate" value="{{$tourn['endDate']}}">
                        </div>
                        <div>
                            <span>Duration:</span>
                            <input type="time" name="duration" value="{{$tourn['duration']}}">
                        </div>
                        <div>
                            <span>Time Left:</span>
                            <input type="time" name="timeLeft" value="{{$tourn['timeLeft']}}">
                        </div>     
                        @if(request()->session()->has('error'))  
                            <div class="errorslist">
                            
                            </div>
                        @endif


                        <input type="submit" value="UPDATE" class="submitTourn" style="margin-left: 50%;transform: translateX(-50%);">
                    </form>
                @else
                    <form  method="POST" id="createLeagueForm" action="../api/tournament/user/{{auth()->user()->id}}">
                    @csrf
                        <h1>
                        Create Tournament
                        </h1>
                        <br>
                        <div class="nameInpt">   
                            <span>Name:</span>
                            <input type="text" name="name" value="" @readonly(auth()->user()== 'Kareem')>
                        </div>
                        <div>
                            <span>Description:</span>
                            <input type="text" name="description" value="">
                        </div>
                        <div>
                            <span>Rewards:</span>
                            <input type="text" name="rewards" value="">
                        </div>
                        <div>
                            <span>Requirements:</span>
                            <input type="text" name="requirements" value="">
                        </div>
                        <div>
                            <span>Max Places:</span>
                            <input type="number" name="maxPlaces" value="">
                        </div>
                        <div>
                            <span>Sport Type:</span>
                            <select name="sportType">
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
                            <span>Type:</span>
                            <select name="type">
                                <option value="Friendly">Friendly</option>
                                <option value="Ranked">Ranked</option>
                            </select>
                        </div>
                        <div>
                            <span>Start Date:</span>
                            <input type="date" name="startDate" value="">
                        </div>
                        <div>
                            <span>End Date:</span>
                            <input type="date" name="endDate" value="">
                        </div>
                        <div>
                            <span>Duration:</span>
                            <input type="time" name="duration" value="">
                        </div>
                        <div>
                            <span>Time Left:</span>
                            <input type="time" name="timeLeft" value="">
                        </div>     
                        @if(request()->session()->has('error'))
                            <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                                <p   class="responseContent error">{{session('error')[0]->original['errors']}}</p> 
                                @php
                                    session()->forget('error');
                                @endphp
                            </div>
                        @endif


                        <input type="submit" value="SUBMIT" class="submitTourn" style="margin-left: 50%;transform: translateX(-50%);">
                    </form>
                @endif
                </div>
               
        
        </div>
        
    </x-slot>
</x-baselayout>