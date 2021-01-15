@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css')}} ">
    <link rel="stylesheet" href="{{ asset('css/admin.css')}} ">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>
    <style>
        .is-active li {
            background: red;
            font-weight: 700;
        }
        .font-size-09rem li a{
            font-size: 1.2rem !important;
        }
    </style>
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- Main Header -->
        <div id="deleteModaL" class="deleteModal">
            <div class="deleteModal-block">
                <h4 style="font-weight:bold;">Удалить безвозвратно?</h4>
                <div class="deleteModal-btn">
                    <div id="DeleteBtn" class="dBt dBt-success" style="background:green;">Да</div>
                    <div class="dBt dBt-close">Нет</div>
                </div>
            </div>
        </div>
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" style="white-space: inherit !important; text-transform: uppercase; font-size: 1.2rem" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">
                @if(Session::has('errors'))
                    <div class="container">
                        <div class="alert alert-danger">
                            <p> {{ Session::get('errors') }} </p>
                        </div>
                    </div>
                @endif
                @if (is_object($errors) && $errors->any())
                        <div class="container">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @include('error')

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{asset('js/chosen.jquery.min.js')}}"></script>
    @stack('js')
    @yield('js')
    <script src="{{ asset('js/jquery-ui.min.js') }}" ></script>
    <script src="{{ asset('js/admin.js') }}" ></script>
    <script>
        $(document).ready(function () {
            $(document).on('keypress',function(e) {
                if(e.which == 13) {
                    $('.btn.btn-success.pull-right').click();
                }
            });
            $(document).on('click', '.nDBtn',function() {
                        $(document).one('keypress', function (e) {
                            if(e.which == 13) {
                                $('#DeleteBtn').click();
                            }
                        });
            });
        });
        // $("body").on("change", ".pass_score", function () {
        //     if($(".pass_score")[0].value){
        //         $(".pass_score")[1].required = false;
        //     }
        //     else {
        //         $(".pass_score")[1].required = true;
        //     }
        //     if($(".pass_score")[1].value){
        //         $(".pass_score")[0].required = false;
        //     }
        //     else {
        //         $(".pass_score")[0].required = true;
        //     }
        // });
        $(document).ready(function() {
            $('.seLect2').select2({
                "language": {
                    "noResults": function(){
                        return "Ничего не найдено";
                    }
                },
                width: '100%'
            });
        });
			var l = null;
			$('.nDBtn').on('click', function () {
				l = $(this).data('href');
				$('.deleteModal').css('display', 'flex');
			});
			$('.dBt-success').on('click', function () {
				$('.deleteModal').css('display', 'none');
				window.location.href = l;
			});
			$('.dBt-close').on('click', function () {
				l = null;
				$('.deleteModal').css('display', 'none');
			});
    </script>
@stop
