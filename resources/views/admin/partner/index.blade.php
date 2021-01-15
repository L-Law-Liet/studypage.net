@extends('adminlte::page')

@section('title', 'Партнеры')

@section('content_header')
    <h1>Партнеры</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/partner/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Партнеры</th>
                                <th width="12%" class="text-center">Даты</th>
                                <th width="8%" colspan="3" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($partner as $k => $v)
                            <tr>
                                <td>{{ $partner->firstItem()+$k }}</td>
                                <td>{{ $v->name }}</td>
                                <td class="text-center">{{ date_format($v->created_at, 'd.m.Y') }}</td>
                                <td>
                                    <a href="/admin/partner/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/partner/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/partner/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="10%">Количество {{ $count }}</td>
                                <td class='text-center'>{{ $partner->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
