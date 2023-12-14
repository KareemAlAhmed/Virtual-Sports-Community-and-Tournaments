
<style>

.mainContainer{
    min-height: 90vh;
    max-width: 100vw;
    padding: 50px 70px 50px 165px;
    display: flex;
    gap: 20px;
}

.centerContainer{
        width: 15%;
        display: flex;
        flex-direction: column;
        gap: 20px;
        background-color: #191919;
    }
    .sideContainer{
        width: 75%;
        background-color: #191919;
    }
    .dashBoardOptions{
        list-style: none;
        width: 100%;
        height: 100%;
        color: white;
        display: flex;
        flex-direction: column;
        font-size: 21px;
    }

    .dashBoardOptions li{
        cursor: pointer;
        padding: 10px 15px;
    }
    .dashBoardOptions li:hover{
        background-color: #1f1f1f;
    }
    .selected{
        background-color: #1f1f1f;
    }
    .dashBoardOptions a{
        width: 100%;
        height: 100%;
        display: block;

    }
</style>


<x-baselayout>
    <x-slot name="content">
    <div class="mainContainer">
            <div class="centerContainer">
      
                <ul class="dashBoardOptions">
                    <li class=<?php echo( $_SESSION['selected'] == "users" ? 'selected' : null )?> ><a href="../dashboard/users" > Users </a></li>
                    <li class=<?php echo($_SESSION['selected'] == "tourns" ? 'selected' : null ) ?> ><a href="../dashboard/tourns" > Tournaments </a></li>
                    <li class=<?php echo($_SESSION['selected'] == "leagues" ? 'selected' : null ) ?> ><a href="../dashboard/leagues" > Leagues </a></li>
                    <li class=<?php echo($_SESSION['selected'] == "games" ? 'selected' : null) ?> ><a href="../dashboard/games" > Games </a></li>
                </ul>


            </div>
            

            <div class="sideContainer">
                {{$content}}
            </div>
           

        </div>
    </x-slot>
</x-baselayout>