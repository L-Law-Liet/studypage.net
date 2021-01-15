@extends('adminlte::page')

@section('title', 'Обратная связь')

@section('content_header')
    <h1>Обратная связь</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
{{--                    <div class="box-header with-border">--}}
{{--                        <a href="/admin/callback/add" class="btn btn-success pull-right">Добавить</a>--}}
{{--                    </div>--}}
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="65%">Сообщений</th>
                                <th width="17%">Даты и время</th>
                                <th width="8%" colspan="2" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($callback as $k => $v)
                            <tr>
                                <td>{{ $callback->firstItem()+$k }}</td>
                                <td style="max-width:300px; overflow: hidden;">{!! $v->question !!}</td>
                                <td>{{ date_format($v->created_at, 'd.m.Y / H:i') }}</td>
                                <td>
                                    <a href="/admin/callback/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
{{--                                <td>--}}
{{--                                    <a href="/admin/callback/add/{{ $v->id }}">--}}
{{--                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                                <td>
                                    <a class="nDBtn" data-href="/admin/callback/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td width="10%">Количество {{ $count }}</td>
                            <td class='text-center'>{{ $callback->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
