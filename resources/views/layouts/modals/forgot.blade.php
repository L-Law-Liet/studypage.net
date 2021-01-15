
<div id="myForgotModal" class="modal">

    <!-- Modal content -->
    <div class="login-content">
        <div class="justify-content-center d-flex">
            <div id="form" class="position-relative">
                    <img class="forgotClose position-absolute clickable-el" src="{{asset('img/login_form_close.svg')}}"
                         style="margin-left: 326px" alt="">
                <div id="login-header" class="text-center m-1">
                    <b class="color-2D7ABF">Восстановление пароля</b>
                </div>
                <div class="">
                    <div class="justify-content-center d-flex">
                        <div>
                            <div class="m-3">
                                <div class="forgot-passwd-subtitle text-justify mt-2">
                                    Введите электронную почту, указанный при регистрации. На указанную Вами
                                    электронную почту придет письмо со ссылкой для восстановления пароля.
                                </div>
                            </div>
                            <form id="login-form" action="{{route('forgot-password')}}" method="post" class="p-2 m-1">
                                @csrf
                                <div class="login-form-div">
                                    <label>Электронная почта</label>
                                    <input required class="@if($errors->first('email') && session('forgot')) border-danger border @else login-form-input @endif p-1"
                                           name="email" type="text" @if(session('forgot')) value="{{old('email')}}" @endif>
                                    <span class="text-danger"><small>@if(session('forgot')) @if(session()->get('errors')) @foreach($errors->all() as $e) {{$e}} @endforeach @endif @endif</small></span>
                                </div>
                                <div class="clearfix">
                                    <div class="form-group text-center mt-4">
                                        <button type="submit" class="btn p-1 text-capitalize btn-germany btn-primary-custom">
                                            Отправить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
