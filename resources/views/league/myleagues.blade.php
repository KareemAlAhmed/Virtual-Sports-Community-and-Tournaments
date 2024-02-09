@props(['joined','created'])
@php

$joinedLeague=$joined->original['Leagues'];
@endphp


<style>
    .mainContainer{
        min-height: 80vh;
        background-color: #191919;
        border-radius: 12px;
        margin: 45px 165px;
        padding: 15px 15px;
    }
    /* .mainContainer{
        width: 70%;
        min-height: 80vh;
        margin: 45px 15%;
        background-color: #191919;
        border-radius: 12px;
    } */
    .nk-breadcrumbs{
        font-family: "Montserrat", sans-serif;
        font-style: normal;
        font-weight: 700;
        padding: 0;
        margin: 0;
        color: #fff;
        text-transform: uppercase;
        list-style-type: none;
        margin-bottom: 40px;
    }
    .nk-breadcrumbs > li{
        display: inline-block;
    font-size: 1.07rem;
    }
    .nk-breadcrumbs > li + li {
    margin-left: 6px;
    }
    .nk-breadcrumbs > li:last-of-type {
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 18px;
    gap: 10px;
}
.svg-inline--fa {
    display: var(--fa-display,inline-block);
    height: 1em;
    overflow: visible;
    vertical-align: -0.125em;
}
.nk-breadcrumbs > li:last-of-type::after {
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(-12px);
    margin-bottom: -3px;
}
.tournsInfo{
    width: 100%;
    min-height: 50vh;
    display: flex;
    gap: 25px;
    color: white;
}
.tournsInfo .tournsList{
    
    width: 730px;
    display: flex;
    
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.tournsList ul{
    display: flex;
    
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.sideContainer{
    width: 35%;
    height: fit-content;
    padding: 20px 23px ;
    background-color: #121212;
}
h4{
    margin: -23px;
    margin-bottom: 0;
    padding: 23px;
    font-size: 1.22rem;
    text-transform: uppercase;
    font-family: Montserrat, sans-serif;
    font-style: normal;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    position: relative;
    z-index: 1;
}
h4 span{
    display: inline-block;
    padding-right: 18px;
    background-color: #121212;
}
h4::after{
    content: "";
    position: absolute;
    display: block;
    top: 36px;
    right: 1px;
    left: 30px;
    height: 3px;
    background-color: #fff;
    z-index: -1;
}

.centerContainer,.joinedTourns,.createdTourns{
    width: 730px;
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
}
.centerContainer{
    width: 65%;
}
.joined ,.created {
    display: flex;
    margin-top: 9px;
    margin-left: 0;
    font-size: 15px;
    gap: 10px;
    height: fit-content;
    width: 100%;
    align-items: flex-start;
}
.joined::after,.created::after{
    
    width: 100%;
    content: "";
    display: block;
    -webkit-box-flex: 100;
    -ms-flex: 100;
    flex: 100;
    border-bottom: 4px solid white;
    -webkit-transform: translateY(-12px);
    -ms-transform: translateY(-12px);
    transform: translateY(23px);
    margin-bottom: -3px;
}

</style>
@php
use App\Models\Leagues;
use App\Models\Posts;

$league=Leagues::find(1);


$firstSide=Posts::find(31);
$secondSide=Posts::find(35);
$thirdSide=Posts::find(36);

@endphp


<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
            <ul class="nk-breadcrumbs">
                <li><a rel="v:url" href="/">Home</a></li>
                <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>
                <li><span><h1>Leagues</h1></span></li>
            </ul>
            
            <div class="tournsInfo">
                <div class="centerContainer">
                   <div class="joinedTourns">
                        <div class="joined">
                            <span><h1>Joined Leagues</h1></span>
                        </div>
                            <ul class="tournsList">
                                @for( $i = 0; $i<count($joinedLeague);$i++)
                                    <x-smallCardPost  :data='$joinedLeague[$i]' nojoined='false' compType='league' ></x-smallCardPost>
                                @endfor
                            </ul>
                    </div>

                    <div class="createdTourns">
                        <div class="created">
                            <span><h1>Created Leagues</h1></span>
                        </div>

                        <ul class="tournsList">
                                @for( $i = 0; $i<count($created);$i++)
                                    <x-smallCardPost  :data='$created[$i]' nojoined='false' compType='league'></x-smallCardPost>
                                @endfor
                            </ul>
                    </div>
                </div>

                <div class="sideContainer">
                    <h4 class="nk-widget-title"><span>Top 3 Recent</span></h4>
                    <ul>
                        <x-sidePost :firstSide='$firstSide' ></x-sidePost>
                        <x-sidePost :firstSide='$secondSide'></x-sidePost>
                        <x-sidePost :firstSide='$thirdSide'></x-sidePost>
                    </ul>
                </div>
            </div>
               
            
        </div>
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
    </x-slot>
</x-baselayout>