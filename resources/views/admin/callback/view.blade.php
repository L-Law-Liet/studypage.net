@extends('adminlte::page')

@section('title', 'Просмотр вопроса')

@section('content_header')
    <h1>Просмотр сообщение</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a class="btn btn-warning pull-right" href="{{ URL::previous() }}">Назад</a>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-view">
                        <tr>
                            <th>Имя</th>
                            <td>{{ $callback->name }}</td>
                        </tr>
                        <tr>
                            <th>Контактный телефон</th>
                            <td>{{ $callback->phone }}</td>
                        </tr>
                        <tr>
                            <th>Электронная почта</th>
                            <td>{{ $callback->email }}</td>
                        </tr>
                        <tr>
                            <th>Сообщение</th>
                            <td>{!! $callback->question !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
