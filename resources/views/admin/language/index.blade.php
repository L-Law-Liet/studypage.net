@extends('adminlte::page')

@section('title', 'Языки обучения')

@section('content_header')
    <h1>Языки обучения</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/language/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="80%">Языки обучения</th>
                                <th width="18%" colspan="2" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($languages as $k => $v)
                            <tr>
                                <td>{{ $languages->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>
                                    <a href="/admin/language/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/language/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="20%">Количество {{ $count }}</td>
                                <td class='text-center'>{{ $languages->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
