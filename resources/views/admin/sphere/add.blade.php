@extends('adminlte::page')

@section('title', 'Редактировать сферу направления')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} сферу направления</h1>
@stop

@section('content')
    @php
           $action = is_null($id)?'/admin/sphere/add':"/admin/sphere/add/$id";
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
                            <label class="col-md-3">Степень</label>
                            <div class="col-md-9">
                                <input required type="text" name="name_ru" class="form-control" @if(is_object($sphere)) value="{{ $sphere->name_ru }}" @endif >
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
