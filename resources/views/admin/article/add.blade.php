@extends('adminlte::page')

@section('title', 'Добавить статью')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} статью</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/article/add':"/admin/article/add/$id";
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
                        <div hidden class="form-group row">
                            <label class="col-md-3">SEO Title</label>
                            <div class="col-md-9">
                                <input type="text" name="s_title" class="form-control" @if(is_object($article)) value="{{ $article->s_title }}" @endif>
                            </div>
                        </div>
                        <div hidden class="form-group row">
                            <label class="col-md-3">SEO Description</label>
                            <div class="col-md-9">
                                <input type="text" name="s_description" class="form-control" @if(is_object($article)) value="{{ $article->s_description }}" @endif>
                            </div>
                        </div>
                        <div hidden class="form-group row">
                            <label class="col-md-3">SEO Keywords</label>
                            <div class="col-md-9">
                                <input type="text" name="s_keywords" class="form-control" @if(is_object($article)) value="{{ $article->s_keywords }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Заголовок</label>
                            <div class="col-md-9">
                                <input required type="text" name="title" class="form-control" @if(is_object($article)) value="{{ $article->title }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Описание</label>
                            <div class="col-md-9">
                                <textarea required name="description" class="form-control">@if(is_object($article)) {{ $article->description }} @endif</textarea>
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
