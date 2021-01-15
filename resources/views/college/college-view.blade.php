@extends('layouts.app')
@section('css')
    <style>
        main.mt-5 {
            margin-top: 0 !important;
        }
        main.py-4 {
            padding-top: 0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="container pt-2">
        <div class="row">
            <div class="col-md-8 col-xs-12 order-md-first  order-last">
                <div id="college-view-right">
                    <h3 class="text-center mb-4">{{mb_strtoupper($university->name_ru)}}</h3>
                    <div class="text-justify">
                        <div id="description" class="text-justify">
                            {!! $university->description !!}
                        </div>
{{--                        @include('college.media')--}}
                    </div>
                </div>
            </div>
                @include('college/college-navbar')
        </div>
    </div>
    <script !src="">
        $('.Autoplay').slick({
            autoplay: false,
            slidesToShow: 4,
        });
    </script>
@endsection
