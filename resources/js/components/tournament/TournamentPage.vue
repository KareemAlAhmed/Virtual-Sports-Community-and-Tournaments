<template>   

<div class="mainContainer">
            <ul class="nk-breadcrumbs">
                <li><a rel="v:url" href="/">Home</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                <li><a rel="v:url" href="../tournament/tops">Tournaments</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>          
                <li><span><h1>{{$tourn['name']}}</h1></span></li>
            </ul>
                            
            <div class="tournsInfo">
                <div class="centerContainer">
                    <li id="post-762" class="post" x-data="{click: false}">
                        <ul class="cyberpress-tournament-info">
                            <li>
                                <strong>Dates</strong>: {{date('F  j, Y', strtotime($tourn['startDate']))}}  -   {{date('F  j, Y', strtotime($tourn['endDate']))}}  
                            </li>
                            <li>
                                <strong>Game</strong>: <img width="200" height="200" src="<?php echo asset("storage/gamesLogo/" . $tourn['sportType'].".png" )?>" class="attachment-medium size-medium" alt="" loading="lazy"> 
                                    {{$tourn['sportType']}}                
                            </li>
                            <li>
                                <strong>Organizer</strong>: {{$organizerName}}  
                            </li>
                            <li>
                                <strong>Type</strong>: {{$tourn['type']}}  
                            </li>
                            <li>
                                <strong>Total Prize pool</strong>: {{$tourn['rewards']}}$            
                            </li>
                            <li>
                                <strong>Places</strong>: {{$tourn['takesPlaces']}}/{{$tourn['maxPlaces']}}            
                            </li>
                        </ul>  
                        @auth
                            <form method="post" style="display: none;" id="userAdd{{$tourn['id']}}" action="../api/enroll/user/{{auth()->user()->id}}/tournament/{{$tourn['id']}}">
                                @csrf                       
                            </form>
                        @endauth
                    </li><!-- #post-## -->
    
                    <p style="margin-bottom: 1.5rem;padding: 0 20px;">{{$tourn['description']}}</p>  
    
                    <div class="actions">
                        @if($userOrg)
                            <form method="post" action="../api/tournament/{{$tourn['id']}}/createGames" style="display: flex;justify-content: flex-end;">
                                @csrf
                                <input type="submit" name="submit" class="sbt" value="Generate Matches">
                            </form>
                        

                            <form method="post" action="../api/tournament/delete/{{$tourn['id']}}" style="display: flex;justify-content: flex-end;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="submit" class="sbt" value="DELETE">
                            </form>
                            <form method="get" action="../api/tournament/{{$tourn['id']}}/edit" style="display: flex;justify-content: flex-end;">
                                @csrf
                                <input type="submit" name="submit" class="sbt" value="EDIT">
                            </form>
                        @else
                            @can('admin')
                                <form method="post" action="../api/tournament/{{$tourn['id']}}/createGames" style="display: flex;justify-content: flex-end;">
                                    @csrf
                                    <input type="submit" name="submit" class="sbt" value="Generate Matches">
                                </form>
                            

                                <form method="post" action="../api/tournament/delete/{{$tourn['id']}}" style="display: flex;justify-content: flex-end;">
                                    <!-- @csrf -->
                                    @method('DELETE')
                                    <input type="submit" name="submit" class="sbt" value="DELETE">
                                </form>
                                <form method="get" action="../api/tournament/{{$tourn['id']}}/edit" style="display: flex;justify-content: flex-end;">
                                    @csrf
                                    <input type="submit" name="submit" class="sbt" value="EDIT">
                                </form>
                            @endcan
                        @endif
                        @auth
                            <form method="post" action="../api/enroll/user/{{auth()->user()->id}}/tournament/{{$tourn['id']}}" style="display: flex;justify-content: flex-end;">
                                @csrf
                                <input type="submit" name="submit" class="sbt" value="JOIN">
                            </form>
                        @endauth
                        @guest
                            <a href="../register" class="sign">Signin</a>
                        @endguest
                    </div>


                    <div class="userNames">
                        <div class="memberNames"><span><h1>Tournament Members</h1></span></div>
                        <table class="tg">
                            <thead>
                                <tr>
                                    <td class="tg-0lax">Id<br></td>
                                    <td class="tg-0lax">Username<br></td>
                                    <td class="tg-0lax">Email<br></td>
                                    @if(auth()->user()?->can('admin') || $tourn['organizer_id'] == auth()->user()?->id)
                                    <td class="tg-0lax">Actions<br></td>    
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                    @if(count($tournMembers) > 0)
                                    @foreach($tournMembers as $member)
                                        <tr>
                                            <td class="tg-0lax">{{$member['id']}}<br></td>
                                            <td class="tg-0lax">{{$member['name']}}<br></td>
                                            <td class="tg-0lax">{{$member['email']}}<br></td>
                                            

                                            @if(auth()->user()?->can('admin') || $tourn['organizer_id'] == auth()->user()?->id)
                                            <td class="tg-0lax">
                                             <form method="post" action="../api/kick/user/{{$member['id']}}/tournament/{{$tourn['id']}}">
                                                @csrf   
                                                @method('DELETE')
                                                <button >
                                                    <svg class="del" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                                </button> 
                                                
                                               <!-- <button > 
                                                <svg class="edt" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><!-- <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                                </button> -->
                                             </form>
                                            </td>   
                                            @endif

                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="noresult">There is No Member Participated Yet.</td>
                                        </tr>
                                    @endif
                            </tbody>
                        </table>
                    </div>


                    <div class="tournGames">
                        <div class="gamesHead"><span><h1>Games</h1></span></div>
                        <div class="gamesList">


                        <!-- @if(count($tournGames) > 0)        
                            @for($i = 0; $i<count($tournGames);$i++)
                                <x-gameSummary :tournGame='$tournGames[$i]' :leagueGame="null"></x-gameSummary>
                            @endfor
                        @else
                            <p class="nogame">There Is No Game Yet.</p>
                        @endif -->

                        </div>

                    </div>
                </div>

                <SideContainer />
            </div>
        
            
        </div>
      
        
  </template>
  <script>
  import store from '../../store'
  import Login from '../authentication/Login.vue'
import SideContainer from '../minicomponent/SideContainer.vue'
  import NavBar from "./NavBar.vue"
  export default {
      name:"DefaultLayout",
      components: {
      'NavBar': NavBar,
          Login,
            SideContainer
      },data(){
          return{
            posts:{}
          }  
      }
  }
  </script>
  <style >
      
  </style>