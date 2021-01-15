@extends('adminlte::page')

@section('title', 'Редактировать Страницу ВУЗов')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} страницу {{!str_contains(url()->current(), 'college')?'ВУЗа':'колледжа'}}</h1>
@stop

@section('content')
    @php
        $which = !str_contains(url()->current(), 'college')?'university':'college';
        if (!str_contains(url()->current(), 'college')){
            $hasVal = 0;
        }
        else{
            $hasVal = 1;
        }
        $action = is_null($id)?'/admin/list/'.$which.'/add':"/admin/list/".$which."/add/$id";
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3">Название {{!str_contains(url()->current(), 'college')?'ВУЗа':'колледжа'}} {{--на русском--}}</label>
                            <div class="col-md-9">
                                <select required name="id" @if(is_object($university)) disabled @endif class="seLect2 form-control" data-live-search="true">
                                    <option value=""></option>
                                    @if(is_object($university))
                                        @foreach(\App\Models\University::where('description', '<>', null)->where('hasCollege', $hasVal)->get() as $u)
                                            <option data-tokens="ketchup mustard" @if($u->id == $university->id) selected @endif value="{{$u->id}}">{{$u->name_ru}}</option>
                                        @endforeach
                                        @else
                                    @foreach(\App\Models\University::where('description', null)->where('hasCollege', $hasVal)->get() as $u)
                                    <option value="{{$u->id}}">{{$u->name_ru}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Изображение</label>--}}
{{--                            <div class="col-md-9">--}}
{{--                                <input type="file" name="image">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label class="col-md-3">Инфоромация</label>--}}
{{--                            <div class="col-md-9 row">--}}
{{--                                <div class="col-md-4 row">--}}
{{--                                    <label class="col-md-7">Общежитие</label>--}}
{{--                                    <div class="col-md-5">--}}
{{--                                        <select class="form-control" name="dormitory" id="">--}}
{{--                                            <option @if(is_object($university)) {{(is_null($university->dormitory))?'selected':''}} @endif value=""></option>--}}
{{--                                            <option @if(is_object($university)) {{($university->dormitory)?'selected':''}} @endif value="1">Да</option>--}}
{{--                                            <option @if(is_object($university)) {{(!$university->dormitory && !is_null($university->dormitory))?'selected':''}} @endif value="0">Нет</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-4 row">--}}
{{--                                    <label class="col-md-7">Военная кафедра</label>--}}
{{--                                    <div class="col-md-5">--}}
{{--                                        <select class="form-control" name="military_dep" id="">--}}
{{--                                            <option @if(is_object($university)) {{(is_null($university->military_dep))?'selected':''}} @endif value=""></option>--}}
{{--                                            <option @if(is_object($university)) {{($university->military_dep)?'selected':''}} @endif value="1">Да</option>--}}
{{--                                            <option @if(is_object($university)) {{(!$university->military_dep && !is_null($university->military_dep))?'selected':''}} @endif value="0">Нет</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-5 row">--}}
{{--                                    <label class="col-md-5">Веб-сайт</label>--}}
{{--                                    <div class="col-md-7">--}}
{{--                                        <input type="text" name="web_site" class="form-control" @if(is_object($university)) value="{{ $university->web_site }}" @endif>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">О {{!str_contains(url()->current(), 'college')?'ВУЗе':'колледже'}}</label>
                            <div class="col-md-9">
                                <textarea required name="description" class="form-control">@if(is_object($university)) {{ $university->description }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Достижения</label>
                            <div class="col-md-9">
                                <textarea name="achievements" class="form-control">@if(is_object($university)) {{ $university->achievements }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Сотрудничество</label>
                            <div class="col-md-9">
                                <textarea name="coop" class="form-control">@if(is_object($university)) {{ $university->coop }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Рейтинг</label>
                            <div class="col-md-9">
                                <textarea name="rating" class="form-control">@if(is_object($university)) {{ $university->rating }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Гранты/Скидки</label>
                            <div class="col-md-9">
                                <textarea name="grants" class="form-control">@if(is_object($university)) {{ $university->grants }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Образовательные программы</label>
                            <div class="col-md-9">
                                <textarea name="learn_program" class="form-control">@if(is_object($university)) {{ $university->learn_program }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Документы для поступления</label>
                            <div class="col-md-9">
                                <textarea name="docs_income" class="form-control">@if(is_object($university)) {{ $university->docs_income }} @endif</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Контакты</label>
                            <div class="col-md-9">
                                <textarea name="short_description" class="form-control">@if(is_object($university)) {{ $university->short_description }} @endif</textarea>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
