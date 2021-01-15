@extends('adminlte::page')

@section('title', 'Статьи')

@section('content_header')
    <h1>Статьи</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
{{--                <div class="box-header with-border">--}}
{{--                    <a href="/admin/article/add" class="btn btn-success pull-right">Добавить</a>--}}
{{--                </div>--}}
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th>Заголовок</th>
                                <th>Описание</th>
                                <th width="5%" colspan="2" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($article as $k => $v)
                            <tr>
                                <td>{{ $article->firstItem()+$k }}</td>
                                <td>{{ $v->title }}</td>
                                <td id="description">{!! mb_substr($v->description, 0, 200, 'UTF-8') !!}</td>
                                <td>
                                    <a href="/admin/article/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/article/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
{{--                                <td>--}}
{{--                                    <a class="nDBtn" data-href="/admin/article/delete/{{ $v->id }}">--}}
{{--                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan = '2'>Количество {{ $count }}</td>
                            <td colspan = '3' class='text-center'>{{ $article->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
