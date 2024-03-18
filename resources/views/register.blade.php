<style>
.errors{
    background-color: transparent;
    color: red;
    font-weight: bold;
    display: flex;
    margin-bottom: 25px;
    flex-direction: column;
    align-items: center;
}
</style>
<x-baselayout>
    <x-slot name="content">
        <div class="flex-container">
            <div class="content-container">
                <div class="form-container">
                    <form  method="POST" id="registerForm" action="api/register" enctype="multipart/form-data">
                    @csrf
                        <h1>
                        Register
                        </h1>
                        <br>
                        <br>
                        <span class="subtitle">NAME:</span>
                        <br>
                        <input type="text" name="name" value="">
                      
                        <br>
                        <span class="subtitle">EMAIL:</span>
                        <br>
                        <input type="email" name="email" value="">
                        <br>
                        <span class="subtitle">PASSWORD:</span>
                        <br>
                        <input type="password" name="password" value="">
                        <br>
                        <span class="subtitle">BIO:</span>
                        <br>
                        <input type="text" name="bio" value="">
                        <br>
                        <span class="subtitle">PHOTO:</span>
                        <br>
                        <input type="file" name="image_url" value="" style="margin-top: 3px;">
                        <br>
                        <br>
                        <input type="submit" value="SUBMIT" class="submit-btn" style="margin-left: 50%;transform: translateX(-50%);">
                    </form>
                    <div class="errors">
                      
                        @if(request()->session()->has('errors'))            
                                @php

                                $errors=array(json_decode(session('errors')[0]->original['error']));
                                $error=$errors[0];
                                foreach($error as $er){
                                    foreach($er as $e){
                                    echo("<p>**$e</p>");}
                                }

                                session()->forget('errors');
                                @endphp
                    
                        @endif

                  </div> 
                </div>
            </div>
        </div>
    </x-slot>
</x-baselayout>