<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <meta name="google-site-verification" content="JiIrucxZ_fm0sLImvrqc_fpyVBjZG_H0JZPZSjMn91g" />
    <meta name="yandex-verification" content="e91072da6c62023f" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?

    setlocale(LC_MONETARY,"de_DE");
        $url = $_SERVER['REQUEST_URI'];
        if ($url != '/') {
            $url = preg_replace("/\&search.+/", "", $url);
            $url = preg_replace("/\&page.+/", "", $url);
        }
    use App\Models\Social;?>
    <? $meta = \App\Models\Meta::where('page', '=', $url)->orWhere('page', '=', $url.'&page=1')->first(); ?>
    <? if (!empty($meta) AND isset($meta)) { ?>
        <title><?=$meta->title?></title>
        <meta name="description" content="<?=$meta->description?>">
        <meta name="keywords" content="<?=$meta->keywords?>">
    <? } else { ?>
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
    <? } ?>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" ></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('js/slick.min.js') }}" ></script>
    <script src="{{ asset('js/main.js') }}" ></script>
    <script src="{{asset('js/chosen.jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datepicker.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">

    @yield('js')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">--}}
    @stack('pre-css')
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v=1') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/chosen.min.css')}}" rel="stylesheet" type="text/css">
@stack('css')
    <script src="{{asset('js/metrics.js')}}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-179408693-1"></script>
    <noscript><div><img src="https://mc.yandex.ru/watch/67815946" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
