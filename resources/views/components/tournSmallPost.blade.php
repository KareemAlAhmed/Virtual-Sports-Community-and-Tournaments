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
</style>
@php
$start = $tourn['startDate']; 
$startDate = strtotime($start); 

@endphp
<li id="post-762" class="post">
    <h2 class="cyberpress-tournament-title">
        <a href="https://wp.nkdev.info/squadforce/tournaments/2019-world-championship/">{{$tourn['name']}}</a>
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
</li><!-- #post-## -->