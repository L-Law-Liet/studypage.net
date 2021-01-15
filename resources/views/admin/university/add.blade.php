@extends('adminlte::page')

@section('title', 'Редактировать ВУЗ')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} {{str_contains(url()->current(), 'university')?'ВУЗ':'колледж'}}</h1>
@stop

@section('content')
    @php
            $which = str_contains(url()->current(), 'university')?'university':'college';
            $action = is_null($id)?'/admin/'.$which.'/add':"/admin/".$which."/add/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Название {{str_contains(url()->current(), 'university')?'ВУЗа':'колледжа'}} {{--на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="name_ru" class="form-control" @if(is_object($university)) value="{{ $university->name_ru }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Подразделение</label>
                            <div class="col-md-9">
                                <textarea required name="subdivision" class="form-control">@if(is_object($university)) {{ $university->subdivision }} @endif</textarea>
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label class="col-3">Наименование ВУЗа на казахском</label>
                            <div class="col-9">
                                <input type="text" name="name_kz" class="form-control" @if(is_object($university)) value="{{ $university->name_kz }}" @endif >
                            </div>
                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">Регион</label>
                            <div class="col-md-9">
                                <select required name="region_id" class="form-control city">
                                    <option></option>
                                    @foreach($cities as $k => $v)
                                        <option @if(is_object($university) && $university->region_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Адрес{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="address_ru" class="form-control" @if(is_object($university)) value="{{ $university->address_ru }}" @endif >
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label class="col-3">Адресс на казахском</label>
                            <div class="col-9">
                                <input type="text" name="address_kz" class="form-control" @if(is_object($university)) value="{{ $university->address_kz }}" @endif>
                            </div>
                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">Телефон</label>
                            <div class="col-md-9">
                                <input required type="text" name="phone" class="form-control" @if(is_object($university)) value="{{ $university->phone }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Индекс</label>
                            <div class="col-md-9">
                                <input required type="text" name="postcode" class="form-control" @if(is_object($university)) value="{{ $university->postcode }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">E-mail</label>
                            <div class="col-md-9">
                                <input type="text" name="email" class="form-control" @if(is_object($university)) value="{{ $university->email }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Веб-сайт</label>
                            <div class="col-md-9">
                                <input type="text" name="web_site" class="form-control" @if(is_object($university)) value="{{ $university->web_site }}" @endif>
                            </div>
                        </div>
                        @if(str_contains(url()->current(), 'university'))
                            <div class="form-group row">
                                <label class="col-md-3">Тип учебного заведения</label>
                                <div class="col-md-9">
                                    <select required name="type_id" class="form-control city">
                                        <option></option>
                                            @foreach($types as $k => $v)
                                                <option @if(is_object($university) && $university->type_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        {{--<div class="form-group row">--}}
                            {{--<label class="col-md-3">Код</label>--}}
                            {{--<div class="col-md-9">--}}
                                {{--<input type="text" name="code" class="form-control" @if(is_object($university)) value="{{ $university->code }}" @endif >--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