</head>
<body>
<div id="app">
    @php
        if (($view_name != 'doctor' && $view_name != 'view-college') || ($view_name == 'doctor' && substr(session()->get('_previous')['url'], 0, strpos(session()->get('_previous')['url'], '?')) != url()->current() && session()->get('view_name') != 'view-college')){
                session()->forget('a');
                session()->forget('query');
        }
    session(['view_name' => $view_name]);
    @endphp
    <input type="hidden" name="_token" value="{{ csrf_token() }}"> <!-- На главной странице множество js не работают из-за отсутствия токена -->
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="logos pb-0">
                        <h1>
                            <a href="{{route('index')}}">
                                <img src="/img/logo.png">
                            </a>
                            <span class="sr-only"></span>
                        </h1>
                        <span class="sr-only">.</span>
                        {{--<a href="/" class="extra-header-logo" title="Never stop learning">--}}
                            {{--<img src="/img/logo_infos_en.png" id="slogan"></a>--}}
                        <span class="sr-only">.</span>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <ul class="social-icons float-right">
                             <div class="d-flex justify-content-between">
                                 @if(Auth::check())
                                     <li class="log-cab ml-4 d-inline-block">
{{--                                                <div class="d-inline mr-3">--}}
{{--                                                    <u><a class="d-inline" id="logged" href="#">Пополнить счет</a></u><b id="balance">{{number_format(Auth::user()->bill, 0, "", " ")}} ед.</b>--}}
{{--                                                </div>--}}

                                                <a id="cabinetDropdown" class="float-right nav-link p-0 font-weight-bold" href="#" aria-expanded="false"
                                                   role="button" data-toggle="dropdown" aria-haspopup="true">
                                                    <img style="width: 30px; height: 18px; margin-right: 5px;" src="/img/login.svg">
                                                    Кабинет
                                                </a>
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                                             @csrf
                                         </form>
                                                <div id="cab-dd-menu" class="dropdown-menu" aria-labelledby="cabinetDropdown">
                                                    <a class="dd-item" href="{{url('cabinet')}}">Личные данные</a>
                                                    <a class="dd-item" href="{{url('change-pwd')}}">Сменить пароль</a>
                                                    <a class="dd-item" href="{{route('logout')}}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Выход</a>
                                                </div>
                                     </li>
                                 @else
                                         <li class="log-cab ml-4 d-inline-block">
                                             <a id="register" class="float-right font-weight-bold" href="#">
                                                 Регистрация
                                             </a>
                                             <span class="border-0 float-right mr-1 color-2D7ABF">/</span>
                                             <img style="width: 30px; height: 18px; margin-right: 5px;" src="{{asset('/img/login.svg')}}">
                                             <a id="login" class="float-right mr-1 font-weight-bold" href="#">
                                                 Вход
                                             </a>
                                         </li>
                                 @endif
                             </div>
                        </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="header2">
        <div class="header2">
            <div class="container header-container">
                <div><i class="fas fa-users icon-header soc-icon-clicked"></i></div>
                <div><a href="{{route('index')}}"><img src="/img/logo.png" class="logo"></a></div>
                <div><i class="fas fa-bars icon-header icon-menu-clicked"></i></div>
            </div>
        </div>
        <div class="slideList mb-0 slideList-soc-icon">
            <ul class=" pb-0 mb-0">
                @if(Auth::check())
                    <li>
                        <a class="" href="{{url('cabinet')}}">Личные данные</a>
                    </li>
                    <li>
                        <a class="" href="{{url('change-pwd')}}">Сменить пароль</a>
                    </li>
                    <li>
                        <a class="" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выход</a>
                    </li>
                    @else
                <li>
                    <a id="login-m">
                        Вход
                    </a>
                </li>
                <li>
                    <a id="register-m">
                        Регистрация
                    </a>
                </li>
                    @endif
            </ul>
        </div>
        <div class="slideList mb-0 slideList-menu">
            <ul class="pb-0 mb-0">
                <li><a href="{{route('doctor.college', ['page' => 0, 'degree' => 4])}}">Колледжи</a></li>
                <li><a href="{{route('doctor.vuz', ['page' => 0, 'degree' => 0])}}">ВУЗы</a></li>
                <li><a class="dK dC rating-clicked dropdown-toggle">Рейтинг</a></li>
                <div class="inline w-100 sub-slideList">
                <li class="rating-mob-slide">
                    <img style="margin-right: 5px;" src="{{asset('/img/arrow-dots-grey.svg')}}" alt="->">
                    <a href="{{url('qazaqstan/navigator/rating/college', 1)}}">Рейтинг колледжей</a>
                </li>
                <li class="rating-mob-slide last-rating">
                    <img style="margin-right: 5px;" src="{{asset('/img/arrow-dots-grey.svg')}}" alt="->">
                    <a href="{{url('qazaqstan/navigator/rating/vuz', 2)}}">Рейтинг ВУЗов</a>
                </li>
                </div>
                <li><a class="nav-clicked dropdown-toggle">Навигатор</a></li>
                <div class="inline w-100 sub-navigator-slide">
                <li>
                    <img style="margin-right: 5px;" src="{{asset('/img/arrow-dots-grey.svg')}}" alt="->">
                    <a class="" href="{{url('qazaqstan/navigator/list/college')}}">Список колледжей</a>
                </li>
                <li>
                    <img style="margin-right: 5px;" src="{{asset('/img/arrow-dots-grey.svg')}}" alt="->">
                    <a class="" href="{{url('qazaqstan/navigator/list/vuz')}}">Список ВУЗов</a>
                </li>
                <li>
                    <img style="margin-right: 5px;" src="{{asset('/img/arrow-dots-grey.svg')}}" alt="->">
                    <a class="" href="{{route('faq')}}">Вопросы и ответы</a>
                </li>
                <li class="last-navigator">
                    <img style="margin-right: 5px;" src="{{asset('/img/arrow-dots-grey.svg')}}" alt="->">
                    <a href="{{route('partner')}}">Партнеры</a>
                </li>
                </div>
                <li><a class="" href="{{url('calculator-ent')}}">Калькулятор ЕНТ</a></li>
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel navbar-unipage {{ isset($is_main) ? 'is_index' : '' }}">
        <div class="container {{ isset($is_main) ? 'is_index' : '' }}">
            <div class="collapse navbar-collapse {{ isset($is_main) ? 'is_index' : '' }}" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav {{ isset($is_main) ? 'is_index' : '' }}">
                    <li class="nav-item">
                        <a id="CollegeActive" class="nav-link dC bK @if(($active ?? '') == 'college')active @endif" href="{{route('doctor.college', ['page' => 0, 'degree' => 4])}}">КОЛЛЕДЖИ</a>
                    </li>
                    <li class="nav-item">
                        <a id="UniActive" class="nav-link dC mG  @if(($active ?? '') == 'vuz')active @endif" href="{{route('doctor.vuz', ['page' => 0, 'degree' => 0])}}">ВУЗЫ</a>
                    </li>
                    <li id="li-nav" class="{{ isset($is_main) ? 'is_index' : '' }} position-relative nav-item">
                    <a id="rating" class="z-index {{ isset($is_main) ? 'is_index' : '' }} nav-link dC dK @if(($active ?? '') == 'rating')active @endif">РЕЙТИНГ</a>
                        <div id="nav-content-rating" class="dropdown-menu {{ isset($is_main) ? 'is_index' : '' }} nav-content">
                            <div id="nav-inner-content-rating" class="m-2 {{ isset($is_main) ? 'is_index' : '' }} ml-4 mr-4 row p-1 nav-content">
                                <div class="col-md-6 p-0 nav-items">
                                    <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                    <a href="{{url('qazaqstan/navigator/rating/college', 1)}}">РЕЙТИНГ КОЛЛЕДЖЕЙ</a>
                                </div>
                                <div class="col-md-6 p-0 nav-items">
                                    <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                    <a href="{{url('qazaqstan/navigator/rating/vuz', 2)}}">РЕЙТИНГ ВУЗОВ</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link @if(Request::path() == 'calculator') active @endif" href="{{ route('calculator') }}">Калькулятор ЕНТ</a>--}}
                    {{--</li>--}}
                    <li id="li-nav" class="{{ isset($is_main) ? 'is_index' : '' }} position-relative nav-item">
                        <a id="navigator" href="#" class="nav-link {{ isset($is_main) ? 'is_index' : '' }} {{isset($navActive)?'active':''}} z-index">НАВИГАТОР</a>
                            <div id="nav-content" class="dropdown-menu {{ isset($is_main) ? 'is_index' : '' }} nav-content">
                                <div id="nav-inner-content" class="m-2 {{ isset($is_main) ? 'is_index' : '' }} ml-4 mr-4 row nav-content p-1">
                                    <div class="col-md-6 p-0">
                                        <div class="nav-items mb-3">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{url('/qazaqstan/navigator/list/college')}}">СПИСОК КОЛЛЕДЖЕЙ</a>
                                        </div>
                                        <div class="nav-items">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{url('/qazaqstan/navigator/list/vuz')}}">СПИСОК ВУЗОВ</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">

                                        <div class="nav-items mb-3">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{route('partner')}}">ПАРТНЕРЫ</a>
                                        </div>
                                        <div class="nav-items">
                                            <img style="margin-bottom: 3px;" src="{{asset('/img/arrow-dots-black.svg')}}" alt="->">
                                            <a href="{{route('faq')}}">ВОПРОСЫ И ОТВЕТЫ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  @if(($active ?? '') == 'ent-calc')active @endif" href="{{url('calculator-ent')}}">КАЛЬКУЛЯТОР ЕНТ</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link @if(Request::path() == 'rating') active @endif" href="/rating/">{{ trans('general.rating_he') }}</a>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
    </nav>
    @include('map')
    @yield('subnav')
    @include('error')
    <main class="mt-3">
        @yield('errors')
        @include('layouts.modals.epay')
        @include('layouts.modals.login')
        @include('layouts.modals.registration')
        @include('layouts.modals.forgot')
        @yield('content')
    </main>
    <div class="minimap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2 class="sr-only">main navigation</h2>
                    <ul>
                        <li>
                            <span>Степень</span>
                            <ul>
                                <li class="">
                                    <a href="{{route('doctor.college', ['page' => 0, 'degree' => 4])}}">Колледжи</a>
                                </li>
                                <li class="">
                                    <a href="{{route('doctor.under', ['page' => 0, 'degree' => 1])}}">Бакалавриат</a>
                                </li>
                                <li>
                                    <a href="{{route('doctor.magistracy', ['page' => 0, 'degree' => 2])}}">Магистратура</a>
                                </li>
                                <li>
                                    <a href="{{route('doctor.doctor', ['page' => 0, 'degree' => 3])}}">Докторантура</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Навигатор</span>
                            <ul>
                                <li>
                                    <a href="{{url('qazaqstan/navigator/rating/college', 1)}}">Рейтинг колледжей</a>
                                </li>
                                <li>
                                    <a href="{{url('qazaqstan/navigator/rating/vuz', 2)}}">Рейтинг ВУЗов</a>
                                </li>
                                <li>
                                    <a href="{{url('qazaqstan/navigator/list/college')}}">Список колледжей</a>
                                </li>
                                <li>
                                    <a href="{{url('qazaqstan/navigator/list/vuz')}}">Список ВУЗов</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Соглашение</span>
                            <ul>
                                <li>
                                    <a href="{{route('college-vuz')}}">Колледжам/ВУЗам</a>
                                </li>
                                <li>
                                    <a href="{{route('advertisers')}}">Рекламодателям</a>
                                </li>
                                <li>
                                    <a href="{{route('agreement')}}">Пользовательское соглашение</a>
                                </li>
                                <li>
                                    <a href="{{route('confidential')}}">Политика конфедициальности</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span>Контакты</span>
                            <ul>
                                <li>
                                    <a href="{{route('about')}}">О сайте</a>
                                </li>
                                <li>
                                    <a href="{{route('vuz.add')}}">Добавить колледж/ВУЗ</a>
                                </li>
                                <li>
                                    <a href="{{url('callback')}}">Обратная связь</a>
                                </li>
                                <li>
                                    <a href="{{url('/city/view')}}">ВУЗы в городах Казахстана</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container">
            <? $year = Social::findOrFail(7); ?>
            <p class="text-center m-t-35">&copy; <?=$year->link?> | Все права защищены</p>
        </div>
    </div>
    <div class="container">
        <a href="#app" id="bottom" class="sprites page-top" title="Back to top" style="display: block;">
            <span class="sr-only">Back to top</span>
        </a>
    </div>
