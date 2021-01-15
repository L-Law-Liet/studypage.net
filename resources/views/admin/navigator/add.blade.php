@extends('adminlte::page')

@section('title', 'Добавить')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }}</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/navigator/add':"/admin/navigator/add/$id";
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
                            <label class="col-md-3">SEO Title</label>
                            <div class="col-md-9">
                                <input type="text" name="s_title" class="form-control" @if(is_object($cityslider)) value="{{ $cityslider->s_title }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">SEO Description</label>
                            <div class="col-md-9">
                                <input type="text" name="s_description" class="form-control" @if(is_object($cityslider)) value="{{ $cityslider->s_description }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">SEO Keywords</label>
                            <div class="col-md-9">
                                <input type="text" name="s_keywords" class="form-control" @if(is_object($cityslider)) value="{{ $cityslider->s_keywords }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Название</label>
                            <div class="col-md-9">
                                <input type="text" name="name_ru" class="form-control" @if(is_object($cityslider)) value="{{ $cityslider->name_ru }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Анонс</label>
                            <div class="col-md-9">
                                <input type="text" name="announce" class="form-control" @if(is_object($cityslider)) value="{{ $cityslider->announce }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Описание</label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control">@if(is_object($cityslider)) {{ $cityslider->description }} @endif</textarea>
                            </div>
                        </div>
                        {{--<div class="form-group row">--}}
                            {{--<label class="col-md-3">Изображение</label>--}}
                            {{--<div class="col-md-9">--}}
                                {{--<input type="file" name="image">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">Включить</label>
                            <div class="col-md-9">
                                <select name="active" class="form-control">
                                    <option @if(is_object($cityslider) && $cityslider->active == 1) selected @endif value="{{ 1 }}">Да</option>
                                    <option @if(is_object($cityslider) && $cityslider->active == 0) selected @endif value="{{ 0 }}">Нет</option>
                                </select>
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