<?php session_start(); ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kamkom</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="//unpkg.com/alpinejs" defer></script>
        <style>
            
            *{
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            body{
                max-width: 100vw;
                min-height: 100vh;
                
                font-family: -apple-system, BlinkMacSystemFont, sans-serif;
                background: #121212; /* fallback for old browsers */
                overflow-x: hidden;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -o-user-select: none;
                user-select: none;
            }
            body:not(.user-is-tabbing) button:focus,
            body:not(.user-is-tabbing) input:focus,
            body:not(.user-is-tabbing) select:focus,
            body:not(.user-is-tabbing) textarea:focus {
            outline: none;
            }

            a {
                text-decoration: none;
                color: inherit;
            }
            .userName{
                color: white;
                font-size: 23px;
                font-weight: 700;
            }

            .flexMain {
                display:flex;
                align-items: center;
                justify-content: space-between;
                padding: 0px 165px;
                background-color: #000000e6;
            }
    
            .flexMain h1{
                font-size: 35px;
                font-weight: 800;
                color: white;font-size: 35px;
                font-weight: 800;
                text-decoration: none;
            }
            button.siteLink {
                margin-left:-5px;
                border:none;
                padding:24px;
                display:inline-block;
                min-width:115px;
                background-color: transparent;
                color: white;
                font-weight: 600;
                font-size: 17px;
                cursor: pointer;
            }
            button.siteLink:hover{
                background-color: #1f1f1f;
            }
            #mainNavigation {
            transition : transform 200ms linear;
            background : #fff;
            }
            .content-container   h1 {
            color: white;
            text-align: center;
            font-size: 35px;
            font-weight: 800;
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
            .popup{
                position: absolute;
                right: 0;
                color: white;
                background-color: #191919;
                /* padding: 7px 13px; */
                width: 130px;
                display: flex;
                flex-direction: column;
                font-weight: 600;
                font-size: 17px;
                align-items: center;
            }
            .tournPop{
                width: 104%;
                left: -5px;
                z-index: 8;
            }
            .leaguePop,.gamePop{
                width: 105%;
                left: -5px;
                z-index: 8;
            }
            .userOp{
                top: 100%;
            }
            .listContainer{
                position: relative;
                display: flex;
            }
            .popup a{
                width: 100%;
                text-align: center;
                padding: 10px;
            }
            .popup a:hover{
                background-color: #1f1f1f;
            }
            .user svg{
                width: 15px;
                height: 15px;
                margin-top: 2px;
                fill: white;
            }
            .tourns,.leagues,.games,.authen{
                position: relative;
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
        padding: 5px 25px 5px 10px;
        font-size: 19px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        }
        .success{
            background-color: #4bb543;
        }
        .error{
            background-color: red;
        }
        </style>
    </head>

    <body class="antialiased">
                <form method="POST" action="../api/logout"  id="logout">
                    @csrf
                    <input type="hidden" >

                </form>
                <div  id="menuHolder">
                    <div role="navigation" class="sticky-top border-bottom border-top" id="mainNavigation">
                        <div class="flexMain">
                            <a href="/"> <h1>Kamkom</h1></a>
                        
                    
                            <div class=" text-end d-none d-md-block listContainer" x-data="{ open: false,tournOpen: false,leagOpen: false,gameOpen: false }" x-on:click.away="open = false" >
                                <a href="/"> <button class="siteLink" id="ins">Home</button></a>

                                <div class="tourns">
                                    <a href="/tournament/tops" @click="tournOpen = !open" @mouseover = "tournOpen = true" >
                                        <button class="siteLink tourn">Tournaments</button>
                                    </a>

                                    <div x-show="tournOpen" class="popup tournPop" @mouseover = "tournOpen = true" @mouseover.away = "tournOpen = (e)=> e.target.className.split(' ')[1] == 'tourn' ? null : tournOpen = false">                                     
                                        <a href="../tournament/tops">Top Tournaments</a>  
                                        @auth
                                            <a href="../tournament/mytourns">My Tournament</a>
                                            <a href="../tournament/create">Create Tournament</a>
                                        @endauth
                                    </div>
                                </div>


                                <div class="leagues">
                                    <a href="../league/tops" @click="leagOpen = !open" @mouseover = "leagOpen = true" >
                                        <button class="siteLink league">Leagues</button>
                                    </a>

                                    <div x-show="leagOpen" class="popup leaguePop" @mouseover = "leagOpen = true" @mouseover.away = "leagOpen = (e)=> e.target.className.split(' ')[1] == 'league' ? null : leagOpen = false">                                     
                                        <a href="../league/tops">Top Leagues</a>  
                                        <a href="../league/myleagues">My League</a>
                                        <a href="../league/create">Create League</a>
                                    </div>
                                </div>

                                <div class="games">
                                    <a href="../games/tops" @click="gameOpen = !open" @mouseover = "gameOpen = true" >
                                    <button class="siteLink gameNav">Games</button>
                                    </a>

                                    <div x-show="gameOpen" class="popup gamePop" @mouseover = "gameOpen = true" @mouseover.away = "gameOpen = (e)=> e.target.className.split(' ')[1] == 'gameNav' ? null : gameOpen = false">                                     
                                        <a href="../games/tops">Top Games</a>  
                                        @auth
                                            <a href="../games/mine">My Games</a>
                                            <!-- <a href="../games/create">Create Game</a> -->
                                        @endauth
                                    </div>
                                </div>
                                
                                @guest
                                <a href="../register"> <button class="siteLink">Register</button></a>
                                <a href="../login">   <button class=" siteLink">Login</button></a>
                                @endguest
                                @auth
                                <div class="authen">
                                    <a href="/ki" @click="(event)=> event.preventDefault();" @click="open = !open" @mouseover = "open = true" >   
                                        <button class="siteLink user">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"></path></svg>
                                            {{ucfirst(auth()->user()->name)}}
                                        </button>
                                    </a>

                                    <div x-show="open" class="popup userOp" @mouseover = "open = true" @mouseover.away = "open = (e)=> e.target.className.split(' ')[1] == 'user' ? null : open = false">
                                        @can('admin')
                                        <a href="../dashboard/users">Dashboard</a>
                                        @endcan
                                        <a href="../" @click="(e)=> e.preventDefault();document.getElementById('logout').submit()">Logout</a>
                                    </div>
                                </div>       
                                @endauth
                            </div> 
                        </div>
                    </div>
                </div>        
               
                {{$content}}
                <!-- @if(request()->session()->has('response'))
                @dd(session('response'))
              <p>hello</p> 
             @endif -->

             @if(request()->session()->has('response'))
                
                <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                    <p   class="responseContent success">{{session('response')[0]->original['message']}}</p>   
                    @php
                    session()->forget('response');
                    @endphp
                </div>
            @endif
    
            @if(request()->session()->has('error'))
                  <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                      <p   class="responseContent error">{{session('error')[0]->original['errors']}}</p> 
                      @php
                        session()->forget('error');
                    @endphp
                  </div>
            @endif
    </body>
</html>
