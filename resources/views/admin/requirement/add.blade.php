@extends('adminlte::page')

@section('title', 'Добавить требование')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} документы для поступления колледж/ВУЗ</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/requirement/add':"/admin/requirement/add/$id";
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
                            <label class="col-md-3">Степень{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <select required name="degree_id" class="form-control">
                                    <option></option>
                                    @foreach($degrees as $k => $v)
                                        <option @if(is_object($requirement) && $requirement->degree_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label class="col-3">Наименование на казахском</label>
                            <div class="col-9">
                                <input type="text" name="name_kz" class="form-control" @if(is_object($requirement)) value="{{ $requirement->name_kz }}" @endif >
                            </div>
                        </div>--}}
                        <div class="form-group row">
                            <label class="col-md-3">Описание{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <textarea required name="content_ru" class="form-control">@if(is_object($requirement)) {{ $requirement->content_ru }} @endif</textarea>
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label class="col-3">Текст на казахском</label>
                            <div class="col-9">
                                <textarea name="content_kz" class="form-control">@if(is_object($requirement)) {{ $requirement->content_ru }} @endif</textarea>
                            </div>
                        </div>--}}
                        <div class="clearfix">
                            <button class="btn btn-success pull-right">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
