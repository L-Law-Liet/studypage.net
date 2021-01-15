@extends('layouts.app')
@section('css')
    <style>
        body {
            font-family: Futura PT, sans-serif;
        }
        .py-4 {
            padding-top: 0 !important;
        }
    </style>
    @endsection
    @php
    $arr = $errors->all()??[];
    @endphp
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center m-b-10 font-weight-bold">ОБРАТНАЯ СВЯЗЬ</h3>
                <div style="text-align:center;"><p>Администрация сайта прочтет сообщение и постарается ответить на него в кратчайшие сроки. ВНИМАНИЕ! Studypage.net&nbsp;вправе не отвечать, если: содержание сообщения нарушает законодательство; содержание сообщения противоречит основам морали и нравственности, несет оскорбительный характер; содержание сообщения не относится к деятельности Studypage.net; анонимное обращение.</p></div>
                <form action="{{route('callbackPost')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group row">
                        <label class="col-md-3">Ваше имя*</label>
                        <div class="col-md-9">
                            <input required type="text" name="firstName" class="form-control" value="{{old('firstName')}}">
                        </div>
                        @if(end($arr) == 'Callback' && $errors->first('firstName'))<span class="offset-3  col-md-9 text-danger"><small>{{ $errors->first('firstName')}}</small></span>@endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 pr-1">Контактный телефон*</label>
                        <div class="col-md-9">
                            <input required type="tel" name="footerPhone" class="phone_mask form-control" value="{{old('footerPhone')}}">
                        </div>
                        @if(end($arr) == 'Callback' && $errors->first('footerPhone'))<span class="offset-3  col-md-9 text-danger"><small>{{ $errors->first('footerPhone')}}</small></span>@endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Электронная почта*</label>
                        <div class="col-md-9">
                            <input required type="email" name="footerEmail" class="form-control" value="{{old('footerEmail')}}">
                        </div>
                        @if(end($arr) == 'Callback' && $errors->first('footerEmail'))<span class="offset-3  col-md-9 text-danger"><small>{{ $errors->first('footerEmail')}}</small></span>@endif
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3">Сообщение*</label>
                        <div class="col-md-9">
                            <textarea required rows="4" style="resize: none" name="question" class="form-control">{{old('question')}}</textarea>
                        </div>
                        @if(end($arr) == 'Callback' && $errors->first('question'))<span class="offset-3  col-md-9 text-danger"><small>{{ $errors->first('question')}}</small></span>@endif
                    </div>
                    <div class="clearfix">
                        <div class="form-group m-md-auto mt-4 pt-md-0 pt-2">
                            <button class="btn col-md-4 col-xs-12 text-capitalize btn-primary-custom float-right">
                                Отправить
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
