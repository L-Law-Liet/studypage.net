@extends('adminlte::page')

@section('title', 'Редактировать партнера')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} партнера</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/partner/add':"/admin/partner/add/$id";
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
                            <label class="col-md-3">Наименование</label>
                            <div class="col-md-9">
                                <input required type="text" name="name" class="form-control" @if(is_object($partner)) value="{{ $partner->name }}" @endif>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Регион</label>
                            <div class="col-md-9">
                                <select required class="form-control" name="region">
                                    <option value=""></option>
                                    @foreach(\App\Region::all() as $r)
                                        <option @if(is_object($partner) && $partner->region == $r->name) selected @endif value="{{$r->name}}">{{$r->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Изображение</label>
                            <div class="col-md-9">
                                <input type="file" name="image">
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
