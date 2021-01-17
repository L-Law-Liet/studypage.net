@extends('adminlte::page')

@section('title', 'Просмотр слайдера')

@section('content_header')
    <h1>Просмотр слайдера</h1>
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
                            <th>Изображение</th>
                            <td><img height="100" width="100" src="{{ asset('/img/sliders/'.$slider->image) }}" alt="слайдер"></td>
                        </tr>
                        <tr>
                            <th>Видео</th>
                            <td>{{ $slider->video }}</td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td id="description">{!! $slider->text !!}</td>
                        </tr>
                        <tr>
                            <th>Отображение</th>
                            <td>{{ $slider->show }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
