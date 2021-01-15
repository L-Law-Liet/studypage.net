@extends('adminlte::page')

@section('title', 'Города')

@section('content_header')
    <h1>Регионы</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/region/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="84%">Регионы</th>
                                <th width="6%" colspan="2" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($region as $k => $v)
                            <tr>
                                <td>{{ $region->firstItem()+$k }}</td>
                                <td>{{ $v->name }}</td>
                                <td>
                                    <a href="/admin/region/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/region/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td width="10%">Количество {{ $count }}</td>
                            <td class='text-center'>{{ $region->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
