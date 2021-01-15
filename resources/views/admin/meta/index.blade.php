@extends('adminlte::page')

@section('title', 'SEO параметры страниц')

@section('content_header')
    <h1>SEO параметры страниц</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/meta/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Заголовок</th>
                                <th>Описание</th>
                                 <th>Ключевые слова</th>
                                 <th class="text-center">Даты</th>
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($directions as $k => $v)
                            <tr>
                                <td>{{ $directions->firstItem()+$k }}</td>
                                <td>{{ $v->title }}</td>
                                <td>{{ $v->description }}</td>
                                <td>{{ $v->keywords }}</td>
                                <td>{{ date_format($v->created_at, 'd.m.Y') }}</td>
                                <td style="text-align:center;">
                                    <a href="/admin/meta/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Посмотреть"></i>
                                    </a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="/admin/meta/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td style="text-align:center;">
                                    <a href="/admin/meta/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="10%">Количество {{ $count }}</td>
                                <td colspan = '2' class='text-center'>{{ $directions->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
