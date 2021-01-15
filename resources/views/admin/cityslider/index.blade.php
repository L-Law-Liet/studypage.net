@extends('adminlte::page')

@section('title', 'ВУЗы в городах Казахстана')

@section('content_header')
    <h1>ВУЗы в городах Казахстана</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/cityslider/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th width="90%">Наименования городов</th>
                                <th width="8%" colspan="3" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cityslider as $k => $v)
                            <tr>
                                <td>{{ $cityslider->firstItem()+$k }}</td>
                                <td>{{ $v->name_ru }}</td>
                                <td>
                                    <a href="/admin/cityslider/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/cityslider/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/cityslider/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td width="10%">Количество {{ $count }}</td>
                            <td class='text-center'>{{ $cityslider->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
