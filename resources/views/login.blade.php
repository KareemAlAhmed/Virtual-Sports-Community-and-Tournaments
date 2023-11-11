
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
                </div>
            </div>
        </div>
    </x-slot>
</x-baselayout>