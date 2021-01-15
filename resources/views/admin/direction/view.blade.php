@extends('adminlte::page')

@section('title', 'Просмотр область образования')

@section('content_header')
    <h1>Просмотр область образования</h1>
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
                            <th>Дата создание</th>
                            <td>{{ \Carbon\Carbon::parse($direction->created_at)->format('d.m.Y') }}</td>
                        </tr>
                        <tr>
                            <th>Наименование на русском</th>
                            <td>{{ $direction->name_ru }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection