@extends('adminlte::page')

@section('title', 'Просмотр SEO параметр')

@section('content_header')
    <h1>Просмотр SEO параметр</h1>
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
                            <th>URL страница</th>
                            <td>{{ $direction->page }}</td>
                        </tr>
                        <tr>
                            <th>Заголовок</th>
                            <td>{{ $direction->title }}</td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td>{{ $direction->description }}</td>
                        </tr>
                        <tr>
                            <th>Ключевое слово</th>
                            <td>{{ $direction->keywords }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
