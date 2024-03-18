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
                <form  method="POST" id="registerForm" action="api/login">
                  @csrf
                    <h1>
                    Login
                    </h1>
                    <br>
                    <br>
                    <span class="subtitle">EMAIL:</span>
                    <br>
                    <input type="email" name="email" value="" @readonly(auth()->user()== 'Kareem')>
                    <br>
                    <span class="subtitle">PASSWORD:</span>
                    <br>
                    <input type="password" name="password" value="">
                    <br>
                    <br>
                    <input type="submit" value="SUBMIT" class="submit-btn" style="margin-left: 50%;transform: translateX(-50%);">
                </form>
                <div class="errors">
                      
                        @if(request()->session()->has('errors'))            
                                @php
                                    echo("<p>**". session('errors')[0]->original['error'] ."</p>");
                                    session()->forget('errors');
                                @endphp
                    
                        @endif

                  </div> 
                </div>
            </div>
        </div>
    </x-slot>
</x-baselayout>