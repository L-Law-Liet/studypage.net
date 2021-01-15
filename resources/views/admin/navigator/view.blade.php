@extends('adminlte::page')

@section('title', 'Просмотр города')

@section('content_header')
    <h1>Просмотр города</h1>
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
                            <th>Наименование</th>
                            <td>{{ $cityslider->name_ru }}</td>
                        </tr>
                        <tr>
                            <th>Анонс</th>
                            <td>{{ $cityslider->announce }}</td>
                        </tr>
                        <tr>
                            <th>Изображение</th>
                            <td><img src="/img/cities/{{ $cityslider->image }}" alt="{{ $cityslider->name_ru }}" width="100px"></td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td id="description">{!! $cityslider->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
