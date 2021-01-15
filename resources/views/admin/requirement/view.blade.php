@extends('adminlte::page')

@section('title', 'Просмотр требования')

@section('content_header')
    <h1>Просмотр документы для поступления колледж/ВУЗ</h1>
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
                            <th>Степень</th>
                            <td>{{ $requirement->relDegree->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td>{!! $requirement->content_ru !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
