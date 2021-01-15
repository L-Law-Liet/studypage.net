@extends('adminlte::page')

@section('title', 'Административная панель')

@section('content_header')

@stop
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body" style="min-height: 50%">
                    <h4>Добро пожаловать в админ панель!</h4>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="/css/chosen.min.css" rel="stylesheet" type="text/css">
@stop

@section('js')
    <script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}" defer></script>
    <script src="{{ asset('datepicker/locales/bootstrap-datepicker.ru.min.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>

@stop
