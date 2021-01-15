@extends('adminlte::page')

@section('title', 'Добавить направление подготовки')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Добавить'
    @endphp
    <h1>{{ $title }} направление подготовки</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/subdirection/add':"/admin/subdirection/add/$id";
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
                            <label class="col-md-3">Область образования</label>
                            <div class="col-md-9">
                                <select required name="direction_id" class="form-control city">
                                    <option></option>
                                    @foreach($directions as $k => $v)
                                        <option @if(is_object($subdirections) && $subdirections->direction_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Направление подготовки{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="name_ru" class="form-control" @if(is_object($subdirections)) value="{{ $subdirections->name_ru }}" @endif >
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
