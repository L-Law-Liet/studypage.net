@extends('adminlte::page')

@section('title', 'Направления подготовки')

@section('content_header')
    <h1>Направления подготовки</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/subdirection/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="40%">Направления подготовки</th>
                                <th width="40%">Области образования</th>
                                <th width="18%" colspan="2" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($subdirections as $k => $v)
                            <tr>
                                <td>{{ $subdirections->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>{{ $v->relDirection->name_ru }}</td>
{{--                                <td>--}}
{{--                                    <a href="/admin/subdirection/view/{{ $v->id }}">--}}
{{--                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                                <td>
                                    <a href="/admin/subdirection/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/subdirection/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="20%">Количество {{ $count }}</td>
                                <td class='text-center'>{{ $subdirections->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
