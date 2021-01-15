@extends('adminlte::page')

@section('title', 'Редактировать SEO параметр')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} SEO параметр</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/meta/add':"/admin/meta/add/$id";
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
                            <label class="col-md-3">URL страница{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="page" class="form-control" @if(is_object($direction)) value="{{ $direction->page }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Заголовок{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="title" class="form-control" @if(is_object($direction)) value="{{ $direction->title }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Описание{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="description" class="form-control" @if(is_object($direction)) value="{{ $direction->description }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Ключевое слово{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="keywords" class="form-control" @if(is_object($direction)) value="{{ $direction->keywords }}" @endif >
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
