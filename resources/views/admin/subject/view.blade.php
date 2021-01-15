@extends('adminlte::page')

@section('title', 'Просмотр профильного премета')

@section('content_header')
    <h1>Просмотр профильного премета</h1>
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
                            <td>{{ \Carbon\Carbon::parse($subject->created_at)->format('d.m.Y') }}</td>
                        </tr>
                        <tr>
                            <th>Наименование{{-- на русском--}}</th>
                            <td>{{ $subject->name_ru }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection