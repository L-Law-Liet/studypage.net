@extends('adminlte::page')

@section('title', 'Слайдеры')

@section('content_header')
    <h1>Слайдер главной страницы</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="/admin/slider/add" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%">#</th>
                                <th>Дата создания</th>
                                <th>Параметр</th>
                                <th>Описание</th>
                                <th width="5%" colspan="3" class="text-center">Действие</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $k => $v)
                            <tr>
                                <td>{{ $sliders->firstItem()+$k }}</td>
                                <td>{{ date('d.m.Y', strtotime($v->created_at)) }}</td>
                                <td>
                                    @if($v->image)
                                        <img width="100" height="100" src="{{ asset('/img/sliders/'.$v->image) }}" alt="">
                                    @else
                                        Слайдер {{$k+1}}
                                    @endif
                                </td>
                                <td id="description">{!! $v->text !!}</td>
                                <td>
                                    <a href="/admin/slider/view/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-eye-open" title="Просмотр"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="/admin/slider/add/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="/admin/slider/delete/{{ $v->id }}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan = '2'>Количество {{ $count }}</td>
                            <td colspan = '3' class='text-center'>{{ $sliders->links() }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
