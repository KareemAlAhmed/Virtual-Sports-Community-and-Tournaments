@props(['nojoined','tourn'])
<style>
 .post {
    width: 355px;
    height: 170px;
    padding: 20px;
    font-size: 16px;
    color: white;
    border-radius: 8px;
    background-color: #121212;
}
h2{
    font-weight: 700;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.post ul{
    padding-top: 20px;
    font-size: 0.85em;
    list-style: none;
    flex-direction: column;
}
.post img{
    width: 1em;
    height: 1em;
}
.cyberpress-tournament-title a:hover{
    color: black;
}
h2 svg{
    height: 20px;
    fill: white;
    cursor: pointer;
}
h2 svg:hover{
    fill: black;
}
</style>
@php
$start = $tourn['startDate']; 
$startDate = strtotime($start); 

@endphp
<li id="post-762" class="post" x-data="{click: false}">
    <h2 class="cyberpress-tournament-title">
        <a href="../tournament/{{$tourn['id']}}">{{$tourn['name']}}  </a>
        @if($nojoined !='false')
        <svg class="tourn{{$tourn['id']}}" @click="addingUser(event)" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path class="tourn{{$tourn['id']}}" d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3zM504 312V248H440c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V136c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H552v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
        @endif
    </h2>

    <ul class="cyberpress-tournament-info">
        <li>
            <strong>Dates</strong>: {{date('F  j, Y', strtotime($tourn['startDate']))}}  -   {{date('F  j, Y', strtotime($tourn['endDate']))}}  
        </li>
        <li>
            <strong>Game</strong>: <a href="https://wp.nkdev.info/squadforce/games/dota-2/" class="cyberpress-game-inline-link"><img width="200" height="200" src="https://wp.nkdev.info/squadforce/wp-content/uploads/2019/10/game-dota-2.svg" class="attachment-medium size-medium" alt="" loading="lazy"> 
                {{$tourn['sportType']}}</a>                
            </li>
        <li>
            <strong>Total Prize pool</strong>: {{$tourn['rewards']}}$                
        </li>
    </ul>             
   @auth

   <form method="post" style="display: none;" id="userAdd{{$tourn['id']}}" action="../api/enroll/user/{{auth()->user()->id}}/tournament/{{$tourn['id']}}">
        @csrf
    
    </form>
    @endauth
</li><!-- #post-## -->


<script>
    function addingUser(e){
        formClass=e.target.className.animVal;
        formEle=document.querySelector('.' +formClass).parentElement.parentElement.lastElementChild.submit();
    }
</script>