</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("logged");
    var mBtn = document.getElementById("logged-m");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }



    function setCash(event) {
        document.getElementById('amountInput').value = event.target.id;
    }
    function minZero(event) {
        if(event.target.value[0] == 0){
            event.target.value = parseInt(event.target.value);
        }
        if(event.target.value < 0){
            event.target.value = 0;
        }
    }
</script>
<script>
    var loginModal = document.getElementById("myLoginModal");

    // Get the button that opens the modal
    var loginBtn = document.getElementById("login");
    var mLoginBtn = document.getElementById("login-m");

    // Get the <span> element that closes the modal
    var loginSpan = document.getElementsByClassName("loginClose")[0];

    // When the user clicks the button, open the modal
    loginBtn.onclick = function() {
        loginModal.style.display = "block";
    }
    mLoginBtn.onclick = function() {
        $('.slideList').hide();
        loginModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    loginSpan.onclick = function() {
        $('input.border-danger').removeClass('border', 'border-danger').addClass('login-form-input');
        $('span.text-danger').hide();
        loginModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == loginModal) {
            loginModal.style.display = "none";
        }
    }
</script>
<script>
    var regModal = document.getElementById("myRegModal");

    // Get the button that opens the modal
    var regBtn = document.getElementById("register");
    var mRegBtn = document.getElementById("register-m");

    // Get the <span> element that closes the modal
    var regSpan = document.getElementsByClassName("regClose")[0];

    // When the user clicks the button, open the modal
    regBtn.onclick = function() {
        regModal.style.display = "block";
    }
    mRegBtn.onclick = function() {
        $('.slideList').hide();
        regModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    regSpan.onclick = function() {
        $('input.border-danger').removeClass('border', 'border-danger').addClass('login-form-input');
        $('span.text-danger').hide();
        regModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == regModal) {
            regModal.style.display = "none";
        }
    }
