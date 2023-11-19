@props(['post1','post2','post3','myposts'])
@php
use App\Models\User;

@endphp


<script src="//unpkg.com/alpinejs" defer></script>
<style>
    .liked{
        color:  red !important;
        fill:  red !important;
    }
    .shared{
        color:  yellow !important;
        fill:  yellow !important;
    }
    .mainContainer{
        min-height: 90vh;
        max-width: 100vw;
        padding: 50px 70px 50px 180px;
        display: flex;
        gap: 20px;
    }
    .centerContainer{
        width: 70%;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .sideContainer{
        width: 35%;
        background-color: #191919;
    }
    .postCont{
        background-color: #191919;
    }
    .post {
        padding: 30px 25px 25px;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    .imageAndOtherOpt{
        display: flex;
        gap: 25px;
        align-items: center;
        color: white;
    }
    .userImage{
         width: 50px;
         height: 50px;
    }
    .userImage img{
        width: 100%;
        height: 100%;
        border-radius: 50px;
    }
    
    .otherOptions ul{
        list-style: none;
        display: flex;
        gap: 22px;
        font-weight: 600;
        font-size: 17px;
        cursor: pointer;
    }
    .otherOptions ul li{
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .otherOptions ul li svg{
        align-self: baseline;
        fill: white;
    }
    .textEntering{
        width: 100%;
        height: 85px;
    }
    .textEntering textarea{
        width: 100%;
        height: 100%;
        font-weight: 600;
        font-size: 17px;
        outline: none;
        resize: none;
        border: 0;
        padding: 5px
    }
    .textEntering textarea:hover{
        border: none;
    }
    .textEntering textarea:focus{
        border: none;
    }
    .submiting {
        display: flex;
        justify-content: flex-end;
    }
    .submiting button{
        cursor: pointer;
        border: none;
        
        box-shadow: 2px 2px 7px #121212;
        background: #121212;
        color: white;
        width: 90px;
        transition: all 1s;
        height: 35px;
        font-weight: 600;
        font-size: 17px;
    }
    .userName p{
        font-size: 20px;
    }
    .userName span{
        font-size: 14px;
        color: #ffffff45;
        margin-left: 9px;
    }
    .content{
        width: 100%;
    }
    .content p{
        color: white;
        font-size: 21px;
        font-weight: 600;
    }
    .reactions{
        display: flex;
        justify-content: center;
    }

    .reactions button{
        cursor: pointer;
        border: none;
        
        box-shadow: 2px 2px 7px #121212;
        background: #121212;
        color: white;
        width: calc( 100% / 3 );
        transition: all 0.3s;
        height: 35px;
        font-weight: 600;
        font-size: 17px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }
    .reactions button:hover{
        background-color: #1f1f1f;
    }
    .reactions svg{
        fill: white;
        margin-bottom: 5px;
        transition: all 0.1s;
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
    label{
        cursor: pointer;
    }
</style>

@php
$userPic= auth()->check() ? auth()->user()->image_url : 'images.jpeg';
@endphp


<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
            <div class="centerContainer">
      
                <div class="post postCont">
                    <div class="imageAndOtherOpt">
                        <div class="userImage">
                            <img src="<?php echo asset("storage/UserProfilePic/" . $userPic )?>" alt="">
                        </div>
                        <div class="otherOptions">
                            <ul>
                                
                                <li> 
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
                                    <label for="image_url">Photos</label>                              </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/></svg>    
                                    Audios
                                </li>
                                <li>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>
                                    <label for="video_url"> Videos </label>
                                </li>
                                <li>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                    Documents
                                </li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="textEntering">
                        
                        <form action="api/post/user/{{auth()->check() ? auth()->user()->id : 0}}" method="POST" id="posting" enctype="multipart/form-data" >
                            @csrf
                            <input type="file" name="image_url"  id="image_url" style="display: none;"/>
                            <input type="file" name="video_url"  id="video_url" style="display: none;"/>
                            @php
                            $user= auth()->check() ? auth()->user()->name : 'Client';
                            @endphp
                            <textarea name="content" placeholder="What is on your mind ,{{$user}} ?"></textarea>
                        </form>
                    </div>

                    <div class="submiting">
                       @if(auth()->check())
                        <button onclick="(e)=> e.preventDefault(); document.getElementById('posting').submit()">Submit</button>
                        @endif
                        @if(!auth()->check())
                        <a href="register"><button onclick="(e)=> e.preventDefault(); document.getElementById('posting').submit()">Signin</button></a>
                        @endif
                        
                    </div>

                </div>
                
                <?php
                    $date=date("Y-m-d");
                    $time = date("h:i:sa");
                    if ( str_contains($time, 'pm') ) {
                        $time = str_replace('pm', '', $time);

                    }else{
                        $time = str_replace('am', '', $time);
                    }

                    // $finalTime = new DateTime(implode(" ", array($date,$time)));
                    $finalTime=$date .' '.$time;
                    $userposts=[];
                    if( auth()->check()){
                        $userposts=auth()->user()->posts->toArray();
                    }
                    rsort($userposts);

                ?>
               @if(auth()->check())
               @for ($j = 0; $j<count($userposts) ; $j++)
                    @php
                    $newtime=date('Y-m-d h:i:s',strtotime($userposts[$j]['created_at']));
                    $newtime=explode(' ',$newtime);

                    $postDayNb=explode('-',$newtime[0])['2'];
                    $postMonNb=explode('-',$newtime[0])['1'];
                    $postHourNb=explode(':',$newtime[1])['0'];
                    $postMinNb=explode(':',$newtime[1])['1'];

                    $todyDayNb=explode( '-', $date )['2'];
                    $todyMonNb=explode( '-', $date )['1'];
                    $currentHour=explode( ':', $time )['0'];
                    $currentMin=explode( ':', $time )['1'];

                    @endphp
                    
                    
                        @if($postDayNb == $todyDayNb && $postMonNb == $todyMonNb && $postHourNb == $currentHour && (int)$currentMin - (int)$postMinNb < 59)
                            <x-post :post='$userposts[$j]'></x-post>
                        @endif
                    @endfor
               @endif

                @for ( $i = 0; $i<count($post1) ; $i++)
                    <x-post :post='$post1[$i]'></x-post>
                    <x-post :post='$post2[$i]'></x-post>
                    <x-post :post='$post3[$i]'></x-post>
                @endfor
          


            </div>
            <div class="sideContainer"></div>
           

        </div>
       
        @if(request()->session()->has('response'))
                
            <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                <p   class="responseContent">{{session('response')[0]->original['message']}}</p>   
            </div>
                @php
                    session()->forget('response');
                @endphp
        @endif

        @if(request()->session()->has('error'))
              <div class="responseMessage" x-data="{show :true}" x-show="show" x-init="setTimeout(()=> {show = false},3000)">
                  <p   class="responseContent">{{session('error')[0]->original['errors'][0]}}</p> 
            
                  @php
                    session()->forget('error');
                @endphp
              </div>
        @endif
    </x-slot>
</x-baselayout>
<script>


let likeBtn=document.querySelectorAll('.like');
let shareBtn=document.querySelectorAll('.share');

for(let i= 0;i<likeBtn.length;i++){
    likeBtn[i].addEventListener('click', toggleLikedClass);
    likeBtn[i].children[0].addEventListener('click', toggleLikeClassSVG);
}
for(let i= 0;i<shareBtn.length;i++){
    shareBtn[i].addEventListener('click', toggleShareClass);
    shareBtn[i].children[0].addEventListener('click', toggleShareClassSVG);
}

   function toggleLikedClass(element) {
        if (element.target.classList.contains('like')) {
            if (element.target.classList.contains('liked')) {
                element.target.classList.remove('liked');
                element.target.children[0].classList.remove('liked');
            } else {
                element.target.classList.add('liked');
                element.target.children[0].classList.add('liked');
            }
        } 
    }
   function toggleShareClass(element) {
        if(element.target.classList.contains('share')){
            if (element.target.classList.contains('shared')) {
                element.target.classList.remove('shared');
                element.target.children[0].classList.remove('shared');
            } else {
                element.target.classList.add('shared');
                element.target.children[0].classList.add('shared');
            }
        }
    }
    function toggleLikeClassSVG(element){
            if(element.target.classList.contains('logo')){
                if(element.target.parentElement.classList.contains('liked')){
                    element.target.parentElement.classList.remove('liked')
                    element.target.parentElement.children[0].classList.remove('liked')
                }else{
                    element.target.parentElement.classList.add('liked')
                    element.target.parentElement.children[0].classList.add('liked')
                }
            }else{
                if(element.target.parentElement.parentElement.classList.contains('liked')){
                    element.target.parentElement.parentElement.classList.remove('liked')
                    element.target.parentElement.parentElement.children[0].classList.remove('liked')
                }else{
                    element.target.parentElement.parentElement.classList.add('liked')
                    element.target.parentElement.parentElement.children[0].classList.add('liked')
                }
            }      
    }
    function toggleShareClassSVG(element){
            if(element.target.classList.contains('logo')){
                if(element.target.parentElement.classList.contains('shared')){
                    element.target.parentElement.classList.remove('shared')
                    element.target.parentElement.children[0].classList.remove('shared')
                }else{
                    element.target.parentElement.classList.add('shared')
                    element.target.parentElement.children[0].classList.add('shared')
                }
            }else{
                if(element.target.parentElement.parentElement.classList.contains('shared')){
                    element.target.parentElement.parentElement.classList.remove('shared')
                    element.target.parentElement.parentElement.children[0].classList.remove('shared')
                }else{
                    element.target.parentElement.parentElement.classList.add('shared')
                    element.target.parentElement.parentElement.children[0].classList.add('shared')
                }
            }      
    }

    
</script>
