@extends('adminlte::page')

@section('title', 'Требования к поступлению')

@section('content_header')
    <h1>Документы для поступления колледж/ВУЗ</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
{{--                <div class="box-header with-border">--}}
{{--                    <a href="/admin/requirement/add" class="btn btn-success pull-right">Добавить</a>--}}
{{--                </div>--}}
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Степень</th>
                                <th>Описание</th>
                                 <th class="text-center">Даты</th>
                                 <th colspan="2" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($requirements as $k => $v)
                            <tr>
                                <td>{{ $requirements->firstItem()+$k }}</td>
                                <td>{{ $v->relDegree->name_ru }}</td>
                                <td>{!! $v->content_ru !!}</td>
                                <td class="text-center">{{ date_format($v->updated_at, 'd.m.Y') }}</td>
                                <td>
                                    <a href="/admin/requirement/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/requirement/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
{{--                                <td>--}}
{{--                                    <a class="nDBtn" data-href="/admin/requirement/delete/{{ $v->id }}">--}}
{{--                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = '3'>Количество {{ $count }}</td>
                                <td colspan = '3' class='text-center'>{{ $requirements->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
