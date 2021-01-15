@extends('adminlte::page')

@section('title', 'Просмотр статьи')

@section('content_header')
    <h1>Просмотр статьи</h1>
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
                            <th>Заголовок</th>
                            <td>{{ $article->title }}</td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td id="description">{!! $article->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
