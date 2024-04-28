<template>   

    <div class="mainContainer">
               
                
                <div class="tournsInfo">
                    <!-- @if(empty($tourn))
                        <div class="noTourn">
                            <h3>There is no Tournaments.</h3>
                        </div> -->
                    <!-- @else -->
                    <ul class="nk-breadcrumbs">
                        <li><a rel="v:url" href="/">Home</a></li>
                        <li><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <span class="fa fa-angle-right"></span> Font Awesome fontawesome.com --></li>
                        <li><span><h1>Games</h1></span></li>
                    </ul>
                    <ul class="tournsList">
                        <!-- <template v-for="game in getTourns" :key="game.id">
                            <SmallCard :post="game" comptype="Tourn" />
                        </template> -->
                        <!-- <x-smallCardPost :data='$tourn'  nojoined='true' compType='tournament'></x-smallCardPost>
                        @for( $i = 1; $i<count($allTourn);$i++)
                            <x-smallCardPost :data='$allTourn[$i]'  nojoined='true' compType='tournament'></x-smallCardPost>
                        @endfor -->
                    </ul>
                    <!-- @endif -->
    
                </div>
                <SideContainer />
               
                
            </div>
           
      </template>
      <script>
      import store from '../../store'
      import SideContainer from '../minicomponent/SideContainer.vue';

      export default {
          name:"TopsGame",
          components: {
            'SideContainer': SideContainer,
           
        },
      }
      </script>
      <style scoped>
          
        .nk-breadcrumbs{
            font-family: "Montserrat", sans-serif;
            font-style: normal;
            font-weight: 700;
            padding: 0;
            margin: 0;
            color: #fff;
            text-transform: uppercase;
            list-style-type: none;
    
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
        width: 70%;
        min-height: 50vh;
        display: flex;
        flex-direction: column;
        gap: 25px;
        padding: 15px 15px;
        background-color: var(--post-color);
    }
    .tournsInfo .tournsList{
        
        width: 100%;
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
    .noTourn{
        width: 65%;
    }
    .noTourn h3{
        color: white;
        font-size: 30px;
        text-align: center;
    }
    .post ul{
    padding-top: 20px;
    font-size: 0.85em;
    list-style: none;
    flex-direction: column;
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
        background-color: var(--background-color);
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
      </style>