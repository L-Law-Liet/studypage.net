@extends('adminlte::page')

@section('title', 'Ответить на вопрос')

@section('content_header')
    <h1>Ответить на вопрос</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/callback/add':"/admin/callback/add/$id";
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
                            <label class="col-md-3">Имя</label>
                            <div class="col-md-9">
                                <input required type="text" name="name" class="form-control" @if(is_object($callback)) value="{{ $callback->name }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Контактный телефон</label>
                            <div class="col-md-9">
                                <input required type="text" name="phone" class="form-control" @if(is_object($callback)) value="{{ $callback->phone }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Электронная почта</label>
                            <div class="col-md-9">
                                <input required type="text" name="email" class="form-control" @if(is_object($callback)) value="{{ $callback->email }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Вопрос</label>
                            <div class="col-md-9">
                                <textarea required name="question" class="form-control">@if(is_object($callback)) {{ $callback->question }} @endif</textarea>
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
