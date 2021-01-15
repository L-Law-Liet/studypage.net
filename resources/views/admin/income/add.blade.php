@extends('adminlte::page')

@section('title', 'Редактировать поступление')

@section('content_header')
    @php
        $title = is_null($id) ? 'Добавить' : 'Редактировать'
    @endphp
    <h1>{{ $title }} поступления в {{($t == 'univer')? 'ВУЗЫ':'колледжи'}}</h1>
@stop

@section('content')
    @php
           $action = is_null($id)?"/admin/income/add/$t":"/admin/income/add/$t/$id";
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
                            <label class="col-md-3">Поступление в {{($t == 'univer')? 'ВУЗ':'колледж'}}</label>
                            <div class="col-md-9">
                                <input required type="text" name="name" class="form-control" @if(is_object($income)) value="{{ $income->name }}" @endif >
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