</script>
<script>
    var fModal = document.getElementById("myForgotModal");

    // Get the <span> element that closes the modal
    var fSpan = document.getElementsByClassName("forgotClose")[0];

    // When the user clicks on <span> (x), close the modal
    fSpan.onclick = function() {
        $('input.border-danger').removeClass('border', 'border-danger').addClass('login-form-input');
        $('span.text-danger').hide();
        fModal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == fModal) {
            fModal.style.display = "none";
        }
    }
</script>
<script !src="">
function redirectToLogin() {
    $('#myRegModal').hide();
    $('#Message').hide();
    $('#myLoginModal').show();
}
function redirectToReg() {
    $('#myLoginModal').hide();
    $('#myRegModal').show();
}
function redirectToForgot() {
    $('#myLoginModal').hide();
    $('#myForgotModal').show();
}
$('.chsn').chosen();
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '-0d',
            startDate: '-120y'
        });
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
         $("#reg-gender").removeClass('chsn');
         $("#reg-region").removeClass('chsn');
         $("#lang-pc").removeClass('chsn');

        }
    });
    @if (session()->get('login') && count($errors)> 0)
    $('#myLoginModal').show();
    @elseif(session()->get('register') && count($errors)> 0)
    $('#myRegModal').show();
    @elseif(session()->get('forgot') && (count($errors)> 0 || session()->get('errors')))
    $('#myForgotModal').show();
    @endif
    @php
        session()->forget('login');
        session()->forget('register');
        session()->forget('forgot');
    @endphp
</script>
</body>
</html>
