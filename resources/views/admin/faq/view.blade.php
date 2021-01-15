@extends('adminlte::page')

@section('title', 'Просмотр вопроса')

@section('content_header')
    <h1>Просмотр вопрос и ответ</h1>
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
                            <th>Наименование (Заголовки)</th>
                            <td><?=$faq->question?></td>
                        </tr>
                        <tr>
                            <th>Описание</th>
                            <td><?=$faq->answer?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
