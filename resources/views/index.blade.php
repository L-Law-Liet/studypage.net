@extends('layouts.app', ['is_main' => 1])
@section('js')
    <script src="{{asset('js/scripts-min-vendor.js')}}"></script>
    <script src="{{asset('js/scripts-min6b91.js?v2.72.0')}}"></script>
    @endsection
@push('pre-css')
    <link href="//db.onlinewebfonts.com/c/0265b98b68ecf1b3d801b5df4dc155e7?family=icomoon" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/chosen.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/css-min19d0.css?v2.72.2')}}" rel="stylesheet">
    <link href="{{asset('css/print.css')}}" rel="stylesheet" media="print">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script>
        let controls = false;
        let autoControls = true;
        let pager = true;
        if ($(window).width() < 767){
            controls = true;
            autoControls = false;
            pager = false;
        }
        $(document).ready(function(){
            $('.slider').bxSlider({
                speed:1000,
                pager:pager,
                pagerType:'full',
                controls:controls,
                infiniteLoop:true,
                slideWidth:960,
                moveSlides:1,
                mode:'horizontal',
                responsive:true,
                touchEnabled:false,
                auto:true,
                autoControls:autoControls,
                stopAutoOnClick: true,
                pause:6000,
                video: true,
            });
        });
    </script>

@endpush
@section('content')
    <div id="messagError" style="display: {{($message?? '')? 'block' : 'none'}}"
         class="alert alert-info text-center w-50 p-1 rounded-lg position-absolute">
        {{$message ?? ''}}
    </div>
    <div class="main">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="clearfix pt-5">
                <div style="height: 340px" class="slider">
                    @foreach(\App\Slider::where('show', true)->get() as $slider)
                        <div class="d-flex flex-md-row flex-column">
                            <div class="slider-media-container">
                                @if($slider->video)
                                    <iframe rel="preload" style="width: 100%; height: 100%" src="{{$slider->video.'?autoplay=1&mute=1&controls=0'}}"></iframe>
                                @else
                                    <img style="width: 100%; height: 100%" src="{{asset('/img/sliders/'.$slider->image)}}" alt="omg">
                                @endif
                            </div>
                            <div class="slider-text">{!! $slider->text !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
                @include('parts.edu-services')
                @include('parts.cities')
                @if(count($partners) > 0)
                    @include('parts.partners')
                    @endif
        </div>
    </div>
    <script !src="">
        $('.directionc').chosen();
        $('.cityc').chosen();
        $('.degreec').chosen();
    </script>
@endsection
