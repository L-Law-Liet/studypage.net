@extends('adminlte::page')

@section('title', 'Редактировать специальность')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} специальность</h1>
@stop

@section('content')
    @php
        $action = is_null($id)?'/admin/specialty/add':"/admin/specialty/add/$id";
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
                            <label class="col-md-3">Шифр специальности</label>
                            <div class="col-md-9">
                                <input required type="text" name="cipher" class="form-control" @if(is_object($specialty)) value="{{ $specialty->cipher }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Наименование{{-- на русском--}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="name_ru" class="form-control" @if(is_object($specialty)) value="{{ $specialty->name_ru }}" @endif >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Область обучения</label>
                            <div class="col-md-9">
                                <select name="direction_id" class="form-control admin-direction">
                                    <option></option>
                                    @foreach($directions as $k => $v)
                                        <option @if(is_object($specialty) && !empty($specialty->subdirection_id) && $specialty->relSubdirection->relDirection->id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="subdirection" @if(!is_object($specialty) && empty($specialty->subdirection_id)) style="display: block;" @endif>
                            <label class="col-md-3">Направление обучения</label>
                            <div class="col-md-9">
                                <select name="subdirection_id" class="form-control subdirection" id="subdirection_id">
                                    <option></option>
                                    @foreach($subdirections as $k => $v)
                                        <option @if(is_object($specialty) && $specialty->subdirection_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Профильный предмет</label>
                            <div class="col-md-9">
                                <select name="subject_id" class="form-control">
                                    <option></option>
                                    @foreach($subjects as $k => $v)
                                        <option @if(is_object($specialty) && $specialty->subject_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Второй профильный предмет</label>
                            <div class="col-md-9">
                                <select name="subject_id2" class="form-control">
                                    <option></option>
                                    @foreach($subjects as $k => $v)
                                        <option @if(is_object($specialty) && $specialty->subject_id2 == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Степень</label>
                            <div class="col-md-9">
                                <select name="degree_id" class="form-control admin-degree">
                                    <option></option>
                                    @foreach($degrees as $k => $v)
                                        <option @if(is_object($specialty) && $specialty->degree_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row admin-sphere" style="display: none">
                            <label class="col-md-3">Сфера направления</label>
                            <div class="col-md-9">
                                <select name="sphere_id" class="form-control">
                                    <option></option>
                                    @foreach($sphere as $k => $v)
                                        <option @if(is_object($specialty) && $specialty->sphere_id == $k) selected @endif value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Срок обучения</label>
                            <div class="col-md-9">
                                <input type="text" name="education_time" class="form-control" @if(is_object($specialty)) value="{{ $specialty->education_time }}" @endif >
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
