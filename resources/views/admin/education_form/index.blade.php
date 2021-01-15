@extends('adminlte::page')

@section('title', 'Формы обучения')

@section('content_header')
    <h1>Формы обучения</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <a href="{{url('admin/education-form/add')}}" class="btn btn-success pull-right">Добавить</a>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <thead>
                             <tr>
                                <th width="2%">#</th>
                                <th width="80%">Формы обучения</th>

                                <th width="18%" colspan="2" class="text-center">Действия</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach($education_forms as $k => $v)
                            <tr>
                                <td>{{ $education_forms->firstItem()+$k }}</td>
                                <td>{{ $v->name }}</td>
                                <td>
                                    <a href="{{url('admin/education-form/add', $v->id)}}">
                                        <i class="glyphicon glyphicon-pencil" title="Редактировать"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="nDBtn" data-href="{{url('admin/education-form/delete', $v->id)}}">
                                        <i class="glyphicon glyphicon-trash" title="Удалить"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td width="20%">Количество {{ $count }}</td>
                                <td class='text-center'>{{ $education_forms->links() }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
