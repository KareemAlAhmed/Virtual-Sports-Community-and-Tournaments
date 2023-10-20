<style>
    .mainContainer{
        min-height: 90vh;
        max-width: 100vw;
        padding: 50px 70px 50px 180px;
        display: flex;
        gap: 20px;
    }
    .centerContainer{
        width: 70%;

    }
    .sideContainer{
        width: 35%;
        background-color: #191919;
    }
    .postCont{
        background-color: #191919;
    }
    .newPost {
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
</style>
<x-baselayout>
    <x-slot name="content">
        <div class="mainContainer">
            <div class="centerContainer">

                <div class="newPost postCont">
                    <div class="imageAndOtherOpt">
                        <div class="userImage">
                            <img src="storage/app/public/images.jpeg" alt="">
                        </div>
                        <div class="otherOptions">
                            <ul>
                                <li> 
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M448 80c8.8 0 16 7.2 16 16V415.8l-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3V96c0-8.8 7.2-16 16-16H448zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
                                    Photos
                                </li>
                                <li>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9V168c0-8.7 4.7-16.7 12.3-20.9z"/></svg>    
                                    Audios
                                </li>
                                <li>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>
                                    Videos
                                </li>
                                <li>
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>
                                    Documents
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="textEntering">
                        
                        <form action="api/post/user/{{auth()->check() ? auth()->user()->id : 0}}" method="POST" id="posting">
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




            </div>
            <div class="sideContainer"></div>
        </div>
    </x-slot>
</x-baselayout>