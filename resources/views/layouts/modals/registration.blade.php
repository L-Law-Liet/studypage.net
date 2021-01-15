
<div id="myRegModal" class="modal">

    <!-- Modal content -->
    <div class="login-content">
        <div class="justify-content-center d-flex">
            <div id="form" class="position-relative">
                <img class="regClose position-absolute clickable-el" src="{{asset('img/login_form_close.svg')}}"
                     style="margin-left: 326px" alt="x">
                <div id="login-header" class="text-center m-1">
                    <b class="color-2D7ABF">Регистрация</b>
                </div>
                <div class="login-content">
                    <div class="login-form">
                        <form id="login-form" action="{{route('register')}}" method="post">
                            {{csrf_field()}}
                            <div class="login-form-div">
                                <label>Фамилия*</label>
                                <input required class="@if($errors->first('surname') && session('register')) border-danger border @else login-form-input @endif p-1" type="text" name="surname" placeholder="Введите" value="{{old('surname')}}">
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('surname')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Имя*</label>
                                <input required class="@if($errors->first('name') && session('register')) border-danger border @else login-form-input @endif p-1" type="text" name="name" placeholder="Введите" value="{{old('name')}}">
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('name')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Дата рождения*</label>
                                <input required onchange="setDate(this.value)" class="@if($errors->first('birthDate') && session('register')) border-danger border @else login-form-input @endif p-1 datepicker" placeholder="Выберите" value="{{old('birthDate')}}">
                                <input hidden type="date" required id="origDate" name="birthDate" value="{{old('birthDate')}}">
                                
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('birthDate')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Пол*</label>
                                <select id="reg-gender" required class="@if($errors->first('gender') && session('register')) border-danger border @else login-form-input @endif chsn p-1 w-100" name="gender">
                                    <option value="">Выберите</option>
                                    <option @if(old('gender') == 'm') selected @endif value="m">Мужчина</option>
                                    <option @if(old('gender') == 'f') selected @endif value="f">Женщина</option>
                                </select>
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('gender')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Регион*</label>
                                <select id="reg-region" required class="@if($errors->first('region') && session('register')) border-danger border @else login-form-input @endif chsn p-1 w-100" name="region">
                                    <option value="">Выберите</option>
                                    @foreach(\App\Region::all() as $c)
                                        <option @if(old('region') == $c->id) selected @endif value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('region')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Электронная почта*</label>
                                <input required autocomplete="off" class="@if($errors->first('email') && session('register')) border-danger border @else login-form-input @endif p-1"
                                       type="text" name="email" placeholder="Введите" @if(session('register')) value="{{old('email')}}" @endif>
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('email')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Контактный телефон*</label>
                                <input required placeholder="Введите" class="@if($errors->first('phone') && session('register')) border-danger border @else login-form-input @endif p-1 phone_mask" value="{{old('phone')}}" type="tel" name="phone">
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('phone')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Пароль*</label>
                                <input required autocomplete="off" class="@if($errors->first('password') && session('register')) border-danger border @else login-form-input @endif p-1"
                                       placeholder="Введите" type="password" name="password">
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('password')}} @endif</small></span>
                            </div>
                            <div class="login-form-div">
                                <label>Повторите пароль*</label>
                                <input required class="@if($errors->first('password_confirmation') && session('register')) border-danger border @else login-form-input @endif p-1"
                                       placeholder="Введите" type="password" name="password_confirmation">
                                <span class="text-danger"><small>@if(session('register')) {{ $errors->first('password_confirmation')}} @endif</small></span>
                            </div>
                            <div class="login-form-div mt-3">
                                <input class="p-1 text-white btn-germany" type="submit" value="Зарегистрироваться">
                            </div>
                        </form>
                    </div>
                    <div id="reg-href" class="text-center mt-1 mb-1 policy">
                        Регистрируясь, Вы подтверждаете свое согласие с
                        <a class="color-2D7ABF" href="/article/4"> Пользовательским соглашением</a>,
                        <a class="color-2D7ABF" href="/article/6"> Политикой конфиденциальностью</a>,
                        на обработку персональных данных и на использование файлов "cookie"
                    </div>
                    <div class="login-form">
                        <div id="reg-line" class="mt-2 mb-3 justify-content-start d-flex">
                            <img class="w-100" src="{{asset('img/reg-line.svg')}}" alt="">
                        </div>
                        <div id="reg-href" class="text-center mt-1 mb-1">
                            У Вас уже имеется кабинет?
                            <a onclick="redirectToLogin()" class="color-2D7ABF" href="#">Войти</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function setDate(value){
        var now = new Date( value.replace( /(\d{2})-(\d{2})-(\d{4})/, '$2/$1/$3') );
                                var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
$('#origDate').val(today);
    }
</script>
