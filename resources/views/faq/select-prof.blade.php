@extends('layouts.app')
@section('content')

    <div class="container pt-2">
        <div class="row">
            <div class="col-md-8 col-xs-12 order-md-first order-last">
                <div id="faq">
                    <h3 class="text-center">{{$faq->question}}</h3>
                    <div class="faq-text text-justify div-with-table">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 order-md-last ml-2 ml-md-auto order-first pl-0">
                <ul class="faq-list">
                    @foreach(\App\Models\Faq::all() as $f)
                    <li><a @if($faq->id == $f->id) class="color-C11800" @endif href="{{url('qazaqstan/navigator/faq', ($f->id>1)?$f->id:'1')}}"> <img @if($faq->id == $f->id) src="{{asset('img/arrow-dots-red.svg')}}" @else src="{{asset('img/arrow-dots-black.svg')}}" @endif >{{$f->question}}</a></li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
