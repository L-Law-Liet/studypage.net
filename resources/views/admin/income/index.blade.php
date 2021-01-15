@extends('adminlte::page')

@section('title', 'Сферы направления')

@section('content_header')
    <h1>Поступления в {{($t == 'univer')? 'ВУЗЫ':'колледжи'}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="{{url('admin/income/add', $t)}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="80%">Поступления в {{($t == 'univer')? 'ВУЗЫ':'колледжи'}}</th>

                                <th width="18%" colspan="2" class="text-center">Действия</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($incomes as $k => $v)
                            <tr>
                                <td>{{ $incomes->firstItem()+$k }}</td>
                                <td>{{ $v->name }}</td>
                                <td>
                                    <a href="{{url('admin/income/add', [$t, $v->id])}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{url('admin/income/delete', [$t, $v->id])}}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="20%">Количество {{ $count }}</td>
                                <td class='text-center'>{{ $incomes->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
