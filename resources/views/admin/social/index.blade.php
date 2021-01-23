@extends('adminlte::page')

@section('title', 'Социальные сети')

@section('content_header')
    <h1>Социальные сети и дополнительные настройки</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                {{--<div class="box-header with-border">--}}
                    {{--<a href="/admin/social/add" class="btn btn-success pull-right">Добавить</a>--}}
                {{--</div>--}}
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th>Дата создания</th>
                                <th>Параметр</th>
                                 <th>Значение</th>
                                 {{--<td>Название на казахском</td>--}}
                                <th colspan="3" class="text-center">Действие</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($directions as $k => $v)
                            <tr>
                                <td>{{ $directions->firstItem()+$k }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d.m.Y') }}</td>
                                <td>{{ $v->name }}</td>
                                <td>@if($v->id > 10 && $v->id < 16)
                                        <img width="100" height="100" src="{{ asset('/img/social/'.$v->link) }}" alt=""> @else {{ $v->link }} @endif</td>
                                <td style="text-align:center;">
                                    <a href="/admin/social/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Количество {{ $count }}</td>
                                <td colspan = '2' class='text-center'>{{ $directions->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
