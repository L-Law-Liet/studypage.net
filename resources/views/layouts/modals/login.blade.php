
<div id="myLoginModal" class="modal">

    <!-- Modal content -->
    <div class="login-content">
        <div class="justify-content-center d-flex">
            <div id="form" class="position-relative">
                <img class="loginClose position-absolute clickable-el" style="margin-left: 326px" src="{{asset('img/login_form_close.svg')}}" alt="">
                <div id="login-header" class="text-center m-1">
                    <b class="color-2D7ABF">Вход</b>
                </div>
                <div class="login-content">
                    <div class="login-form">
                        <form id="login-form" action="{{route('logging')}}" method="post">
                            @csrf
                            <div class="login-form-div">
                                <label>Электронная почта</label>
                                <input required autocomplete="off" class="@if($errors->first('email') && session('login')) border-danger border @else login-form-input @endif p-1"
                                       type="text" name="email" @if(session('login')) value="{{old('email')}}" @endif>
                                <span class="text-danger"><small>@if(session('login')) {{ $errors->first('email')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Пароль</label>
                                <input required autocomplete="off" class="@if($errors->first('password') && session('login')) border-danger border @else login-form-input @endif p-1" type="password" name="password">
                                <span class="text-danger"><small>@if(session('login')) {{ $errors->first('password')}} @endif</small></span>
                            </div>
                            <div class="login-form-div mt-3">
                                <input class="p-1 text-white btn-germany" type="submit" value="Войти">
                            </div>
                        </form>
                    </div>
                    <div id="reg-href" class="text-center mt-1 mb-1">
                        У Вас не имеется кабинет? <a style="color: #2D7ABF;"  onclick="redirectToReg()" href="#">Регистрация</a>
                        <a href="#" style="color: #2D7ABF;" onclick="redirectToForgot()">Забыли пароль?</a>
                    </div>
                    <div class="login-form">
                        <div class="login-form-div mt-2 mb-3 justify-content-between d-flex">
                            <img src="{{asset('img/login_line.svg')}}" alt=""> Или
                            <img src="{{asset('img/login_line.svg')}}" alt="">
                        </div>
                        <div class="login-form-div">
                            <button onclick="window.location='{{url('/sign-in/facebook')}}'" id="fb_btn" class="p-1 text-white">
                                <img class="mr-1 mb-1" src="{{asset('img/fb_logo.svg')}}" alt="">Продолжить с Facebook</button>
                        </div>
                        <div class="login-form-div">
                            <button onclick="window.location='{{url('/sign-in/google')}}'" id="google-btn" class="p-1">
                                <img class="mr-1" src="{{asset('img/google_logo.svg')}}" alt="">Продолжить с Google</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
